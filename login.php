<?php
require 'config.php'; // Include the database connection

// Secure session settings
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'domain'   => '',
    'secure'   => isset($_SERVER['HTTPS']), 
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

// Check if lockout time has passed and reset login attempts if necessary
if (isset($_SESSION['lockout_time']) && time() > $_SESSION['lockout_time']) {
    unset($_SESSION['login_attempts'], $_SESSION['lockout_time']);
}

// Prevent session fixation
if (!isset($_SESSION['IP']) || $_SESSION['IP'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['UA'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_regenerate_id(true);
    $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['UA'] = $_SERVER['HTTP_USER_AGENT'];
}

// CSRF Token Setup
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function isValidCsrfToken($token) {
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Initialize error message variable
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';
    $csrf_token = $_POST['csrf_token'] ?? '';

    // Validate CSRF token
    if (!isValidCsrfToken($csrf_token)) {
        $error_message = "Invalid CSRF token.";
    } else {
        // Fetch user details from the database
        $stmt = $conn->prepare("SELECT username, password_hash FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_username, $db_password_hash);
            $stmt->fetch();

            // Verify the hashed password
            if (password_verify($password, $db_password_hash)) {
                $_SESSION['is_admin'] = true;
                header("Location: add_blog.php");
                exit;
            }
        }

        // Authentication failed
        $_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;
        $_SESSION['login_attempts']++;

        if ($_SESSION['login_attempts'] > 5) {
            $_SESSION['lockout_time'] = time() + 600;
            $error_message = "Too many failed attempts. Try again later.";
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}

// Store error message in session for JavaScript pop-up
if (!empty($error_message)) {
    $_SESSION['error_message'] = $error_message;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Retrieve error message if exists
$error_message = $_SESSION['error_message'] ?? null;
unset($_SESSION['error_message']); // Clear error message after displaying
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="assets/img/fevicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Poppins", sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .login-container {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 16px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    h1 {
        font-size: 1.8rem;
        color: #fff;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    label {
        font-weight: 600;
        color: #fff;
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: 0.3s;
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    input:focus {
        border-color: #ff7eb3;
        background: rgba(255, 255, 255, 0.3);
    }

    button {
        width: 100%;
        padding: 12px;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background: #ff7eb3;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    button:hover {
        background: #ff5a92;
    }

    .error-popup {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ff4d4d;
        color: #fff;
        padding: 15px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1rem;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        z-index: 9999;
    }

    @media (max-width: 480px) {
        .login-container {
            width: 90%;
            padding: 20px;
        }

        h1 {
            font-size: 1.5rem;
        }

        button {
            font-size: 0.9rem;
        }
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
    // Clear any previous error popups
    const existingError = document.querySelector('.error-popup');
    if (existingError) {
        existingError.remove();
    }

    // Function to display error popup
    function showError(message) {
        const errorContainer = document.createElement('div');
        errorContainer.classList.add('error-popup');
        errorContainer.textContent = message;

        // Append error popup to body and animate
        document.body.appendChild(errorContainer);
        setTimeout(() => errorContainer.style.opacity = 1, 50); // Fade-in animation

        // Remove after 5 seconds
        setTimeout(() => errorContainer.remove(), 5000);
    }

    // Show the error message if there's one
    <?php if (!empty($error_message)): ?>
    showError("<?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>");
    <?php endif; ?>
    </script>
</body>

</html>