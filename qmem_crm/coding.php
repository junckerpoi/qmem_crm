<?php
// filepath: c:\Users\mamun\OneDrive\Desktop\web_prog\htdocs\qmem_crm\coding.php
session_start();

// --- Demo code snippets (replace with DB in production) ---
if (!isset($_SESSION['snippets'])) {
    $_SESSION['snippets'] = [
        [
            'id' => 1,
            'title' => 'PHP OOP Example',
            'lang' => 'php',
            'desc' => 'A simple CRM class with a greeting method.',
            'code' => "class CRM {\n  private \$user;\n  public function __construct(\$user) {\n    \$this->user = \$user;\n  }\n  public function greet() {\n    return \"Welcome \" . \$this->user;\n  }\n}"
        ],
        [
            'id' => 2,
            'title' => 'JavaScript: Array Filtering',
            'lang' => 'javascript',
            'desc' => 'Filter users by active status.',
            'code' => "const users = [\n  { name: \"Alice\", active: true },\n  { name: \"Bob\", active: false }\n];\nconst activeUsers = users.filter(u => u.active);\nconsole.log(activeUsers);"
        ]
    ];
}
$snippets = $_SESSION['snippets'];

// --- Search/filter ---
$q = trim($_GET['q'] ?? '');
if ($q) {
    $snippets = array_filter($snippets, function($s) use ($q) {
        return stripos($s['title'], $q) !== false || stripos($s['desc'], $q) !== false || stripos($s['code'], $q) !== false;
    });
}

// --- User submission ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_snippet'])) {
    $title = trim($_POST['title'] ?? '');
    $lang = trim($_POST['lang'] ?? '');
    $desc = trim($_POST['desc'] ?? '');
    $code = trim($_POST['code'] ?? '');
    if ($title && $lang && $code) {
        $_SESSION['snippets'][] = [
            'id' => count($_SESSION['snippets']) + 1,
            'title' => htmlspecialchars($title),
            'lang' => htmlspecialchars($lang),
            'desc' => htmlspecialchars($desc),
            'code' => $code
        ];
        header("Location: coding.php");
        exit;
    }
}

// --- Comments (session-based demo) ---
if (!isset($_SESSION['code_comments'])) $_SESSION['code_comments'] = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_snippet_id'])) {
    $sid = intval($_POST['comment_snippet_id']);
    $comment = trim($_POST['comment'] ?? '');
    if ($comment) {
        $_SESSION['code_comments'][$sid][] = [
            'text' => htmlspecialchars($comment),
            'time' => date('Y-m-d H:i')
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Explore code examples, best practices, and developer resources from QMĒM CRM.">
  <title>Coding Section | QMĒM CRM</title>
  <link rel="stylesheet" href="style.css">
  <!-- Prism.js for syntax highlighting -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" />
  <style>
    main { max-width: 900px; margin: 2em auto; background: #fff; color: #222; border-radius: 12px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 2em 2.5em; }
    .code-card { background: #f5f5fa; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08); padding: 1.5em 1.2em; margin-bottom: 2em; position: relative; }
    .copy-btn { position: absolute; top: 1em; right: 1em; background: #1976d2; color: #fff; border: none; border-radius: 4px; padding: 0.3em 1em; cursor: pointer; font-size: 0.95em; }
    .copy-btn:hover { background: #125ea7; }
    .code-explanation { margin-bottom: 1em; color: #4a5a6a; }
    .comment-section { margin-top: 1.5em; }
    .comment-list { margin: 0.5em 0 0 0; padding: 0; list-style: none; }
    .comment-list li { background: #e3f2fd; margin-bottom: 0.5em; border-radius: 5px; padding: 0.5em 1em; font-size: 0.97em; }
    .comment-time { color: #888; font-size: 0.9em; margin-left: 1em; }
    .comment-form textarea { width: 100%; border-radius: 4px; border: 1px solid #cfd8dc; padding: 0.5em; margin-bottom: 0.5em; }
    .comment-form button { background: #1976d2; color: #fff; border: none; border-radius: 4px; padding: 0.4em 1.2em; }
    .comment-form button:hover { background: #125ea7; }
    .search-bar { text-align: center; margin-bottom: 2em; }
    .search-bar input { padding: 0.5em; border-radius: 4px; border: 1px solid #ccc; width: 220px; }
    .search-bar button { padding: 0.5em 1.2em; border-radius: 4px; border: none; background: #1976d2; color: #fff; font-weight: 500; cursor: pointer; }
    .submit-form { background: #f5f5fa; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08); padding: 1.5em 1.2em; margin-bottom: 2em; }
    .submit-form input, .submit-form textarea, .submit-form select { width: 100%; margin-bottom: 1em; padding: 0.7em; border-radius: 4px; border: 1px solid #cfd8dc; }
    .submit-form button { background: #1976d2; color: #fff; border: none; border-radius: 4px; padding: 0.6em 1.5em; }
    .submit-form button:hover { background: #125ea7; }
    .no-snippets { text-align: center; color: #d32f2f; margin: 2em 0; }
    blockquote { margin: 2em 0; padding: 1em 1.5em; background: #e3f2fd; border-left: 4px solid #1976d2; color: #1976d2; border-radius: 6px; }
    footer { text-align: center; color: #90a4ae; font-size: 0.95em; margin-top: 2em; padding: 1em 0; background: rgba(0,0,0,0.1); border-top: 1px solid #333; }
    nav { text-align: center; margin-bottom: 2em; }
    nav a { color: #1976d2; text-decoration: none; margin: 0 1em; font-weight: 500; transition: color 0.2s; }
    nav a:hover { color: #125ea7; }
    .logo { font-size: 2rem; font-weight: bold; color: #2d3e50; margin: 1em 0 0.5em 0; text-align: center; letter-spacing: 2px; }
    @media (max-width: 700px) {
      main { padding: 1em; }
      .code-card, .submit-form { padding: 1em; }
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
      <a href="news.php">News</a>
      <a href="coding.php" aria-current="page">Coding</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>
  <main>
    <h1>Coding Examples & Best Practices</h1>
    <form class="search-bar" method="get" action="coding.php">
      <input type="text" name="q" placeholder="Search code..." value="<?php echo htmlspecialchars($q); ?>">
      <button type="submit">Search</button>
    </form>
    <section class="submit-form" aria-label="Submit your code">
      <h2>Submit Your Code Example</h2>
      <form method="post" action="coding.php">
        <input type="text" name="title" placeholder="Title (e.g. PHP Login Script)" required>
        <select name="lang" required>
          <option value="">Language</option>
          <option value="php">PHP</option>
          <option value="javascript">JavaScript</option>
          <option value="css">CSS</option>
          <option value="html">HTML</option>
          <option value="python">Python</option>
        </select>
        <input type="text" name="desc" placeholder="Short description (optional)">
        <textarea name="code" rows="5" placeholder="Paste your code here..." required></textarea>
        <button type="submit" name="submit_snippet">Submit</button>
      </form>
    </section>
    <section aria-label="Code examples">
      <?php if (count($snippets)): ?>
        <?php foreach ($snippets as $s): ?>
          <div class="code-card">
            <div class="code-explanation">
              <strong><?php echo htmlspecialchars($s['title']); ?>:</strong>
              <?php echo htmlspecialchars($s['desc']); ?>
            </div>
            <button class="copy-btn" aria-label="Copy code" onclick="copyCode(this)">Copy</button>
            <pre><code class="language-<?php echo htmlspecialchars($s['lang']); ?>"><?php echo htmlspecialchars($s['code']); ?></code></pre>
            <div class="comment-section">
              <strong>Comments:</strong>
              <ul class="comment-list">
                <?php foreach ($_SESSION['code_comments'][$s['id']] ?? [] as $c): ?>
                  <li><?php echo $c['text']; ?> <span class="comment-time"><?php echo $c['time']; ?></span></li>
                <?php endforeach; ?>
              </ul>
              <form class="comment-form" method="post" action="coding.php<?php echo $q ? '?q='.urlencode($q) : ''; ?>">
                <textarea name="comment" rows="2" placeholder="Add a comment..." required></textarea>
                <input type="hidden" name="comment_snippet_id" value="<?php echo $s['id']; ?>">
                <button type="submit">Post</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="no-snippets">No code examples found for your search.</div>
      <?php endif; ?>
    </section>
    <blockquote>
      "Clean code always looks like it was written by someone who cares." — Robert C. Martin
    </blockquote>
    <section aria-label="Related resources">
      <h2>Resources</h2>
      <ul>
        <li><a href="https://www.php.net/manual/en/" target="_blank" rel="noopener">PHP Manual</a></li>
        <li><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noopener">MDN JavaScript Docs</a></li>
        <li><a href="https://refactoring.guru/" target="_blank" rel="noopener">Refactoring Guru</a></li>
      </ul>
    </section>
  </main>
  <footer>
    &copy; <?php echo date('Y'); ?> QMĒM Technologies. All rights reserved. |
    <a href="privacy.php" style="color:#1976d2;">Privacy Policy</a>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script>
    function copyCode(btn) {
      const code = btn.nextElementSibling.querySelector('code').innerText;
      navigator.clipboard.writeText(code).then(() => {
        btn.textContent = "Copied!";
        setTimeout(() => { btn.textContent = "Copy"; }, 1500);
      });
    }
  </script>
</body>
</html>
