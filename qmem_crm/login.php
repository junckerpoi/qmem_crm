<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'db.php';
$message = "";

// --- Rate limiting ---
if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = [];
// Remove attempts older than 10 minutes
$_SESSION['login_attempts'] = array_filter(
    $_SESSION['login_attempts'],
    fn($t) => $t > (time() - 600)
);
if (count($_SESSION['login_attempts']) >= 5) {
    $message = "Too many failed attempts. Please try again in 10 minutes.";
}

// --- CSRF token generation ---
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// --- CAPTCHA generation ---
if (empty($_SESSION['captcha'])) {
    $a = rand(1, 9); $b = rand(1, 9);
    $_SESSION['captcha'] = [$a, $b, $a + $b];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && !$message) {
    // CSRF check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $message = "Invalid session token. Please refresh and try again.";
    }
    // Honeypot check
    elseif (!empty($_POST['website'])) {
        $message = "Spam detected.";
    }
    // CAPTCHA check
    elseif (empty($_POST['captcha']) || intval($_POST['captcha']) !== $_SESSION['captcha'][2]) {
        $message = "Incorrect CAPTCHA answer.";
        $_SESSION['captcha'] = null; // regenerate next time
        $_SESSION['login_attempts'][] = time();
    } else {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        if (!$stmt) {
            $message = "Database error: " . $conn->error;
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
                session_regenerate_id(true); // Prevent session fixation
                $_SESSION['user_id'] = $id;
                $_SESSION['login_attempts'] = []; // reset on success
                $_SESSION['captcha'] = null;
                // Optionally set a persistent cookie if "Remember me" is checked
                if (!empty($_POST['remember'])) {
                    setcookie("remember_email", $email, time() + (86400 * 30), "/");
                } else {
                    setcookie("remember_email", "", time() - 3600, "/");
                }
                header("Location: admin.php");
                exit;
            } else {
                $message = "Invalid email or password. Please try again.";
                $_SESSION['login_attempts'][] = time();
                $_SESSION['captcha'] = null;
            }
            $stmt->close();
        }
    }
}
$remember_email = $_COOKIE['remember_email'] ?? '';
$captcha = $_SESSION['captcha'] ?? [0,0,0];

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); session_destroy(); header("Location: login.php?timeout=1"); exit;
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Login to your QMĒM CRM account to manage your customers, track leads, and grow your business.">
    <title>Login | QMĒM CRM</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #1976d2 0%, #42a5f5 50%, #fbc02d 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .logo {
            font-size: 2.2rem;
            font-weight: bold;
            color: #fff;
            margin: 1.5em 0 0.5em 0;
            text-align: center;
            letter-spacing: 2px;
            text-shadow: 0 2px 8px rgba(25,118,210,0.15);
        }
        .container {
            max-width: 400px;
            margin: 3em auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.18);
            padding: 2.5em 2.5em 2em 2.5em;
            border: 2px solid #1976d2;
        }
        h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 0.5em;
            letter-spacing: 1px;
        }
        .intro {
            color: #4a5a6a;
            font-size: 1.08em;
            margin-bottom: 1.5em;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
        input[type="email"], input[type="password"], input[type="number"] {
            padding: 0.75em;
            border: 1.5px solid #90caf9;
            border-radius: 8px;
            font-size: 1em;
            transition: border 0.2s, box-shadow 0.2s;
            background: #f5fafd;
        }
        input[type="email"]:focus, input[type="password"]:focus, input[type="number"]:focus {
            border-color: #1976d2;
            outline: none;
            box-shadow: 0 0 0 2px #bbdefb;
        }
        button {
            padding: 0.75em;
            background: linear-gradient(90deg, #1976d2 60%, #fbc02d 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(25,118,210,0.08);
        }
        button:hover {
            background: linear-gradient(90deg, #1565c0 60%, #f9a825 100%);
        }
        .error {
            color: #d32f2f;
            background: #ffeaea;
            border: 1px solid #ffcdd2;
            border-radius: 4px;
            padding: 0.5em;
            margin-top: 1em;
            text-align: center;
        }
        .success {
            background: #e8f5e9;
            color: #388e3c;
            border: 1px solid #c8e6c9;
            border-radius: 4px;
            padding: 0.5em;
            margin-top: 1em;
            text-align: center;
        }
        label {
            font-weight: 500;
            margin-bottom: 0.2em;
            display: block;
            color: #1976d2;
        }
        .nav {
            text-align: center;
            margin-bottom: 2em;
        }
        .nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 1em;
            font-weight: 500;
            transition: color 0.2s, background 0.2s;
            padding: 0.3em 0.8em;
            border-radius: 4px;
        }
        .nav a[aria-current="page"], .nav a:hover {
            background: #1976d2;
            color: #fff;
        }
        .footer {
            text-align: center;
            color: #fff;
            font-size: 0.95em;
            margin-top: 2em;
            text-shadow: 0 1px 4px rgba(25,118,210,0.15);
        }
        .captcha-label { margin-top: 1em; color: #1976d2; }
        .captcha-input { width: 80px; display: inline-block; }
        .captcha-q { font-weight: 500; margin-right: 0.5em; }
        .invalid { border-color: #d32f2f !important; background: #fff3f3; }
        @media (max-width: 600px) {
            .container { padding: 1em; }
            .logo { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="logo">QMĒM</div>
    <nav class="nav">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="vacancy.php">Vacancies</a>
        <a href="news.php">News</a>
        <a href="coding.php">Coding</a>
        <a href="login.php" aria-current="page">Login</a>
        <a href="register.php">Register</a>
    </nav>
    <div class="container">
        <h2>Welcome Back</h2>
        <div class="intro">
            <p>
                Sign in to your QMĒM CRM account to manage your customers, track leads, and grow your business. 
                Our secure platform helps you stay organized and productive every day.
            </p>
            <p>
                New to QMĒM CRM? <a href="contact.php" style="color:#1976d2;text-decoration:underline;">Contact us</a> to request access.
            </p>
        </div>
        <form method="POST" autocomplete="off" id="loginForm">
            <label for="email">Email address</label>
            <input type="email" name="email" id="email" placeholder="Email address" required value="<?php echo htmlspecialchars($remember_email); ?>">
            <span id="emailFeedback" style="color:#d32f2f;font-size:0.95em;"></span>
            <label for="password">Password</label>
            <div style="position:relative;">
                <input type="password" name="password" id="password" placeholder="Password" required style="width:100%;">
                <button type="button" id="togglePassword" aria-label="Show or hide password" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:#1976d2;cursor:pointer;font-size:0.95em;">Show</button>
            </div>
            <div style="display:flex;align-items:center;gap:0.5em;">
                <input type="checkbox" name="remember" id="remember" <?php if($remember_email) echo "checked"; ?>>
                <label for="remember" style="font-weight:400;display:inline;">Remember me</label>
            </div>
            <!-- Honeypot field -->
            <input type="text" name="website" style="display:none">
            <!-- CAPTCHA -->
            <label class="captcha-label" for="captcha">
                <span class="captcha-q">What is <?php echo $captcha[0]; ?> + <?php echo $captcha[1]; ?>?</span>
                <input type="number" name="captcha" id="captcha" class="captcha-input" required>
            </label>
            <!-- CSRF token -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" id="loginBtn">Login</button>
            <div style="display:flex;justify-content:space-between;margin-top:0.5em;">
                <a href="forgot.php" style="color:#1976d2;text-decoration:underline;font-size:0.95em;">Forgot Password?</a>
                <a href="register.php" style="color:#1976d2;text-decoration:underline;font-size:0.95em;">Register</a>
            </div>
        </form>
        <?php if ($message): ?>
            <div class="<?php echo strpos($message, 'success') !== false ? 'success' : 'error'; ?>" role="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <script>
        // Password toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwd = document.getElementById('password');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                this.textContent = 'Hide';
            } else {
                pwd.type = 'password';
                this.textContent = 'Show';
            }
        });
        // Real-time email validation
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const feedback = document.getElementById('emailFeedback');
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!re.test(email)) {
                feedback.textContent = "Please enter a valid email address.";
                this.classList.add('invalid');
            } else {
                feedback.textContent = "";
                this.classList.remove('invalid');
            }
        });
        // Loading indicator on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            document.getElementById('loginBtn').textContent = "Logging in...";
            document.getElementById('loginBtn').disabled = true;
        });
        </script>
    </div>
    <div class="footer">
        &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
        <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
    </div>
</body>
</html>
