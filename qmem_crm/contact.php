<?php
session_start();
// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Contact QMĒM CRM for support, sales, or partnership inquiries. We're here to help your business grow.">
  <meta property="og:title" content="Contact Us | QMĒM CRM">
  <meta property="og:description" content="Contact QMĒM CRM for support, sales, or partnership inquiries. We're here to help your business grow.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://yourdomain.com/contact.php">
  <meta property="og:image" content="https://yourdomain.com/logo.png">
  <title>Contact Us | QMĒM CRM</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; margin: 0; }
    .logo { font-size: 2rem; font-weight: bold; color: #2d3e50; margin: 1em 0 0.5em 0; text-align: center; letter-spacing: 2px; }
    nav { text-align: center; margin-bottom: 2em; }
    nav a { color: #1976d2; text-decoration: none; margin: 0 1em; font-weight: 500; transition: color 0.2s; }
    nav a:hover { color: #125ea7; }
    main { max-width: 600px; margin: 2em auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
    form { display: flex; flex-direction: column; gap: 1em; }
    label { font-weight: 500; margin-bottom: 0.2em; }
    input, textarea, select { padding: 0.75em; border: 1px solid #cfd8dc; border-radius: 6px; font-size: 1em; }
    button { padding: 0.75em; background: #1976d2; color: #fff; border: none; border-radius: 6px; font-size: 1em; font-weight: bold; cursor: pointer; transition: background 0.2s; }
    button:hover { background: #125ea7; }
    .contact-info { margin: 2em 0 1em 0; color: #4a5a6a; }
    .contact-info div { margin-bottom: 0.5em; }
    .social { margin-top: 1em; }
    .social a { margin: 0 0.5em; color: #1976d2; text-decoration: none; font-size: 1.2em; }
    .social a:hover { color: #125ea7; }
    .message { margin: 1em 0; padding: 0.75em; border-radius: 6px; text-align: center; }
    .success { background: #e8f5e9; color: #388e3c; border: 1px solid #c8e6c9; }
    .error { background: #ffeaea; color: #d32f2f; border: 1px solid #ffcdd2; }
    .newsletter { margin: 2em 0 0 0; text-align: center; }
    .newsletter input[type="email"] { padding: 0.5em; border: 1px solid #cfd8dc; border-radius: 4px; margin-right: 0.5em; }
    .newsletter button { padding: 0.5em 1.5em; background: #1976d2; color: #fff; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
    .newsletter button:hover { background: #125ea7; }
    .map { margin: 2em 0; border-radius: 10px; overflow: hidden; }
    .aria-live { min-height: 1.5em; }
    @media (max-width: 700px) { main { padding: 1em; } }
  </style>
</head>
<body>
  <header>
    <div class="logo">QMĒM</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="contact.php" aria-current="page">Contact</a>
      <a href="vacancy.php">Vacancies</a>
      <a href="news.php">News</a>
      <a href="coding.php">Coding</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>
  <main>
    <h2>Contact Us</h2>
    <div class="contact-info" itemscope itemtype="https://schema.org/Organization">
      <div><strong>Email:</strong> <a href="mailto:mamunate60@gmail.com" itemprop="email">mamunate60@gmail.com</a></div>
      <div><strong>Phone:</strong> <a href="tel:+251907964994" itemprop="telephone">+251907964994</a></div>
      <div><strong>Address:</strong> <span itemprop="address">123 Business Ave, Suite 100, City, Country</span></div>
    </div>
    <div class="map">
      <iframe src="https://maps.google.com/maps?q=123%20Business%20Ave%20City&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-label="Map"></iframe>
    </div>
    <!-- Feedback message (simulate with PHP GET for demo) -->
    <div id="feedback" class="aria-live" aria-live="polite">
      <?php if (isset($_GET['success'])): ?>
        <div class="message success" role="alert">Thank you! Your message has been sent. We’ll reply soon.</div>
      <?php elseif (isset($_GET['error'])): ?>
        <div class="message error" role="alert">Sorry, there was a problem sending your message. Please try again.</div>
      <?php endif; ?>
    </div>
    <form action="submit.php" method="POST" aria-label="Contact form" id="contactForm" novalidate>
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" required aria-required="true"/>
      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" required aria-required="true"/>
      <label for="reason">Reason for Contact</label>
      <select id="reason" name="reason" required aria-required="true">
        <option value="">Select a reason</option>
        <option value="Support">Support</option>
        <option value="Sales">Sales</option>
        <option value="Partnership">Partnership</option>
        <option value="Other">Other</option>
      </select>
      <label for="message">Your Message</label>
      <textarea id="message" name="message" rows="5" required aria-required="true"></textarea>
      <!-- Simple anti-spam honeypot -->
      <input type="text" name="website" style="display:none">
      <!-- CSRF token -->
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <button type="submit" id="submitBtn">Send Message</button>
    </form>
    <!-- FAQ Section -->
    <section class="faq" style="max-width:700px;margin:2em auto;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(25,118,210,0.08);padding:2em;">
      <h2 style="color:#1976d2;">Frequently Asked Questions</h2>
      <div class="faq-item" style="margin-bottom:1.2em;">
        <div class="faq-q" style="font-weight:bold;color:#1976d2;">How quickly will I get a response?</div>
        <div class="faq-a" style="color:#4a5a6a;margin-top:0.3em;">We aim to respond to all inquiries within 24 hours, Monday to Friday.</div>
      </div>
      <div class="faq-item" style="margin-bottom:1.2em;">
        <div class="faq-q" style="font-weight:bold;color:#1976d2;">Can I request a demo?</div>
        <div class="faq-a" style="color:#4a5a6a;margin-top:0.3em;">Absolutely! Just mention "demo request" in your message and we’ll schedule a session.</div>
      </div>
      <div class="faq-item" style="margin-bottom:1.2em;">
        <div class="faq-q" style="font-weight:bold;color:#1976d2;">Is my information safe?</div>
        <div class="faq-a" style="color:#4a5a6a;margin-top:0.3em;">Yes, we use industry-standard security to protect your data.</div>
      </div>
    </section>

    <!-- Newsletter Signup Section -->
    <section class="newsletter" style="background:#fffde7;border-radius:10px;box-shadow:0 2px 8px rgba(251,192,45,0.08);max-width:500px;margin:2em auto;padding:2em 1em;text-align:center;">
      <h2 style="color:#1976d2;">Subscribe for Updates</h2>
      <form method="post" action="#">
        <input type="email" name="newsletter_email" placeholder="Your email address" aria-label="Email address" required style="padding:0.7em;border:1px solid #cfd8dc;border-radius:6px;font-size:1em;width:60%;max-width:220px;margin-right:0.5em;">
        <button type="submit" style="padding:0.7em 1.5em;background:#1976d2;color:#fff;border:none;border-radius:6px;font-weight:bold;cursor:pointer;transition:background 0.2s;">Subscribe</button>
      </form>
      <div style="font-size:0.95em;color:#90a4ae;margin-top:0.5em;">No spam. Unsubscribe anytime.</div>
    </section>
    <div class="social" aria-label="Social links">
      <a href="https://facebook.com/" target="_blank" rel="noopener" title="Facebook"><img src="https://img.icons8.com/color/32/000000/facebook.png" alt="Facebook"></a>
      <a href="https://linkedin.com/" target="_blank" rel="noopener" title="LinkedIn"><img src="https://img.icons8.com/color/32/000000/linkedin.png" alt="LinkedIn"></a>
      <a href="https://twitter.com/" target="_blank" rel="noopener" title="Twitter"><img src="https://img.icons8.com/color/32/000000/twitter.png" alt="Twitter"></a>
    </div>
  </main>
  <footer>
    &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved.
  </footer>
  <script>
    // Real-time validation
    document.getElementById('contactForm').addEventListener('input', function(e) {
      let valid = true;
      let email = document.getElementById('email');
      let name = document.getElementById('name');
      let reason = document.getElementById('reason');
      let message = document.getElementById('message');
      let feedback = document.getElementById('feedback');
      if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        email.style.borderColor = "#d32f2f";
        valid = false;
      } else {
        email.style.borderColor = "";
      }
      if (!name.value.trim()) {
        name.style.borderColor = "#d32f2f";
        valid = false;
      } else {
        name.style.borderColor = "";
      }
      if (!reason.value) {
        reason.style.borderColor = "#d32f2f";
        valid = false;
      } else {
        reason.style.borderColor = "";
      }
      if (!message.value.trim()) {
        message.style.borderColor = "#d32f2f";
        valid = false;
      } else {
        message.style.borderColor = "";
      }
      feedback.textContent = valid ? "" : "Please fill all fields with valid information.";
    });
    // Loading indicator
    document.getElementById('contactForm').addEventListener('submit', function() {
      document.getElementById('submitBtn').textContent = "Sending...";
      document.getElementById('submitBtn').disabled = true;
    });
  </script>
  <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
    $email = filter_var(trim($_POST['newsletter_email']), FILTER_VALIDATE_EMAIL);
    if ($email) {
        // Save to DB or send to your newsletter service here
        $newsletter_message = "Thank you for subscribing!";
    } else {
        $newsletter_message = "Please enter a valid email address.";
    }
}
?>
<?php if (isset($newsletter_message)): ?>
  <div style="text-align:center;margin:1em 0;color:#1976d2;"><?php echo $newsletter_message; ?></div>
<?php endif; ?>
</body>
</html>
