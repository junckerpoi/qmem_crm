<?php
// filepath: c:\Users\mamun\OneDrive\Desktop\web_prog\htdocs\qmem_crm\profile.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

// Fetch user info
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

$success = $error = "";

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['name']);
    $new_email = trim($_POST['email']);
    $new_pass = $_POST['password'];
    $update_query = "UPDATE users SET name=?, email=?";
    $params = [$new_name, $new_email];
    $types = "ss";
    if ($new_pass) {
        $update_query .= ", password=?";
        $params[] = password_hash($new_pass, PASSWORD_DEFAULT);
        $types .= "s";
    }
    $update_query .= " WHERE id=?";
    $params[] = $_SESSION['user_id'];
    $types .= "i";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        $success = "Profile updated successfully.";
        $name = $new_name;
        $email = $new_email;
    } else {
        $error = "Failed to update profile.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Profile | QMĒM CRM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; margin: 0; }
        main { max-width: 500px; margin: 2em auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
        h2 { text-align: center; color: #1976d2; }
        form { display: flex; flex-direction: column; gap: 1em; }
        label { font-weight: 500; }
        input { padding: 0.7em; border: 1px solid #cfd8dc; border-radius: 6px; font-size: 1em; }
        button { padding: 0.75em; background: #1976d2; color: #fff; border: none; border-radius: 6px; font-size: 1em; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        button:hover { background: #125ea7; }
        .message { margin: 1em 0; padding: 0.75em; border-radius: 6px; text-align: center; }
        .success { background: #e8f5e9; color: #388e3c; border: 1px solid #c8e6c9; }
        .error { background: #ffeaea; color: #d32f2f; border: 1px solid #ffcdd2; }
        .back-link { display: block; text-align: center; margin-top: 2em; color: #1976d2; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <main>
        <h2>Your Profile</h2>
        <?php if ($success): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php elseif ($error): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="profile.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <label for="password">New Password <span style="color:#888;font-size:0.95em;">(leave blank to keep current)</span></label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            <button type="submit">Update Profile</button>
        </form>
        <a href="admin.php" class="back-link">&larr; Back to Dashboard</a>
    </main>
</body>
</html>