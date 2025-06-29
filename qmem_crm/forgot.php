<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // In a real app, send a reset link by email here.
        $message = "If this email is registered, a password reset link will be sent.";
    } else {
        $message = "If this email is registered, a password reset link will be sent.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Forgot Password | QMĒM CRM</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        <?php include 'login.php'; // Reuse the same style block ?>
    </style>
</head>
<body>
    <div class="logo">QMĒM</div>
    <div class="container">
        <h2>Forgot Password</h2>
        <div class="intro">
            <p>Enter your email address and we'll send you instructions to reset your password.</p>
        </div>
        <form method="POST" autocomplete="off">
            <input type="email" name="email" placeholder="Email address" required>
            <button type="submit">Send Reset Link</button>
            <div style="margin-top:0.5em;">
                <a href="login.php" style="color:#1976d2;text-decoration:underline;font-size:0.95em;">Back to Login</a>
            </div>
        </form>
        <?php if ($message): ?>
            <div class="error" role="alert"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
    <div class="footer">
        &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved.
    </div>
</body>
</html>