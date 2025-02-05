<?php
include('config.php');

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection using prepared statements
    $post_id = intval($_GET['id']);

    // Prepare and bind statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ? AND status = 'published'");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Get the blog post details
        $post = $result->fetch_assoc();
    } else {
        // If the post is not found, show a 404 error
        header("HTTP/1.0 404 Not Found");
        die("Blog post not found.");
    }
} else {
    // If no 'id' is passed in the URL, show a 404 error
    header("HTTP/1.0 404 Not Found");
    die("Invalid blog post ID.");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Ayurmax Hospital Blog - Health, Wellness, Ayurvedic Treatments, and Lifestyle Tips.">
    <meta name="keywords" content="Ayurvedic Treatment, Health, Wellness, Blog, Ayurmax Hospital">
    <meta name="author" content="Ayurmax Hospital">
    <meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>">
    <meta property="og:description" content="Read the full blog post on Ayurmax Hospital Blog.">
    <meta property="og:image" content="assets/img/logo ayurmax.png">
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://www.ayurmaxhospital.com/blog-post.php?id=<?php echo $post['id']; ?>">
    <title><?php echo htmlspecialchars($post['title']); ?> - Ayurmax Hospital Blog</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="assets/js/doctor.js" defer></script>
    <link rel="icon" href="assets/img/fevicon.png" type="image/png">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="header-top">
            <div class="contact-info">
                <p>Email: <a href="mailto:ayurmaxx@gmail.com">ayurmaxx@gmail.com</a></p>
                <p>Address: 82, Vivek Vihar, Pocket 3, Balliwala Chowk, Dehradun, Uttarakhand 248001</p>
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/ayurmaxhospital" target="_blank"><img
                        src="https://img.icons8.com/fluency/48/facebook-new.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/ayurmaxhospital" target="_blank"><img
                        src="https://img.icons8.com/color/100/instagram-new--v1.png" alt="Instagram"></a>
            </div>
        </div>

        <div class="header-main">
            <a href="/">
                <img src="assets/img/logo ayurmax.png" alt="Ayurmax Logo">
            </a>
            <nav>
                <ul>
                    <li><a href="/#services">Treatments</a></li>
                    <li><a href="/#experienced-team">Doctors</a></li>
                    <li><a href="/#facility">Facilities</a></li>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="blog.php">Blogs</a></li>
                    <li><a href="appointment.html" class="book-now-btn">Book Appointment</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="single-blog-post">
            <div class="post-title-meta-wrapper">
                <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
                <div class="post-meta">
                    <span class="post-author">By Ayurmax Team</span> |
                    <span class="post-date"><?php echo date("F j, Y", strtotime($post['created_at'])); ?></span>
                </div>
            </div>

            <hr class="separator">

            <div class="post-content-wrapper">
                <div class="post-content">
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                </div>
            </div>
        </section>
    </main>

    <a href="https://wa.me/8171200004" target="_blank" class="whatsapp-button" aria-label="Contact on WhatsApp"
        rel="noopener noreferrer">
        <img src="https://img.icons8.com/?size=100&id=A1JUR9NRH7sC&format=png&color=000000" alt="WhatsApp">
    </a>

    <button id="backToTop" aria-label="Back to top">⬆️</button>

    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <img src="assets/img/logo ayurmax.png" alt="Ayurmax Logo">
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/#services">Treatment</a></li>
                    <li><a href="/#experienced-team">Doctor</a></li>
                    <li><a href="/#facility">Facility</a></li>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>Email: <a href="mailto:ayurmaxx@gmail.com">ayurmaxx@gmail.com</a></p>
                <p>Phone: <a href="tel:+918171200004">+91 8171200004</a></p>
                <p>Address: 82, Vivek Vihar, Pocket 3, Balliwala Chowk, Dehradun, Uttarakhand 248001</p>
            </div>
            <div class="map-container">
                <h3>Our Location</h3>
                <iframe
                    src="https://www.google.com/maps?q=82,+Vivek+Vihar,+Pocket+3,+Balliwala+Chowk,+Dehradun,+Uttarakhand+248001&output=embed"
                    width="100%" height="150"></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Ayurmax Hospital. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>