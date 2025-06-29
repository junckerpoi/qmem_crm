<?php
// Basic validation and spam protection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot field (should be empty)
    if (!empty($_POST['website'])) {
        header("Location: contact.php?error=spam");
        exit;
    }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate fields
    if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=validation");
        exit;
    }

    // Optionally, send an email (uncomment and configure below)
    /*
    $to = "support@qmemcrm.com";
    $subject = "New Contact Form Message from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\n";
    if (!mail($to, $subject, $body, $headers)) {
        header("Location: contact.php?error=mail");
        exit;
    }
    */

    // Optionally, save to database or log file here

    // Redirect with success
    header("Location: contact.php?success=1");
    exit;
} else {
    // Invalid request
    header("Location: contact.php");
    exit;
}
?>
