<?php
// Include the config.php file
include('config.php');

// Secure SQL Queries using prepared statements
$stmt = $conn->prepare("SELECT * FROM blogs WHERE status = ? ORDER BY created_at DESC");
$status = 'published';
$stmt->bind_param("s", $status); // "s" means string
$stmt->execute();
$blogs_result = $stmt->get_result();

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
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
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Ayurmax Hospital Blog">
    <meta property="og:description"
        content="Discover expert insights, wellness tips, and Ayurvedic health practices on our blog.">
    <meta property="og:image" content="assets/img/logo ayurmax.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.ayurmaxhospital.com/blog">

    <link rel="icon" type="image/png" href="assets/img/fevicon.png">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/doctor.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>Ayurmax Hospital Blog - Health & Wellness Tips</title>
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

    <section class="blog-intro">
        <div class="blog-intro-content">
            <div class="intro-image">
                <img src="https://content.jdmagicbox.com/comp/dehradun/t3/9999px135.x135.170212113002.x9t3/catalogue/ayurmax-hospital-dehradun-city-dehradun-hospitals-ip8zqnb7ee.jpg?clr=#4d4d1a?fit=around|270:130&crop=270:130%3B*%2C*"
                    alt="Ayurmax Hospital" />
            </div>
            <div class="intro-text">
                <h1>Ayurmax Hospital Blog</h1>
                <p>Welcome to the Ayurmax Hospital blog, your go-to source for insights on Ayurveda, wellness, and
                    health practices. Stay informed with the latest trends in holistic health and expert advice from our
                    experienced team.</p>
            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="blogs">
            <h2>Your Blogs</h2>
            <div class="blog-posts">
                <?php
                if ($blogs_result->num_rows > 0) {
                    while ($row = $blogs_result->fetch_assoc()) {
                        echo '<article class="blog-post">';
                        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                        echo '<p>' . substr(htmlspecialchars($row['content']), 0, 250) . '...</p>';
                        echo '<a href="blog-post.php?id=' . intval($row['id']) . '" class="read-more-btn">Read More</a>';
                        echo '</article>';
                    }
                } else {
                    echo '<h3>No blogs available.</h3>';
                }
                ?>
            </div>
        </div>
    </section>

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
                    width="100%" height="150" style="border: 0;" allowfullscreen></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Ayurmax Hospital. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>