<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="QMĒM CRM helps you streamline sales, manage leads, and grow your business with a modern, intelligent CRM platform.">
  <meta property="og:title" content="QMĒM Technologies - Home">
  <meta property="og:description" content="Streamline sales, manage leads, and grow your business with QMĒM CRM.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://yourdomain.com/">
  <meta property="og:image" content="https://yourdomain.com/your-screenshot.png">
  <link rel="icon" type="image/png" href="favicon.png">
  <title>QMĒM Technologies - Home</title>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXX"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXX');
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "QMĒM Technologies",
    "url": "https://yourdomain.com/",
    "logo": "https://yourdomain.com/logo.png",
    "sameAs": [
      "https://facebook.com/",
      "https://linkedin.com/",
      "https://twitter.com/"
    ]
  }
  </script>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #1976d2 0%, #42a5f5 50%, #fbc02d 100%);
      margin: 0;
      min-height: 100vh;
    }
    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: #fff;
      margin: 1em 0 0.5em 0;
      text-align: center;
      letter-spacing: 2px;
      text-shadow: 0 2px 8px rgba(25,118,210,0.15);
    }
    nav {
      position: sticky;
      top: 0;
      background: rgba(255,255,255,0.97);
      box-shadow: 0 2px 8px rgba(25,118,210,0.06);
      z-index: 100;
      text-align: center;
      margin-bottom: 2em;
      padding: 0.5em 0;
    }
    nav a {
      color: #1976d2;
      text-decoration: none;
      margin: 0 1em;
      font-weight: 500;
      transition: color 0.2s, background 0.2s;
      padding: 0.3em 0.8em;
      border-radius: 4px;
    }
    nav a[aria-current="page"], nav a:hover {
      background: #1976d2;
      color: #fff;
    }
    .hero {
      background: linear-gradient(120deg, #e3f2fd 0%, #f0f4f8 100%);
      padding: 3em 1em 2em 1em;
      text-align: center;
      border-radius: 0 0 24px 24px;
    }
    .hero h1 { font-size: 2.5em; color: #1976d2; margin-bottom: 0.5em; }
    .hero span { color: #43a047; }
    .hero p { font-size: 1.2em; color: #4a5a6a; margin-bottom: 1.5em; }
    .hero .cta {
      display: flex; justify-content: center; gap: 1em; flex-wrap: wrap;
    }
    .hero .btn {
      background: #1976d2;
      color: #fff;
      padding: 0.75em 2em;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.2s;
      margin-bottom: 0.5em;
      display: inline-block;
    }
    .hero .btn.alt { background: #43a047; }
    .hero .btn:hover { background: #125ea7; }
    .hero .btn.alt:hover { background: #2e7031; }
    .product-demo {
      max-width: 900px; margin: 2em auto; text-align: center;
    }
    .product-demo img {
      width: 90%; max-width: 700px; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.12);
      margin-bottom: 1em;
    }
    .video-demo {
      margin: 2em auto; text-align: center;
    }
    .video-demo iframe {
      width: 90%; max-width: 700px; height: 350px; border-radius: 12px; border: none;
      box-shadow: 0 4px 24px rgba(44,62,80,0.12);
    }
    .customer-logos {
      display: flex; justify-content: center; gap: 2em; flex-wrap: wrap; margin: 2em 0;
      align-items: center;
    }
    .customer-logos img {
      height: 48px; opacity: 0.8; transition: opacity 0.2s;
    }
    .customer-logos img:hover { opacity: 1; }
    section.features {
      max-width: 900px; margin: 3em auto 2em auto; display: flex; gap: 2em; flex-wrap: wrap; justify-content: center;
    }
    .feature {
      background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08);
      flex: 1 1 220px; min-width: 220px; max-width: 280px; padding: 2em 1em; text-align: center;
    }
    .feature img { width: 48px; height: 48px; margin-bottom: 1em; }
    .feature h3 { color: #1976d2; margin-bottom: 0.5em; }
    .feature p { color: #4a5a6a; font-size: 1em; }
    .newsletter {
      background: #fffde7; border-radius: 10px; box-shadow: 0 2px 8px rgba(251,192,45,0.08);
      max-width: 500px; margin: 2em auto; padding: 2em 1em; text-align: center;
    }
    .newsletter input[type="email"] {
      padding: 0.7em; border: 1px solid #cfd8dc; border-radius: 6px; font-size: 1em; width: 60%; max-width: 220px;
      margin-right: 0.5em;
    }
    .newsletter button {
      padding: 0.7em 1.5em; background: #1976d2; color: #fff; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;
      transition: background 0.2s;
    }
    .newsletter button:hover { background: #125ea7; }
    section.testimonials {
      max-width: 900px; margin: 2em auto; text-align: center;
    }
    .testimonial {
      background: #e3f2fd; border-radius: 10px; padding: 1.5em; margin: 1em auto; max-width: 600px;
      font-style: italic; color: #2d3e50;
    }
    .testimonial .author { margin-top: 1em; font-weight: bold; color: #1976d2; }
    .faq {
      max-width: 700px; margin: 2em auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08); padding: 2em;
    }
    .faq h2 { color: #1976d2; }
    .faq-item { margin-bottom: 1.2em; }
    .faq-q { font-weight: bold; color: #1976d2; }
    .faq-a { color: #4a5a6a; margin-top: 0.3em; }
    .back-to-top {
      position: fixed; bottom: 30px; right: 30px; background: #1976d2; color: #fff; border: none; border-radius: 50%;
      width: 48px; height: 48px; font-size: 2em; cursor: pointer; box-shadow: 0 2px 8px rgba(25,118,210,0.18); display: none; z-index: 200;
    }
    footer {
      text-align: center; color: #fff; font-size: 0.95em; margin-top: 2em; padding: 1em 0;
      background: linear-gradient(90deg, #1976d2 60%, #fbc02d 100%);
      border-top: 1px solid #e0e7ef;
    }
    @media (max-width: 700px) {
      section.features { flex-direction: column; gap: 1em; }
      .hero h1 { font-size: 2em; }
      .product-demo img, .video-demo iframe { width: 100%; }
      .customer-logos { gap: 1em; }
    }
    @media (max-width: 800px) {
      nav#mainNav { position: relative; }
      nav#mainNav #menuToggle {
        display: inline-block;
        position: absolute;
        top: 0.7em;
        left: 1em;
        z-index: 201;
      }
      nav#mainNav #navLinks {
        display: none;
        flex-direction: column;
        background: #fff;
        position: absolute;
        top: 3.2em;
        left: 1em;
        right: auto;
        box-shadow: 0 4px 24px rgba(44,62,80,0.10);
        padding: 1em 0.5em;
        z-index: 200;
      }
      nav#mainNav #navLinks a {
        margin: 0.7em 0;
        color: #1976d2;
        font-weight: 500;
        font-size: 1.1em;
        display: block;
        text-align: left;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">QMĒM</div>
    <nav>
      <a href="index.php" aria-current="page">Home</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
      <a href="vacancy.php">Vacancies</a>
      <a href="news.php">News</a>
      <a href="coding.php">Coding</a>
      <a href="pricing.php">Pricing</a>
      <a href="login.php" style="color:#43a047;font-weight:bold;">Login</a>
      <a href="register.php" style="color:#1976d2;font-weight:bold;">Register</a>
    </nav>
  </header>
  <main>
    <section class="hero">
      <h1>Transform Your <span>Customer Relations</span></h1>
      <p>Streamline your sales process, manage leads effectively, and grow your business with our intelligent CRM solution built for modern teams.</p>
      <div class="cta">
        <a href="register.php" class="btn">Start Free Trial</a>
        <a href="login.php" class="btn alt">Login</a>
        <a href="pricing.php" class="btn" style="background:#fbc02d;color:#1976d2;">See Pricing</a>
      </div>
    </section>
    <section class="product-demo">
      <h2 style="color:#1976d2;">See QMĒM CRM in Action</h2>
      <img src="your-screenshot.png" alt="QMĒM CRM Screenshot" loading="lazy">
    </section>
    <section class="video-demo">
      <h2 style="color:#1976d2;">Watch Our Quick Explainer</h2>
      <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID" title="QMĒM CRM Explainer Video" allowfullscreen loading="lazy"></iframe>
    </section>
    <div class="customer-logos">
      <img src="https://img.icons8.com/color/48/000000/microsoft.png" alt="Microsoft" loading="lazy">
      <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google" loading="lazy">
      <img src="https://img.icons8.com/color/48/000000/ibm.png" alt="IBM" loading="lazy">
      <img src="https://img.icons8.com/color/48/000000/amazon.png" alt="Amazon" loading="lazy">
    </div>
    <section class="features">
      <div class="feature">
        <img src="https://img.icons8.com/color/48/000000/automation.png" alt="Automation Icon" loading="lazy">
        <h3>Smart Automation</h3>
        <p>Automate repetitive tasks and focus on building relationships, not paperwork.</p>
      </div>
      <div class="feature">
        <img src="https://img.icons8.com/color/48/000000/analytics.png" alt="Analytics Icon" loading="lazy">
        <h3>Powerful Analytics</h3>
        <p>Gain insights with real-time dashboards and customizable reports.</p>
      </div>
      <div class="feature">
        <img src="https://img.icons8.com/color/48/000000/handshake.png" alt="Collaboration Icon" loading="lazy">
        <h3>Team Collaboration</h3>
        <p>Work together seamlessly with shared contacts, notes, and tasks.</p>
      </div>
    </section>
    <section class="newsletter">
      <h2 style="color:#1976d2;">Subscribe for Updates</h2>
      <form method="post" action="#">
        <input type="email" name="newsletter_email" placeholder="Your email address" aria-label="Email address" required>
        <button type="submit">Subscribe</button>
      </form>
      <div style="font-size:0.95em;color:#90a4ae;margin-top:0.5em;">No spam. Unsubscribe anytime.</div>
    </section>
    <section class="testimonials">
      <h2>What Our Clients Say</h2>
      <div class="testimonial">
        "QMĒM CRM has transformed how we manage our customers. It's intuitive, fast, and our sales have never been better!"
        <div class="author">— A. Rahman, CEO, ExampleCorp</div>
      </div>
      <div class="testimonial">
        "The automation features save us hours every week. Highly recommended for any growing business."
        <div class="author">— S. Lee, Operations Manager</div>
      </div>
    </section>
    <section class="faq">
      <h2>Frequently Asked Questions</h2>
      <div class="faq-item">
        <div class="faq-q">Is there a free trial?</div>
        <div class="faq-a">Yes! You can try QMĒM CRM free for 14 days, no credit card required.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q">Can I import my existing contacts?</div>
        <div class="faq-a">Absolutely. You can import contacts from CSV or Excel files in just a few clicks.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q">Is my data secure?</div>
        <div class="faq-a">We use industry-standard encryption and security practices to keep your data safe.</div>
      </div>
      <!-- Add more FAQ items as needed -->
    </section>
    <button class="back-to-top" id="backToTop" title="Back to top">&#8679;</button>
  </main>
  <footer>
    &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
    <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
  </footer>
  <script>
    // Back to top button
    const backToTop = document.getElementById('backToTop');
    window.onscroll = function() {
      backToTop.style.display = (window.scrollY > 300) ? 'block' : 'none';
    };
    backToTop.onclick = function() {
      window.scrollTo({top: 0, behavior: 'smooth'});
    };

    // Responsive menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    menuToggle.onclick = function(e) {
      e.stopPropagation();
      navLinks.style.display = navLinks.style.display === 'block' ? 'none' : 'block';
    };
    // Close menu when clicking outside or on a link
    document.addEventListener('click', function(e) {
      if (navLinks.style.display === 'block' && !navLinks.contains(e.target) && e.target !== menuToggle) {
        navLinks.style.display = 'none';
      }
    });
    navLinks.querySelectorAll('a').forEach(a => {
      a.onclick = function() {
        navLinks.style.display = 'none';
      };
    });
    window.addEventListener('resize', checkMenu);
    window.addEventListener('DOMContentLoaded', checkMenu);
  </script>
</body>
</html>
