<?php
// config.php
// Set environment to production
ini_set('display_errors', 0);  // Disable error display
ini_set('log_errors', 1);      // Enable error logging
ini_set('error_log', '/files/public_html/error_log.txt');  // Log errors (modify as needed)

// Database credentials from environment variables
$servername = getenv('DB_SERVER') ?: '127.0.0.1';
$port       = getenv('DB_PORT') ?: '3306';
$username   = getenv('DB_USERNAME') ?: 'u700105630_admin';
$password   = getenv('DB_PASSWORD') ?: 'Ayurmax@1234#';
$dbname     = getenv('DB_NAME') ?: 'u700105630_admin';

// Create a secure database connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed.");
}

?>