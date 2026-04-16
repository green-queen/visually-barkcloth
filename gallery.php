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
const images = <?= $images ?>;

let currentIndex = 0;
let rows = [];

function extractSMVK(str) {
  if (!str) return null;
  const match = str.match(/SMVK[-_]?(\d+[a-zA-Z]?)/i);
  return match ? match[1].toLowerCase() : null;
}

function findRowByImage(imagePath) {
  const filename = imagePath.split('/').pop();
  const key = extractSMVK(filename);

  if (!key) return null;

  return rows.find(r => extractSMVK(r.id) === key);
}

function showImage(index) {
  const gallery = document.querySelector('.gallery');
  const citationEl = document.getElementById('gallery-citation');

  currentIndex = (index + images.length) % images.length;

  const imgPath = images[currentIndex];
  gallery.style.backgroundImage = `url('${imgPath}')`;

  const row = findRowByImage(imgPath);

  if (!row) {
    citationEl.innerHTML = `<p style="opacity:0.6;">No citation found</p>`;
    return;
  }

  let html = '';

  if (row.citation) {
    html += `<p class="gallery-citation-text">${row.citation}</p>`;
  }

  if (row.link) {
    html += `
      <p class="gallery-citation-link">
        <a href="${row.link}" target="_blank" rel="noopener">
          ${row.link}
        </a>
      </p>
    `;
  }

  citationEl.innerHTML = html;
}

fetch('data/annotated-data.csv')
  .then(res => res.text())
  .then(csvText => {

    const result = Papa.parse(csvText, {
      header: true,
      skipEmptyLines: true
    });

    rows = result.data;

    console.log("CSV LOADED:", rows);

    showImage(0);
  })
  .catch(err => console.error(err));

const prevBtn = document.createElement('button');
prevBtn.className = 'arrow left';
prevBtn.innerHTML = '&#10094;';

const nextBtn = document.createElement('button');
nextBtn.className = 'arrow right';
nextBtn.innerHTML = '&#10095;';

prevBtn.onclick = () => showImage(currentIndex - 1);
nextBtn.onclick = () => showImage(currentIndex + 1);

document.body.appendChild(prevBtn);
document.body.appendChild(nextBtn);
</script>

</body>
</html>