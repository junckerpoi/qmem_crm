<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

// Check for session timeout (30 minutes)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); session_destroy(); header("Location: login.php?timeout=1"); exit;
}
$_SESSION['LAST_ACTIVITY'] = time();

// Fetch user email for personalized greeting
$user_email = '';
$stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($user_email);
$stmt->fetch();
$stmt->close();

// Example: Fetch dashboard stats (replace with real queries)
$total_users = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];

// Fetch real stats
$total_contacts = $conn->query("SELECT COUNT(*) FROM contacts")->fetch_row()[0];
$total_news = $conn->query("SELECT COUNT(*) FROM news")->fetch_row()[0];
$total_vacancies = $conn->query("SELECT COUNT(*) FROM vacancies")->fetch_row()[0];

// New leads this week
$new_leads = $conn->query("SELECT COUNT(*) FROM leads WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)")->fetch_row()[0];

// Recent activity (last 5 actions)
$recent_activity = [];
$res = $conn->query("SELECT action, created_at FROM activity_log ORDER BY created_at DESC LIMIT 5");
while ($row = $res->fetch_assoc()) {
    $recent_activity[] = $row;
}

// Fetch notifications
$notifications = [];
$res = $conn->prepare("SELECT message, created_at FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC LIMIT 5");
$res->bind_param("i", $_SESSION['user_id']);
$res->execute();
$result = $res->get_result();
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Admin dashboard for QMĒM CRM. Manage users, contacts, news, and more.">
    <meta property="og:title" content="Admin Dashboard | QMĒM CRM">
    <title>Admin Dashboard | QMĒM CRM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; margin: 0; }
        .logo { font-size: 2rem; font-weight: bold; color: #2d3e50; margin: 1em 0 0.5em 0; text-align: center; letter-spacing: 2px; }
        nav { text-align: center; margin-bottom: 2em; }
        nav a { color: #1976d2; text-decoration: none; margin: 0 1em; font-weight: 500; transition: color 0.2s; }
        nav a:hover { color: #125ea7; }
        main { max-width: 900px; margin: 2em auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
        .greeting { font-size: 1.2em; margin-bottom: 1.5em; }
        .dashboard-widgets { display: flex; gap: 2em; flex-wrap: wrap; margin-bottom: 2em; }
        .widget { flex: 1 1 200px; background: #e3f2fd; border-radius: 8px; padding: 1.5em; text-align: center; box-shadow: 0 2px 8px rgba(25,118,210,0.08); }
        .widget h3 { margin: 0 0 0.5em 0; color: #1976d2; }
        .quick-links { margin-top: 2em; }
        .quick-links a { display: inline-block; margin: 0.5em 1em 0.5em 0; color: #fff; background: #1976d2; padding: 0.6em 1.5em; border-radius: 5px; text-decoration: none; font-weight: 500; transition: background 0.2s; }
        .quick-links a:hover { background: #125ea7; }
        .logout-link { float: right; color: #d32f2f; background: #ffeaea; border-radius: 4px; padding: 0.4em 1em; text-decoration: none; font-weight: 500; margin-top: -2.5em; margin-right: 1em; }
        .logout-link:hover { background: #ffcdd2; }
        footer { text-align: center; color: #90a4ae; font-size: 0.95em; margin-top: 2em; }
        @media (max-width: 700px) {
            .dashboard-widgets { flex-direction: column; gap: 1em; }
            main { padding: 1em; }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">QMĒM</div>
        <nav>
            <a href="admin.php">Dashboard</a>
            <a href="users.php">Users</a>
            <a href="contacts.php">Contacts</a>
            <a href="news.php">News</a>
            <a href="vacancy.php">Vacancies</a>
            <a href="about.php">About</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </nav>
    </header>
    <main role="main">
        <div class="greeting">
            Welcome, <strong><?php echo htmlspecialchars($user_email); ?></strong>! You are logged in as an administrator.
        </div>
        <section class="dashboard-widgets">
            <div class="widget">
                <h3>Total Users</h3>
                <div style="font-size:2em;font-weight:bold;"><?php echo $total_users; ?></div>
            </div>
            <div class="widget">
                <h3>Total Contacts</h3>
                <div style="font-size:2em;font-weight:bold;"><?php echo $total_contacts; ?></div>
            </div>
            <div class="widget">
                <h3>Total News</h3>
                <div style="font-size:2em;font-weight:bold;"><?php echo $total_news; ?></div>
            </div>
            <div class="widget">
                <h3>Total Vacancies</h3>
                <div style="font-size:2em;font-weight:bold;"><?php echo $total_vacancies; ?></div>
            </div>
            <div class="widget">
                <h3>New Leads (This Week)</h3>
                <div style="font-size:2em;font-weight:bold;"><?php echo $new_leads; ?></div>
            </div>
            <div class="widget">
                <h3>Recent Activity</h3>
                <?php if ($recent_activity): ?>
                    <ul style="text-align:left;">
                        <?php foreach ($recent_activity as $act): ?>
                            <li><?php echo htmlspecialchars($act['action']); ?> <span style="color:#888;"><?php echo $act['created_at']; ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div style="font-size:1em;color:#4a5a6a;">No recent activity.</div>
                <?php endif; ?>
            </div>
        </section>
        <section class="quick-links">
            <a href="users.php">Manage Users</a>
            <a href="contacts.php">Manage Contacts</a>
            <a href="news.php">View News</a>
            <a href="vacancy.php">Post Vacancy</a>
        </section>
        <span style="position:relative;">
          <button id="notifBtn" style="background:none;border:none;font-size:1.2em;cursor:pointer;">🔔<?php if(count($notifications)) echo '<span style="color:red;">●</span>'; ?></button>
          <div id="notifDropdown" style="display:none;position:absolute;right:0;background:#fff;border:1px solid #ccc;padding:1em;z-index:10;">
            <?php foreach ($notifications as $notif): ?>
              <div><?php echo htmlspecialchars($notif['message']); ?> <span style="color:#888;"><?php echo $notif['created_at']; ?></span></div>
            <?php endforeach; ?>
            <?php if (!count($notifications)) echo "<div>No new notifications.</div>"; ?>
          </div>
        </span>
        <script>
        document.getElementById('notifBtn').onclick = function() {
            var d = document.getElementById('notifDropdown');
            d.style.display = d.style.display === 'block' ? 'none' : 'block';
        };
        </script>
    </main>
    <footer>
        &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved.
    </footer>
</body>
</html>
