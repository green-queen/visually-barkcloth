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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.querySelector('.gallery');
    const citationEl = document.getElementById('gallery-citation');
    let rows = [];
    let current = 0;

    if (!gallery || !citationEl) return;

    function showRow(index) {
      if (!rows.length) return;

      current = (index + rows.length) % rows.length;
      const row = rows[current];

      gallery.style.backgroundImage = `url('img/${row.id}.png')`;

      const cite = row['reference citation'] || row.referenceCitation || row.link || 'No citation available';
      if (row.link && !row['reference citation'] && !row.referenceCitation) {
        citationEl.innerHTML = `<a href="${row.link}" target="_blank" rel="noopener noreferrer">${cite}</a>`;
      } else {
        citationEl.textContent = cite;
      }
    }

    const prevBtn = document.createElement('button');
    prevBtn.className = 'arrow left';
    prevBtn.innerHTML = '&#10094;';
    prevBtn.setAttribute('aria-label', 'Previous image');

    const nextBtn = document.createElement('button');
    nextBtn.className = 'arrow right';
    nextBtn.innerHTML = '&#10095;';
    nextBtn.setAttribute('aria-label', 'Next image');

    prevBtn.addEventListener('click', () => showRow(current - 1));
    nextBtn.addEventListener('click', () => showRow(current + 1));

    document.body.appendChild(prevBtn);
    document.body.appendChild(nextBtn);

    fetch('data/data.csv')
      .then(res => res.text())
      .then(csvText => {
        const result = Papa.parse(csvText, {
          header: true,
          skipEmptyLines: true
        });

        rows = result.data;
        if (rows.length > 0) showRow(0);
      })
      .catch(err => console.error(err));
  });
</script>
</body>
</html>