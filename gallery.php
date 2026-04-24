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
  <nav class="nav black-stripe">
    <ul>
      <li><a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
      <li><a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Ideas?</a></li>
      <li><a class="<?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a></li>
      <li><a class="<?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a></li>
      <li><a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
    </ul>
  </nav>

<div class="view-toggle">
  <button class="view-btn active" id="btn-single" title="Single view">Single</button>
  <button class="view-btn" id="btn-grid" title="Grid view">Grid</button>
</div>

<main class="page">
  <div id="gallery-container">
    <div class="gallery-wrapper">
      <div class="gallery"></div>
      <div class="annotation-citation" id="gallery-citation"></div>
    </div>
  </div>
  <div id="gallery-grid-layer" style="display:none;">
    <div class="gallery-grid-inner" id="gallery-grid-inner"></div>
  </div>
</main>

<div id="gallery-modal">
  <div id="gallery-modal-inner">
    <img id="gallery-modal-img" src="" alt="">
    <div id="gallery-modal-cite"></div>
  </div>
</div>

<?php
  $files = glob('hero/*.png');
  $images = json_encode(array_values($files));
?>

<script>
const images = <?= $images ?>;

let currentIndex = 0;
let rows = [];
let currentView = 'single';

function extractSMVK(str) {
  const m = str.match(/SMVK_-_([\w]+)/i);
  return m ? m[1] : null;
}

function getCitationHTML(row) {
  if (!row) return `<span style="opacity:0.6;">No citation found</span>`;
  if (row.citation && row.link) {
    return `<a href="${row.link}" target="_blank" rel="noopener">${row.citation}</a>`;
  }
  if (row.citation) return row.citation;
  if (row.link) return `<a href="${row.link}" target="_blank" rel="noopener">${row.link}</a>`;
  return `<span style="opacity:0.6;">No citation found</span>`;
}

function showImage(index) {
  const gallery    = document.querySelector('.gallery');
  const citationEl = document.getElementById('gallery-citation');

  currentIndex = (index + images.length) % images.length;

  const imgPath = images[currentIndex];
  gallery.style.backgroundImage = `url('${imgPath}')`;

  const fileKey = extractSMVK(imgPath);
  const row     = rows.find(r => extractSMVK(r.id) === fileKey);

  citationEl.innerHTML = getCitationHTML(row);
}

function buildGrid() {
  const gridInner = document.getElementById('gallery-grid-inner');
  gridInner.innerHTML = '';
  images.forEach((imgPath, i) => {
    const fileKey = extractSMVK(imgPath);
    const row     = rows.find(r => extractSMVK(r.id) === fileKey);

    const card = document.createElement('div');
    card.className = 'grid-card';
    card.style.animationDelay = (i * 0.03) + 's';
    card.style.cursor = 'pointer';

    const img = document.createElement('img');
    img.src = imgPath;
    img.alt = row ? row.id : imgPath;
    img.onerror = () => img.style.display = 'none';


    card.appendChild(img);
    card.addEventListener('click', () => openGalleryModal(imgPath, row));

    gridInner.appendChild(card);
  });
}

// modal
const galleryModal      = document.getElementById('gallery-modal');
const galleryModalInner = document.getElementById('gallery-modal-inner');

function openGalleryModal(imgPath, row) {
  document.getElementById('gallery-modal-img').src = imgPath;
  document.getElementById('gallery-modal-img').alt = row ? row.id : '';
  document.getElementById('gallery-modal-cite').innerHTML = getCitationHTML(row);
  galleryModal.style.display = 'flex';
}

galleryModal.addEventListener('click', () => galleryModal.style.display = 'none');
galleryModalInner.addEventListener('click', e => e.stopPropagation());

function setView(view) {
  currentView = view;
  const singleContainer = document.getElementById('gallery-container');
  const gridLayer       = document.getElementById('gallery-grid-layer');
  const prevBtn         = document.querySelector('.arrow.left');
  const nextBtn         = document.querySelector('.arrow.right');
  const btnSingle       = document.getElementById('btn-single');
  const btnGrid         = document.getElementById('btn-grid');

  if (view === 'grid') {
    singleContainer.style.display = 'none';
    gridLayer.style.display = 'block';
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
    btnSingle.classList.remove('active');
    btnGrid.classList.add('active');
    buildGrid();
  } else {
    singleContainer.style.display = '';
    gridLayer.style.display = 'none';
    prevBtn.style.display = '';
    nextBtn.style.display = '';
    btnGrid.classList.remove('active');
    btnSingle.classList.add('active');
  }
}

document.getElementById('btn-single').addEventListener('click', () => setView('single'));
document.getElementById('btn-grid').addEventListener('click', () => setView('grid'));

fetch('data/hero-data.csv')
  .then(res => res.text())
  .then(csvText => {
    const result = Papa.parse(csvText, {
      header: true,
      skipEmptyLines: true
    });
    rows = result.data;
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