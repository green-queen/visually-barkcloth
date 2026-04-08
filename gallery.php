<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Barriecito&family=Rubik+Dirt&display=swap" rel="stylesheet">
  <title>Visually Barkcloth</title>
</head>

<body class="hero">
    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
    <nav class="nav">
    <ul>
        <li>
        <a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a>
        </li>
        <li>
        <a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Quiz</a>
        </li>
        <li>
        <a class="<?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a>
        </li>
        <li>
        <a class="<?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a>
        </li>
        <li>
        <a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a>
        </li>
    </ul>
    </nav>

  <main class="page">


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