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
  <nav class="nav stripe">
    <ul>
      <li><a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
      <li><a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Ideas?</a></li>
      <li><a class="<?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a></li>
      <li><a class="<?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a></li>
      <li><a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
    </ul>
  </nav>
  <div class="home-wrap">
  <div class="home-split">
    <div class="home-left">
      <h1 class="home-title">Visually<br>Barkcloth</h1>
      <div class="home-adjust">
        <p class="home-subtitle">
digitized barkcloth from Wereldmuseum Leiden (Netherlands) and archival photographs from Världskulturmuseerna (Sweden)
        </p>
      <p class="home-credits">
        Curated by<br>
        Iris Yiqun Luo, Kiran Mohammadi-Williams,<br>
        & Shihan Gao
      </p>
      <div class="home-rule"></div>
      </div>

      <a class="enter-link" href="filters.php">
        <!-- <span class="enter-arrow">→</span> -->
         <span class="enter-label">Enter</span>
      </a>
    </div>

    <div class="home-right">

      <p class="about-hook" style="margin-bottom: 10px; font-weight: bold;">
        What do you see when you look at a piece of barkcloth?
      </p>
      <p class="about-hook" style="margin-bottom: 10px;">
        Maybe a stripe. Maybe something that curves like a crescent — or almost like one, but not quite.
        Maybe a shape that repeats, shifts, and repeats again, slightly differently each time.
        <em>Maybe something you do not have a word for yet.</em>
      </p>

      <p class="about-hook" style="margin-bottom: 10px;">
        The feeling of almost recognizing something but not quite is where <i>Visually Barkcloth</i> begins.
      </p>

      <p class="about-hook">
      Barkcloth is made from the inner bark of trees. It is soaked, fermented, and beaten until it becomes
      soft and flat, ready to be worn, used, or decorated. 
      </p>
      
      <p class="about-hook">
      People across the Austronesian world have been
      making it for at least five thousand years — from the forests of Central Sulawesi in Eastern
      Indonesia, where it is called <em>fuya</em>, to the islands of Polynesia, where it is known as
      <em>tapa</em>. As Austronesian voyagers sailed across the Pacific, they brought the knowledge of
      barkcloth with them.
    </p>

    </div>
  </div>
  </div>
</body>

</html>