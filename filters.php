<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&display=swap" rel="stylesheet">
  <title>Visually Barkcloth</title>
</head>

<body class="hero">
    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
  <nav class="nav">
    <ul>
      <li>
        <a class="white-nav <?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a>
      </li>
      <li>
        <a class="white-nav <?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Ideas?</a>
      </li>
      <li>
        <a class="white-nav <?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a>
      </li>
      <li>
        <a class="white-nav <?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a>
      </li>
      <li>
        <a class="white-nav <?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a>
      </li>
    </ul>
  </nav>

  <main class="page">
    <!-- <h1 class="page-title">
      Explore<br>Barkcloth
    </h1> -->

    <div class="choices">
      <a href="shapes.php" class="choice-card">
        <div class="choice-icon">
          <svg viewBox="0 0 56 56" fill="none" stroke="var(--black)" stroke-width="1">
            <rect x="8" y="8" width="16" height="16" />
            <circle cx="42" cy="16" r="8" />
            <polygon points="8,48 24,32 8,32" />
            <path d="M32 40 L48 40 L40 32 Z" />
          </svg>
        </div>
        <!-- <span class="choice-label">Filter by</span> -->
        <h2 class="choice-title">Shapes</h2>
        <span class="choice-arrow">→</span>
      </a>

      <a href="structures.php" class="choice-card">
        <div class="choice-icon">
          <svg viewBox="0 0 56 56" fill="none" stroke="var(--black)" stroke-width="1">
            <rect x="8" y="8" width="40" height="40" />
            <rect x="16" y="16" width="24" height="24" stroke-dasharray="2,2" />
            <rect x="24" y="24" width="8" height="8" />
            <line x1="28" y1="8" x2="28" y2="48" />
            <line x1="8" y1="28" x2="48" y2="28" />
          </svg>
        </div>
        <!-- <span class="choice-label">Filter by</span> -->
        <h2 class="choice-title">Structures</h2>
        <span class="choice-arrow">→</span>
      </a>
    </div>
  </main>

  <?php
  // load hero images
    $files = glob('hero/*.png');
    $images = json_encode(array_values($files));
  ?>

  <script>
    // cycle through hero images every 8 seconds
    document.addEventListener('DOMContentLoaded', () => {
      const heroImages = <?= $images ?>;
      let current = 0;
      const el = document.querySelector('.hero');

      // add dark overlay to make text more readable
      function cycleHero() {
        const img = new Image();
        const next = heroImages[(current + 1) % heroImages.length];
        img.onload = () => {
          el.style.backgroundImage = `
            linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)),
            url('${heroImages[current]}')
          `;
        };
        current = (current + 1) % heroImages.length;
        img.src = next;
      }

      cycleHero();
      setInterval(cycleHero, 8000);
    });
  </script>

</body>

</html>