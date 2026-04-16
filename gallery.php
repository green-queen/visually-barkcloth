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
  const citationEl = document.getElementById('gallery-citation');
  let current = 0;
  let citationsByImage = {};

  if (!gallery) return;

  const images = <?= $images ?>;

  function normalizeText(str) {
    return decodeURIComponent(str).normalize('NFC');
  }

  function stemFromPath(path) {
    const filename = path.replace(/^.*\//, '').replace(/\.[^.]+$/, '');
    return normalizeText(filename);
  }

  function entriesForImage(path) {
    const stem = stemFromPath(path);

    if (citationsByImage[stem]) return citationsByImage[stem];

    // fallback: normalized comparison
    for (const id of Object.keys(citationsByImage)) {
      const normId = normalizeText(id);

      if (stem === normId) return citationsByImage[id];
      if (stem.includes(normId)) return citationsByImage[id];
    }

    return null;
  }

  function renderCitation(index) {
    if (!images.length) return;

    const entries = entriesForImage(images[index]);

    console.log("IMAGE:", images[index]);
    console.log("STEM:", stemFromPath(images[index]));
    console.log("MATCH:", entries);

    if (!entries || !entries.length) {
      citationEl.innerHTML = '<p style="opacity:0.6;">No citation found</p>';
      return;
    }

    const citation = entries[0].citation;
    const link = entries[0].link;

    let html = '';
    if (citation) {
      html += `<p class="gallery-citation-text">${citation}</p>`;
    }
    if (link) {
      html += `<p class="gallery-citation-link">
        <a href="${link}" target="_blank" rel="noopener">${link}</a>
      </p>`;
    }

    citationEl.innerHTML = html;
  }

  function showImage(index) {
    if (!images.length) return;

    current = (index + images.length) % images.length;
    gallery.style.backgroundImage = `url('${images[current]}')`;
    renderCitation(current);
  }

  // Load CSV
  Papa.parse('data/annotated-data.csv', {
    download: true,
    header: true,
    skipEmptyLines: true,
    transformHeader: h => h.replace(/^\uFEFF/, '').trim(),
    complete(results) {
      console.log("CSV LOADED:", results.data);

      results.data.forEach(row => {
        const id = (row.id || '').trim();
        if (!id) return;

        const normalizedId = normalizeText(id);

        if (!citationsByImage[normalizedId]) {
          citationsByImage[normalizedId] = [];
        }

        citationsByImage[normalizedId].push({
          citation: (row.citation || '').trim(),
          link: (row.link || '').trim(),
        });
      });

      console.log("CITATION MAP:", citationsByImage);

      showImage(0);
    },
    error(err) {
      console.error("CSV LOAD ERROR:", err);
      showImage(0);
    }
  });

  // navigation arrows
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