<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <title>Visually Barkcloth</title>
  <script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>
</head>

<body>
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

<main class="page">
  <div id="gallery-container">
    <div class="gallery-wrapper">
      <div class="gallery"></div>
      <div class="gallery-citation" id="gallery-citation"></div>
    </div>
  </div>
</main>

<?php
    $files = glob('hero/*.png');
    $images = json_encode(array_values($files));
?>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.querySelector('.gallery');
    let current = 0;

    if (!gallery) return;

    const images = <?= $images ?>;

    function showImage(index) {
      if (!images.length) return;
      current = (index + images.length) % images.length;
      gallery.style.backgroundImage = `url('${images[current]}')`;
    }

    showImage(0);

    const prevBtn = document.createElement('button');
    prevBtn.className = 'arrow left';
    prevBtn.innerHTML = '&#10094;';
    prevBtn.setAttribute('aria-label', 'Previous image');

    const nextBtn = document.createElement('button');
    nextBtn.className = 'arrow right';
    nextBtn.innerHTML = '&#10095;';
    nextBtn.setAttribute('aria-label', 'Next image');

    prevBtn.addEventListener('click', () => showImage(current - 1));
    nextBtn.addEventListener('click', () => showImage(current + 1));

    document.body.appendChild(prevBtn);
    document.body.appendChild(nextBtn);
  });
</script>
</body>
</html>

</body>

</html>