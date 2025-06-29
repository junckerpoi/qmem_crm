<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'db.php';
$message = "";
$success = false;

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $message = "Invalid session token. Please refresh and try again.";
    }
    // Honeypot check
    elseif (!empty($_POST['website'])) {
        $message = "Spam detected.";
    }
    // Terms agreement check
    elseif (empty($_POST['terms'])) {
        $message = "You must agree to the terms and privacy policy.";
    } else {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        // Password strength check
        if ($password !== $confirm) {
            $message = "Passwords do not match.";
        } elseif (strlen($password) < 8 || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
            $message = "Password must be at least 8 characters and include a number and a symbol.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email address.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $message = "Email already registered.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $hash);
                if ($stmt->execute()) {
                    $success = true;
                    $message = "Registration successful! You can now <a href='login.php'>login</a>.";
                } else {
                    $message = "Registration failed. Please try again.";
                }
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Create your QMĒM CRM account and start managing your customers efficiently.">
    <title>Register | QMĒM CRM</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .container { max-width: 400px; margin: 3em auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
        .intro { color: #4a5a6a; font-size: 1.05em; margin-bottom: 1.5em; text-align: center; }
        .footer { text-align: center; color: #90a4ae; font-size: 0.95em; margin-top: 2em; }
        .success { background: #e8f5e9; color: #388e3c; border: 1px solid #c8e6c9; }
        .error { background: #ffeaea; color: #d32f2f; border: 1px solid #ffcdd2; }
        label { display: block; margin-top: 1em; margin-bottom: 0.2em; font-weight: 500; }
        .terms { font-size: 0.95em; margin-top: 1em; }
        nav { text-align: center; margin-bottom: 2em; }
        nav a { color: #1976d2; text-decoration: none; margin: 0 1em; font-weight: 500; transition: color 0.2s; }
        nav a:hover { color: #125ea7; }
    </style>
    <script>
    // Basic client-side password strength feedback
    function checkPasswordStrength() {
        var pwd = document.getElementById('password').value;
        var msg = '';
        if (pwd.length < 8) msg = 'At least 8 characters. ';
        if (!/[0-9]/.test(pwd)) msg += 'Include a number. ';
        if (!/[\W_]/.test(pwd)) msg += 'Include a symbol. ';
        document.getElementById('pwdHelp').textContent = msg;
    }
    </script>
</head>
<body>
    <div class="logo">QMĒM</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
        <a href="register.php" aria-current="page">Register</a>
    </nav>
    <div class="container">
        <h2>Create Your Account</h2>
        <div class="intro">
            <p>Register to access QMĒM CRM and start managing your customers efficiently.</p>
        </div>
        <form method="POST" autocomplete="off">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required oninput="checkPasswordStrength()">
            <div id="pwdHelp" style="color:#d32f2f;font-size:0.95em;"></div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <!-- Honeypot field -->
            <input type="text" name="website" style="display:none">
            <!-- CSRF token -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="terms">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms" style="display:inline;font-weight:400;">I agree to the <a href="privacy.php" target="_blank">Privacy Policy</a> and <a href="terms.php" target="_blank">Terms of Service</a>.</label>
            </div>
            <button type="submit">Register</button>
            <div style="margin-top:0.5em;">
                <a href="login.php" style="color:#1976d2;text-decoration:underline;font-size:0.95em;">Already have an account? Login</a>
            </div>
        </form>
        <?php if ($message): ?>
            <div class="<?php echo $success ? 'success' : 'error'; ?>" role="alert"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
    <div class="footer">
        &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
        <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
    </div>
</body>
</html>