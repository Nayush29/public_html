<?php
// Retrieve the payload sent by GitHub
$payload = json_decode(file_get_contents('php://input'), true);

// Check if the event is a push event on the 'main' branch
if ($payload['ref'] == 'refs/heads/main') {
    // Change to the directory where your website files are located on Hostinger
    chdir('/home/u700105630/public_html'); // Replace with your actual path

    // Pull the latest changes from GitHub
    exec('git pull origin main', $output, $status);

    // Check for errors in the git pull
    if ($status === 0) {
        echo 'Deployment successful!';
    } else {
        echo 'Deployment failed. Error: ' . implode("\n", $output);
    }
} else {
    echo 'Not a push event on the main branch.';
}
?>
