<?php
// Secure session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Ensure HTTPS is enabled
ini_set('session.cookie_samesite', 'Strict');
ini_set('display_errors', 'Off'); // Disable error display on production
ini_set('log_errors', 'On'); // Enable error logging
ini_set('error_log', 'error_log.txt'); // Log errors to a file

session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include('config.php');

// Initialize variables for success and error messages
$error = $success = "";

// Handle blog post addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF token validation
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die("CSRF validation failed.");
    }

    // Sanitize input
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $status = ($_POST['status'] === 'published') ? 'published' : 'draft';

    // Validation
    if (empty($title) || empty($content)) {
        $error = "Title and content are required.";
    } else {
        // Insert blog post into the database
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, status, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $title, $content, $status);

        if ($stmt->execute()) {
            $success = "Blog post added successfully.";
        } else {
            $error = "Failed to add blog post. Please try again.";
            error_log("Database error: " . $stmt->error);
        }
        $stmt->close();
    }
}

// Retrieve blogs for listing (published posts)
$blogs = [];
$stmt = $conn->prepare("SELECT id, title, status, created_at FROM blogs WHERE status = 'published' ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $blogs[] = $row;
}
$stmt->close();

// Fetch drafts from the database
$drafts = [];
$sql = "SELECT id, title, content, created_at FROM blogs WHERE status = 'draft' ORDER BY created_at DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $drafts[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog Posts</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link rel="icon" href="assets/img/fevicon.png" type="image/png">

    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
    /* General Reset and Font */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Poppins", serif;
        background-color: #f8f9fa;
        color: #343a40;
        line-height: 1.6;
        padding: 20px;
    }

    /* Header Section */
    header {
        background-color: #ffffff;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header img.logo {
        height: 50px;
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 15px;
    }

    nav ul li {
        display: inline;
    }

    nav ul li a {
        text-decoration: none;
        color: #343a40;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.3s;
    }

    nav ul li a:hover {
        background-color: #007bff;
        color: #fff;
    }

    nav ul li a.logout {
        background-color: #dc3545;
        color: white;
    }

    nav ul li a.logout:hover {
        background-color: #c82333;
    }

    /* Content Section */
    main {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    form label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    form input,
    form select,
    .ck-editor__editable {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 6px;
    }

    .ck-editor__editable {
        height: 300px;
    }

    .btn-submit {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        font-weight: 600;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .drafts-container ul {
        list-style: none;
        padding: 0;
    }

    .drafts-container ul li {
        background-color: #f8f9fa;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        header {
            flex-direction: column;
            align-items: flex-start;
        }

        nav ul {
            flex-direction: column;
            gap: 10px;
        }
    }
    </style>
</head>

<body>
    <header>
        <img src="assets/img/logo ayurmax.png" alt="Ayurmax Logo" class="logo">
        <nav>
            <ul>
                <li><a href="#" id="viewAllBlogs">View All Blogs</a></li>
                <li><a href="#" id="viewDrafts">View Drafts</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Success/Error Messages -->
        <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <!-- Blog Form -->
        <section class="card">
            <h2>Add New Blog Post</h2>
            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter the blog title" required>

                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>

                <label for="content">Content</label>
                <textarea id="content" name="content" style="display: none;"></textarea>

                <button type="submit" class="btn-submit">Submit Post</button>
            </form>
        </section>

        <!-- Drafts -->
        <section class="card drafts-container" id="draftsContainer" style="display: none;">
            <h2>Drafts</h2>
            <ul></ul>
        </section>
    </main>

    <script>
    // Initialize CKEditor
    let editorInstance;

    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            editorInstance = editor;

            // Handle form submission
            const form = document.querySelector('form');
            form.addEventListener('submit', e => {
                document.querySelector('#content').value = editor.getData();
                if (editor.getData().trim() === '') {
                    e.preventDefault();
                    alert('Content cannot be empty.');
                }
            });
        })
        .catch(error => console.error(error));

    // Handle Drafts View
    const drafts = <?= json_encode($drafts) ?>;
    const draftsContainer = document.getElementById('draftsContainer');
    const viewDraftsLink = document.getElementById('viewDrafts');

    viewDraftsLink.addEventListener('click', e => {
        e.preventDefault();
        draftsContainer.style.display = 'block';

        const ul = draftsContainer.querySelector('ul');
        ul.innerHTML = '';
        if (drafts.length) {
            drafts.forEach(draft => {
                const li = document.createElement('li');

                // Draft content
                li.innerHTML = `
                    <strong>${draft.title}</strong> (Created: ${new Date(draft.created_at).toLocaleString()})
                    <p>${draft.content}</p>
                    <button class="btn-edit" data-id="${draft.id}" data-title="${draft.title}" data-content="${draft.content}">Edit</button>
                `;

                ul.appendChild(li);
            });

            // Add event listeners to "Edit" buttons
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', e => {
                    const {
                        id,
                        title,
                        content
                    } = e.target.dataset;

                    // Populate the form with the draft content
                    document.getElementById('title').value = title;
                    editorInstance.setData(content);

                    // Add a hidden input to track the draft ID being edited
                    let hiddenInput = document.querySelector('input[name="draft_id"]');
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'draft_id';
                        document.querySelector('form').appendChild(hiddenInput);
                    }
                    hiddenInput.value = id;

                    // Scroll to the form
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        } else {
            ul.innerHTML = '<p>No drafts available.</p>';
        }
    });
    </script>

</body>

</html>