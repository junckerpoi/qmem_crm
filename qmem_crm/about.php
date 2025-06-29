<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Learn about QMĒM Technologies, our mission, values, team, and how we empower businesses with elegant CRM solutions.">
    <meta property="og:title" content="About Us | QMĒM CRM">
    <meta property="og:description" content="Discover QMĒM Technologies: our story, values, team, and commitment to empowering your business with modern CRM solutions.">
    <meta property="og:type" content="website">
    <title>About Us | QMĒM CRM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        main {
            max-width: 900px;
            margin: 2em auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.08);
            padding: 2em 2.5em;
        }
        .breadcrumbs {
            font-size: 0.95em;
            margin-bottom: 1em;
            color: #90a4ae;
        }
        .breadcrumbs a { color: #1976d2; text-decoration: none; }
        .breadcrumbs a:hover { text-decoration: underline; }
        .timeline {
            border-left: 3px solid #1976d2;
            margin: 2em 0 2em 1em;
            padding-left: 2em;
        }
        .timeline-event {
            margin-bottom: 1.5em;
            position: relative;
        }
        .timeline-event:before {
            content: '';
            position: absolute;
            left: -2.2em;
            top: 0.3em;
            width: 1em;
            height: 1em;
            background: #1976d2;
            border-radius: 50%;
        }
        .values {
            display: flex;
            gap: 2em;
            flex-wrap: wrap;
            margin: 2em 0;
        }
        .value {
            flex: 1 1 200px;
            background: #e3f2fd;
            border-radius: 8px;
            padding: 1.5em;
            text-align: center;
            margin-bottom: 1em;
        }
        .value h3 { color: #1976d2; margin-bottom: 0.5em; }
        .achievements {
            margin: 2em 0;
            text-align: center;
        }
        .achievements img {
            height: 40px;
            margin: 0 1em;
            vertical-align: middle;
        }
        .team {
            display: flex;
            gap: 2em;
            margin-top: 2em;
            flex-wrap: wrap;
        }
        .team-member {
            flex: 1 1 200px;
            text-align: center;
        }
        .team-member img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 0.5em;
            border: 2px solid #1976d2;
        }
        .team-member .bio {
            font-size: 0.95em;
            color: #4a5a6a;
            margin-top: 0.5em;
        }
        .team-member a {
            color: #1976d2;
            font-size: 0.95em;
            text-decoration: underline;
        }
        .testimonials {
            margin: 2em 0;
            text-align: center;
        }
        .testimonial {
            background: #e3f2fd;
            border-radius: 10px;
            padding: 1.5em;
            margin: 1em auto;
            max-width: 600px;
            font-style: italic;
            color: #2d3e50;
        }
        .testimonial .author {
            margin-top: 1em;
            font-weight: bold;
            color: #1976d2;
        }
        .cta {
            margin: 2em 0 0 0;
            text-align: center;
        }
        .cta a {
            display: inline-block;
            background: #1976d2;
            color: #fff;
            padding: 0.75em 2em;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .cta a:hover {
            background: #125ea7;
        }
        .newsletter {
            margin: 2em 0;
            text-align: center;
        }
        .newsletter input[type="email"] {
            padding: 0.5em;
            border: 1px solid #cfd8dc;
            border-radius: 4px;
            margin-right: 0.5em;
        }
        .newsletter button {
            padding: 0.5em 1.5em;
            background: #43a047;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
        .newsletter button:hover { background: #2e7031; }
        footer {
            text-align: center;
            color: #90a4ae;
            font-size: 0.95em;
            margin-top: 2em;
        }
        nav {
            margin: 1em 0 2em 0;
            text-align: center;
        }
        nav a {
            color: #1976d2;
            text-decoration: none;
            margin: 0 1em;
            font-weight: 500;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #125ea7;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3e50;
            margin: 1em 0 0.5em 0;
            text-align: center;
            letter-spacing: 2px;
        }
        @media (max-width: 700px) {
            .values, .team { flex-direction: column; gap: 1em; }
            main { padding: 1em; }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">QMĒM</div>
        <nav aria-label="Main navigation">
            <a href="index.php">Home</a>
            <a href="about.php" aria-current="page">About</a>
            <a href="contact.php">Contact</a>
            <a href="vacancy.php">Vacancies</a>
            <a href="news.php">News</a>
            <a href="coding.php">Coding</a>
        </nav>
    </header>
    <main>
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="index.php">Home</a> &gt; About
        </nav>
        <h1>About QMĒM</h1>
        <section>
            <p>
                <strong>QMĒM Technologies</strong> was founded to simplify customer relationship management for businesses of all sizes. Our vision is to empower teams with elegant, intuitive CRM solutions that drive growth and efficiency.
            </p>
        </section>
        <section>
            <h2>Our Journey</h2>
            <div class="timeline" aria-label="Company timeline">
                <div class="timeline-event">
                    <strong>2021:</strong> QMĒM Technologies is founded by Alex Rahman with a mission to make CRM simple and accessible.
                </div>
                <div class="timeline-event">
                    <strong>2022:</strong> Launched our first CRM platform, gaining our first 100 business clients.
                </div>
                <div class="timeline-event">
                    <strong>2023:</strong> Recognized as a top CRM startup in the region. Expanded our team and feature set.
                </div>
                <div class="timeline-event">
                    <strong>2024:</strong> Surpassed 1,000 users and introduced advanced analytics and automation.
                </div>
            </div>
        </section>
        <section>
            <h2>Our Core Values</h2>
            <div class="values">
                <div class="value">
                    <h3>Innovation</h3>
                    <p>We constantly seek new ways to improve and deliver value to our clients.</p>
                </div>
                <div class="value">
                    <h3>Integrity</h3>
                    <p>We believe in transparency, honesty, and building trust with every interaction.</p>
                </div>
                <div class="value">
                    <h3>Customer Focus</h3>
                    <p>Your success is our priority. We listen, adapt, and deliver solutions that fit your needs.</p>
                </div>
            </div>
        </section>
        <section class="achievements">
            <h2>Achievements & Recognition</h2>
            <p>
                <img src="https://img.icons8.com/color/48/000000/trophy.png" alt="Award Icon" title="Award Winner">
                <img src="https://img.icons8.com/color/48/000000/medal2.png" alt="Medal Icon" title="Top Startup">
                <img src="https://img.icons8.com/color/48/000000/handshake.png" alt="Clients Icon" title="Trusted by Businesses">
            </p>
            <p>
                Awarded "Best CRM Startup 2023" &nbsp; | &nbsp; Trusted by 1,000+ businesses &nbsp; | &nbsp; Featured in TechNews
            </p>
        </section>
        <section>
            <h2>Meet Our Team</h2>
            <div class="team">
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Rahman, Founder & CEO">
                    <div><strong>Alex Rahman</strong></div>
                    <div>Founder & CEO</div>
                    <div class="bio">Alex is passionate about building tools that empower businesses to grow. <a href="https://linkedin.com/" target="_blank" rel="noopener">LinkedIn</a></div>
                </div>
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sara Lee, CTO">
                    <div><strong>Sara Lee</strong></div>
                    <div>Chief Technology Officer</div>
                    <div class="bio">Sara leads our tech team, ensuring our platform is fast, secure, and innovative. <a href="https://linkedin.com/" target="_blank" rel="noopener">LinkedIn</a></div>
                </div>
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Michael Chen, Customer Success Lead">
                    <div><strong>Michael Chen</strong></div>
                    <div>Customer Success Lead</div>
                    <div class="bio">Michael helps clients get the most from QMĒM CRM. <a href="https://linkedin.com/" target="_blank" rel="noopener">LinkedIn</a></div>
                </div>
            </div>
        </section>
        <section class="testimonials">
            <h2>What Our Clients Say</h2>
            <div class="testimonial">
                "QMĒM CRM has transformed our workflow. The team is responsive and the platform is a game-changer!"
                <div class="author">— A. Rahman, CEO, ExampleCorp</div>
            </div>
            <div class="testimonial">
                "We love the automation and analytics features. Highly recommended for any growing business."
                <div class="author">— S. Lee, Operations Manager</div>
            </div>
        </section>
        <section class="newsletter" aria-label="Newsletter signup">
            <h2>Stay Updated</h2>
            <form method="post" action="#" aria-label="Newsletter form">
                <input type="email" name="newsletter_email" placeholder="Your email address" aria-label="Email address" required>
                <button type="submit">Subscribe</button>
            </form>
            <div style="font-size:0.95em;color:#90a4ae;margin-top:0.5em;">No spam. Unsubscribe anytime.</div>
        </section>
        <section class="cta">
            <h2>Ready to transform your business?</h2>
            <a href="contact.php">Contact Us</a>
            <span style="margin:0 1em;">or</span>
            <a href="register.php" style="background:#43a047;">Start Free Trial</a>
        </section>
    </main>
    <footer>
        &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
        <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
        <span style="margin-left:1em;">
            <a href="https://twitter.com/" target="_blank" rel="noopener" style="color:#1976d2;">Twitter</a> |
            <a href="https://facebook.com/" target="_blank" rel="noopener" style="color:#1976d2;">Facebook</a>
        </span>
    </footer>
</body>
</html>
