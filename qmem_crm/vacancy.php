<?php
// filepath: c:\Users\mamun\OneDrive\Desktop\web_prog\htdocs\qmem_crm\vacancy.php
session_start();

// --- Job data (replace with DB in production) ---
$jobs = [
    [
        'id' => 1,
        'title' => 'Frontend Developer',
        'location' => 'Remote',
        'type' => 'Full-time',
        'salary' => 'Competitive',
        'desc' => [
            'Build modern, responsive UIs with React or Vue.',
            'Work closely with designers and backend engineers.',
            '2+ years experience in frontend development.'
        ]
    ],
    [
        'id' => 2,
        'title' => 'Backend PHP Developer',
        'location' => 'Hybrid (City, Country)',
        'type' => 'Full-time',
        'salary' => 'Competitive',
        'desc' => [
            'Develop robust APIs and backend logic in PHP/MySQL.',
            'Experience with MVC frameworks is a plus.',
            '3+ years backend experience required.'
        ]
    ],
    [
        'id' => 3,
        'title' => 'UI/UX Designer',
        'location' => 'Remote',
        'type' => 'Contract',
        'salary' => 'DOE',
        'desc' => [
            'Design intuitive, beautiful interfaces for web and mobile.',
            'Portfolio of previous design work required.',
            'Strong skills in Figma or Adobe XD.'
        ]
    ]
];

// --- Application handling (demo: just show a message) ---
$apply_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_job_id'])) {
    $job_id = intval($_POST['apply_job_id']);
    $applicant = trim($_POST['applicant'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $cover = trim($_POST['cover'] ?? '');
    if ($applicant && filter_var($email, FILTER_VALIDATE_EMAIL) && $cover) {
        $apply_message = "<div class='success'>Thank you, $applicant! Your application for job #$job_id has been received.</div>";
        // In production: save to DB or send email here
    } else {
        $apply_message = "<div class='error'>Please fill in all fields with a valid email.</div>";
    }
}

// --- Filtering ---
$keyword = strtolower(trim($_GET['q'] ?? ''));
$location = strtolower(trim($_GET['location'] ?? ''));
$filtered_jobs = array_filter($jobs, function($job) use ($keyword, $location) {
    $match = true;
    if ($keyword) {
        $match = stripos($job['title'], $keyword) !== false ||
                 array_reduce($job['desc'], fn($carry, $d) => $carry || stripos($d, $keyword) !== false, false);
    }
    if ($match && $location) {
        $match = stripos($job['location'], $location) !== false;
    }
    return $match;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Explore career opportunities at QMĒM Technologies. Join our team and help build the future of CRM.">
  <title>Job Vacancies | QMĒM CRM</title>
  <link rel="stylesheet" href="style.css">
  <style>
    main { max-width: 900px; margin: 2em auto; background: #fff; color: #222; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
    .intro { color: #4a5a6a; font-size: 1.1em; margin-bottom: 2em; text-align: center; }
    .job-list { display: flex; flex-wrap: wrap; gap: 2em; justify-content: center; }
    .job-card { background: #f5f5fa; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08); padding: 2em 1.5em; flex: 1 1 260px; min-width: 260px; max-width: 340px; margin-bottom: 1em; position: relative; }
    .job-card h2 { color: #1976d2; margin-bottom: 0.5em; }
    .job-meta { font-size: 0.95em; color: #555; margin-bottom: 1em; }
    .job-desc { margin-bottom: 1em; }
    .apply-btn { display: inline-block; background: #1976d2; color: #fff; padding: 0.6em 1.5em; border-radius: 5px; text-decoration: none; font-weight: 500; transition: background 0.2s; }
    .apply-btn:hover { background: #125ea7; }
    .contact-hr { margin: 2em 0 1em 0; color: #4a5a6a; text-align: center; }
    .filter-bar { display: flex; gap: 1em; justify-content: center; margin-bottom: 2em; flex-wrap: wrap; }
    .filter-bar input { padding: 0.5em; border-radius: 4px; border: 1px solid #ccc; }
    .filter-bar button { padding: 0.5em 1.2em; border-radius: 4px; border: none; background: #1976d2; color: #fff; font-weight: 500; cursor: pointer; }
    .modal-bg { display: none; position: fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; }
    .modal { background: #fff; color: #222; border-radius: 10px; padding: 2em; max-width: 400px; width: 90vw; box-shadow: 0 4px 24px rgba(44,62,80,0.18); position: relative; }
    .modal h3 { margin-top: 0; }
    .modal .close { position: absolute; top: 0.7em; right: 1em; font-size: 1.5em; color: #888; cursor: pointer; }
    .modal label { font-weight: 500; margin-top: 1em; display: block; }
    .modal input, .modal textarea { width: 100%; margin: 0.5em 0; padding: 0.8em; border: 1px solid #ccc; border-radius: 5px; }
    .modal button { margin-top: 1em; }
    .success, .error { margin: 1em 0; padding: 0.75em; border-radius: 6px; text-align: center; }
    .success { background: #e8f5e9; color: #388e3c; border: 1px solid #c8e6c9; }
    .error { background: #ffeaea; color: #d32f2f; border: 1px solid #ffcdd2; }
    @media (max-width: 700px) {
      main { padding: 1em; }
      .job-list { flex-direction: column; gap: 1em; }
    }
  </style>
  <script>
    // Modal logic
    function openModal(jobId, jobTitle) {
      document.getElementById('modal-bg').style.display = 'flex';
      document.getElementById('apply_job_id').value = jobId;
      document.getElementById('modal-job-title').textContent = jobTitle;
    }
    function closeModal() {
      document.getElementById('modal-bg').style.display = 'none';
    }
    window.addEventListener('DOMContentLoaded', function() {
      document.getElementById('modal-bg').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
      });
      document.querySelectorAll('.apply-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          openModal(this.dataset.jobid, this.dataset.jobtitle);
        });
      });
      document.querySelectorAll('.close').forEach(function(btn) {
        btn.addEventListener('click', closeModal);
      });
    });
  </script>
</head>
<body>
  <header>
    <div class="logo">QMĒM</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
      <a href="vacancy.php" aria-current="page">Vacancies</a>
      <a href="news.php">News</a>
      <a href="coding.php">Coding</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>
  <main>
    <div class="intro">
      <h1>Join Our Team</h1>
      <p>At QMĒM Technologies, we’re passionate about building the future of CRM. Explore our current openings and help us empower businesses worldwide.</p>
    </div>
    <form class="filter-bar" method="get" action="vacancy.php" aria-label="Filter jobs">
      <input type="text" name="q" placeholder="Keyword (e.g. PHP, UI/UX)" value="<?php echo htmlspecialchars($keyword); ?>">
      <input type="text" name="location" placeholder="Location" value="<?php echo htmlspecialchars($location); ?>">
      <button type="submit">Search</button>
    </form>
    <?php echo $apply_message; ?>
    <section class="job-list" aria-label="Job Openings">
      <?php if (count($filtered_jobs)): ?>
        <?php foreach ($filtered_jobs as $job): ?>
          <article class="job-card">
            <h2><?php echo htmlspecialchars($job['title']); ?></h2>
            <div class="job-meta">
              Location: <?php echo htmlspecialchars($job['location']); ?> | 
              Type: <?php echo htmlspecialchars($job['type']); ?> | 
              Salary: <?php echo htmlspecialchars($job['salary']); ?>
            </div>
            <div class="job-desc">
              <ul>
                <?php foreach ($job['desc'] as $d): ?>
                  <li><?php echo htmlspecialchars($d); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <a href="#" class="apply-btn" data-jobid="<?php echo $job['id']; ?>" data-jobtitle="<?php echo htmlspecialchars($job['title']); ?>">Apply Now</a>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="error" style="width:100%;text-align:center;">No job openings found for your search.</div>
      <?php endif; ?>
    </section>
    <div class="contact-hr">
      <p>Don’t see your role? Email your resume to <a href="mailto:hr@qmemcrm.com">hr@qmemcrm.com</a> and tell us how you can make a difference!</p>
      <p>Follow us: 
        <a href="https://linkedin.com/" target="_blank" rel="noopener">LinkedIn</a> | 
        <a href="https://twitter.com/" target="_blank" rel="noopener">Twitter</a>
      </p>
    </div>
    <!-- Application Modal -->
    <div class="modal-bg" id="modal-bg" aria-modal="true" role="dialog">
      <form class="modal" method="post" action="vacancy.php" autocomplete="off">
        <span class="close" title="Close">&times;</span>
        <h3>Apply for <span id="modal-job-title"></span></h3>
        <input type="hidden" name="apply_job_id" id="apply_job_id" value="">
        <label for="applicant">Your Name</label>
        <input type="text" name="applicant" id="applicant" required>
        <label for="email">Your Email</label>
        <input type="email" name="email" id="email" required>
        <label for="cover">Cover Letter</label>
        <textarea name="cover" id="cover" rows="5" required></textarea>
        <button type="submit">Submit Application</button>
      </form>
    </div>
  </main>
  <footer>
    &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
    <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
  </footer>
</body>
</html>
