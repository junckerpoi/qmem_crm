<?php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pricing | QMĒM CRM</title>
  <meta name="description" content="Choose the QMĒM CRM plan that fits your business. Simple, transparent pricing for every team.">
  <link rel="stylesheet" href="style.css" />
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #1976d2 0%, #fbc02d 100%); margin: 0; }
    .logo { font-size: 2rem; font-weight: bold; color: #fff; margin: 1em 0 0.5em 0; text-align: center; letter-spacing: 2px; }
    nav { text-align: center; margin-bottom: 2em; }
    nav a { color: #1976d2; text-decoration: none; margin: 0 1em; font-weight: 500; transition: color 0.2s; }
    nav a[aria-current="page"], nav a:hover { color: #fff; background: #1976d2; border-radius: 4px; }
    main { max-width: 900px; margin: 2em auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(44,62,80,0.10); padding: 2em 2.5em; }
    h1 { text-align: center; color: #1976d2; }
    .pricing-table { display: flex; gap: 2em; justify-content: center; flex-wrap: wrap; margin: 2em 0; }
    .plan {
      background: #f5fafd; border-radius: 12px; box-shadow: 0 2px 8px rgba(25,118,210,0.08);
      flex: 1 1 220px; min-width: 220px; max-width: 300px; padding: 2em 1.5em; text-align: center;
      border: 2px solid #1976d2; margin-bottom: 1em;
    }
    .plan.featured { border-color: #fbc02d; background: #fffde7; }
    .plan h2 { color: #1976d2; margin-bottom: 0.5em; }
    .plan.featured h2 { color: #fbc02d; }
    .price { font-size: 2em; font-weight: bold; color: #1976d2; margin: 0.5em 0; }
    .plan.featured .price { color: #fbc02d; }
    .plan ul { list-style: none; padding: 0; color: #4a5a6a; margin: 1em 0 2em 0; }
    .plan ul li { margin-bottom: 0.7em; }
    .plan .btn {
      background: #1976d2; color: #fff; padding: 0.7em 2em; border-radius: 6px; text-decoration: none; font-weight: bold; transition: background 0.2s;
      display: inline-block; margin-top: 1em;
    }
    .plan.featured .btn { background: #fbc02d; color: #1976d2; }
    .plan .btn:hover { background: #125ea7; }
    .plan.featured .btn:hover { background: #f9a825; }
    .note { text-align: center; color: #4a5a6a; margin-top: 2em; }
    footer { text-align: center; color: #fff; font-size: 0.95em; margin-top: 2em; padding: 1em 0; background: linear-gradient(90deg, #1976d2 60%, #fbc02d 100%); border-top: 1px solid #e0e7ef; }
    @media (max-width: 700px) { .pricing-table { flex-direction: column; gap: 1em; } }
  </style>
</head>
<body>
  <header>
    <div class="logo">QMĒM</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
      <a href="vacancy.php">Vacancies</a>
      <a href="news.php">News</a>
      <a href="coding.php">Coding</a>
      <a href="pricing.php" aria-current="page">Pricing</a>
      <a href="login.php" style="color:#43a047;font-weight:bold;">Login</a>
      <a href="register.php" style="color:#1976d2;font-weight:bold;">Register</a>
    </nav>
  </header>
  <main>
    <h1>Simple, Transparent Pricing</h1>
    <div class="pricing-table">
      <div class="plan">
        <h2>Starter</h2>
        <div class="price">Free</div>
        <ul>
          <li>Up to 3 users</li>
          <li>100 contacts</li>
          <li>Email support</li>
          <li>Basic analytics</li>
        </ul>
        <a href="register.php" class="btn">Get Started</a>
      </div>
      <div class="plan featured">
        <h2>Pro</h2>
        <div class="price">$19<span style="font-size:0.6em;">/mo</span></div>
        <ul>
          <li>Unlimited users</li>
          <li>Unlimited contacts</li>
          <li>Advanced analytics</li>
          <li>Automation tools</li>
          <li>Priority support</li>
        </ul>
        <a href="register.php" class="btn">Start Free Trial</a>
      </div>
      <div class="plan">
        <h2>Enterprise</h2>
        <div class="price">Custom</div>
        <ul>
          <li>All Pro features</li>
          <li>Dedicated manager</li>
          <li>Custom integrations</li>
          <li>On-premise option</li>
        </ul>
        <a href="contact.php" class="btn">Contact Sales</a>
      </div>
    </div>
    <div class="note">
      All plans include a 14-day free trial. No credit card required.<br>
      <a href="faq.php" style="color:#1976d2;">See FAQ</a>
    </div>
  </main>
  <footer>
    &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
    <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
  </footer>
</body>
</html>