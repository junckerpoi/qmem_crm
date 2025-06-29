<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Stay up to date with the latest news and updates from QMĒM Technologies.">
  <title>Latest News | QMĒM CRM</title>
  <link rel="stylesheet" href="style.css">
  <style>
    main { max-width: 900px; margin: 2em auto; background: #fff; color: #222; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
    .news-list { display: flex; flex-direction: column; gap: 2em; }
    .news-card { background: #f5f5fa; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08); padding: 1.5em 1.2em; }
    .news-card h2 { color: #1976d2; margin-bottom: 0.2em; }
    .news-meta { font-size: 0.95em; color: #555; margin-bottom: 0.7em; }
    .news-card img { max-width: 100%; border-radius: 8px; margin-bottom: 1em; }
    .share { margin-top: 1em; }
    .share a { margin-right: 0.7em; color: #1976d2; text-decoration: none; font-size: 1.2em; }
    .share a:hover { color: #125ea7; }
    .newsletter { margin: 2em 0 0 0; text-align: center; }
    .newsletter input[type="email"] { padding: 0.5em; border: 1px solid #cfd8dc; border-radius: 4px; margin-right: 0.5em; }
    .newsletter button { padding: 0.5em 1.5em; background: #1976d2; color: #fff; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
    .newsletter button:hover { background: #125ea7; }
    footer { text-align: center; color: #90a4ae; font-size: 0.95em; margin-top: 2em; padding: 1em 0; background: rgba(0,0,0,0.1); border-top: 1px solid #333; }
    nav { text-align: center; margin-bottom: 2em; }
    nav a { color: #1976d2; text-decoration: none; margin: 0 1em; font-weight: 500; transition: color 0.2s; }
    nav a:hover { color: #125ea7; }
    .logo { font-size: 2rem; font-weight: bold; color: #2d3e50; margin: 1em 0 0.5em 0; text-align: center; letter-spacing: 2px; }
    @media (max-width: 700px) {
      main { padding: 1em; }
      .news-card { padding: 1em; }
    }
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
      <a href="news.php" aria-current="page">News</a>
      <a href="coding.php">Coding</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>
  <main>
    <h1>Company Updates</h1>
    <section class="news-list" aria-label="Latest news">
      <article class="news-card">
        <img src="https://img.icons8.com/color/96/000000/news.png" alt="News icon">
        <h2>May 2025: Next-Gen CRM Dashboard Launched</h2>
        <div class="news-meta">By <strong>QMĒM Team</strong> | May 10, 2025</div>
        <p>QMĒM launched its next-gen CRM dashboard for small businesses, featuring advanced analytics, automation, and a refreshed user experience. <a href="#">Read more...</a></p>
        <div class="share">
          <span>Share:</span>
          <a href="https://twitter.com/intent/tweet?text=Check+out+the+latest+news+from+QMĒM+CRM!&url=https://yourdomain.com/news.php" target="_blank" title="Share on Twitter">🐦</a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourdomain.com/news.php" target="_blank" title="Share on Facebook">📘</a>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourdomain.com/news.php" target="_blank" title="Share on LinkedIn">💼</a>
        </div>
      </article>
      <article class="news-card">
        <img src="https://img.icons8.com/color/96/000000/award.png" alt="Award icon">
        <h2>March 2025: QMĒM Wins Best CRM Startup Award</h2>
        <div class="news-meta">By <strong>QMĒM Team</strong> | March 28, 2025</div>
        <p>We are honored to be recognized as the Best CRM Startup of 2025 by TechNews. Thank you to our amazing team and clients for your support!</p>
        <div class="share">
          <span>Share:</span>
          <a href="https://twitter.com/intent/tweet?text=QMĒM+won+Best+CRM+Startup+Award!&url=https://yourdomain.com/news.php" target="_blank" title="Share on Twitter">🐦</a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourdomain.com/news.php" target="_blank" title="Share on Facebook">📘</a>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourdomain.com/news.php" target="_blank" title="Share on LinkedIn">💼</a>
        </div>
      </article>
      <article class="news-card">
        <img src="https://img.icons8.com/color/96/000000/idea.png" alt="Idea icon">
        <h2>February 2025: New AI-Powered Features</h2>
        <div class="news-meta">By <strong>QMĒM Team</strong> | February 15, 2025</div>
        <p>We introduced AI-powered lead scoring and smart recommendations to help you close deals faster and work smarter.</p>
        <div class="share">
          <span>Share:</span>
          <a href="https://twitter.com/intent/tweet?text=QMĒM+adds+AI-powered+features!&url=https://yourdomain.com/news.php" target="_blank" title="Share on Twitter">🐦</a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourdomain.com/news.php" target="_blank" title="Share on Facebook">📘</a>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourdomain.com/news.php" target="_blank" title="Share on LinkedIn">💼</a>
        </div>
      </article>
    </section>
    <section class="newsletter" aria-label="Newsletter signup">
      <h2>Stay Updated</h2>
      <form method="post" action="#" aria-label="Newsletter form">
        <input type="email" name="newsletter_email" placeholder="Your email address" aria-label="Email address" required>
        <button type="submit">Subscribe</button>
      </form>
      <div style="font-size:0.95em;color:#90a4ae;margin-top:0.5em;">No spam. Unsubscribe anytime.</div>
    </section>
  </main>
  <footer>
    &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
    <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
  </footer>
</body>
</html>
