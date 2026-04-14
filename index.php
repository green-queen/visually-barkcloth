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
  <style>
  </style>
</head>

<body class="hero">
  <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
  <nav class="nav">
    <ul>
      <li><a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
      <li><a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Quiz</a></li>
      <li><a class="<?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a></li>
      <li><a class="<?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a></li>
      <li><a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
    </ul>
  </nav>

  <div class="home-split">

    <!-- LEFT -->
    <div class="home-left">
      <h1 class="home-title">Visually<br>Barkcloth</h1>
      <p class="home-credits">
        Curated and Edited by<br>
        Iris Luo, Kiran Mohammadi-Williams,<br>
        Shihan Gao
      </p>
      <div class="home-rule"></div>
      <a class="enter-link" href="filters.php">
        Enter
        <span class="enter-arrow">→</span>
      </a>
      <div class="home-deco" aria-hidden="true">
        <img src="deco/IMG_3453.jpg" alt="">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="home-right">
      <p class="about-label">About this project</p>

      <p class="about-hook">
        What do you see when you look at a piece of barkcloth?
        Maybe a stripe. Maybe something that curves like a crescent — or almost like one, but not quite.
        Maybe a shape that repeats, shifts, and repeats again, slightly differently each time.
        <em>Maybe something you do not have a word for yet.</em>
      </p>

      <p class="about-hook">
        The feeling of almost recognizing something but not quite is where this project begins.
      </p>

    </div>

  </div>
</body>

</html>