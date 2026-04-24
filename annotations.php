<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <style>
    #annotation-grid-layer {
      position: fixed;
      inset: 0;
      overflow-y: auto;
      z-index: 9000;
      padding: 100px 40px 60px;
      box-sizing: border-box;
      background: var(--white);
    }
    .annotation-grid-inner {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      max-width: 3000px;
      margin: 0 auto;
      justify-content: center;
    }
    .annotation-grid-inner .grid-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      display: block;
    }
    .annotation-grid-inner .grid-card:hover {
      background-color: var(--light-blue);
    }
    /* modal */
    #annotation-modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      z-index: 100000;
      cursor: pointer;
    }
    #annotation-modal-inner {
      background: #fff;
      padding: 2rem;
      max-width: 520px;
      width: 90%;
      cursor: default;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.75rem;
      position: relative;
    }
    #annotation-modal-inner img {
      max-width: 100%;
      max-height: 50vh;
      object-fit: contain;
    }
    #annotation-modal-cite {
      font-size: 0.72rem;
      text-align: center;
    }
    #annotation-modal-cite a {
      color: var(--gray);
      text-decoration: underline;
    }
  </style>
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
    <div id="annotation-container"></div>
  </main>

  <div id="annotation-grid-layer" style="display:none;">
    <div class="annotation-grid-inner" id="annotation-grid-inner"></div>
  </div>

  <div id="annotation-modal">
    <div id="annotation-modal-inner">
      <img id="annotation-modal-img" src="" alt="">
      <div id="annotation-modal-tooltip" class="annotation-tooltip" style="position:static; opacity:1; visibility:visible; transform:none; background: var(--white); color: var(--text); font-size:0.8rem; padding:8px 12px; max-width:400px; display:none;"></div>
      <div id="annotation-modal-cite"></div>
    </div>
  </div>

  <script>
    let currentIndex = 0;
    let rows = [];
    let currentView = 'single';

    function buildDot(label) {
      const dot = document.createElement('div');
      dot.className = 'annotation-dot';
      dot.style.left = '50%';
      dot.style.top = '50%';

      const tooltip = document.createElement('div');
      tooltip.className = 'annotation-tooltip';
      tooltip.innerHTML = label || "No annotation available";

      dot.appendChild(tooltip);
      return dot;
    }

    function showAnnotation(index) {
      const container = document.getElementById('annotation-container');

      currentIndex = (index + rows.length) % rows.length;
      const row = rows[currentIndex];

      const imgSrc = `annotated-img/${row.id}.png`;

      const wrapper = document.createElement('div');
      wrapper.className = 'annotation-wrapper';

      const img = document.createElement('img');
      img.className = 'annotation-img';
      img.src = imgSrc;
      img.alt = row.name || row.id;

      img.onload = () => {
        wrapper.appendChild(buildDot(row.annotations));
      };

      wrapper.appendChild(img);

      const citeEl = document.createElement('div');
      citeEl.className = 'annotation-citation';

      if (row.link) {
        const a = document.createElement('a');
        a.href = row.link;
        a.target = '_blank';
        a.rel = 'noopener noreferrer';
        a.textContent = row.id || "Source";
        citeEl.appendChild(a);
      } else {
        citeEl.textContent = row.id || "";
      }

      container.innerHTML = '';
      container.appendChild(wrapper);
      container.appendChild(citeEl);
    }

    function buildGrid() {
      const gridInner = document.getElementById('annotation-grid-inner');
      gridInner.innerHTML = '';
      const seen = new Set();
      const uniqueRows = rows.filter(row => {
        if (seen.has(row.id)) return false;
        seen.add(row.id);
        return true;
      });
      uniqueRows.forEach((row, i) => {
        const card = document.createElement('div');
        card.className = 'grid-card';
        card.style.animationDelay = (i * 0.03) + 's';
        card.style.cursor = 'pointer';

        const img = document.createElement('img');
        img.src = `annotated-img/${row.id}.png`;
        img.alt = row.name || row.id;
        img.onerror = () => img.style.display = 'none';


        card.appendChild(img);
        card.addEventListener('click', () => openAnnotationModal(row));

        gridInner.appendChild(card);
      });
    }

    // modal
    const annotationModal      = document.getElementById('annotation-modal');
    const annotationModalInner = document.getElementById('annotation-modal-inner');

    function openAnnotationModal(row) {
      document.getElementById('annotation-modal-img').src = `annotated-img/${row.id}.png`;
      document.getElementById('annotation-modal-img').alt = row.name || row.id;

      const tooltipEl = document.getElementById('annotation-modal-tooltip');
      if (row.annotations) {
        tooltipEl.textContent = row.annotations;
        tooltipEl.style.display = 'block';
      } else {
        tooltipEl.style.display = 'none';
      }

      const citeEl = document.getElementById('annotation-modal-cite');
      if (row.link) {
        citeEl.innerHTML = `<a href="${row.link}" target="_blank" rel="noopener noreferrer">${row.id || 'Source'}</a>`;
      } else {
        citeEl.textContent = row.id || '';
      }

      annotationModal.style.display = 'flex';
    }

    annotationModal.addEventListener('click', () => annotationModal.style.display = 'none');
    annotationModalInner.addEventListener('click', e => e.stopPropagation());

    function setView(view) {
      currentView = view;
      const singleContainer = document.getElementById('annotation-container');
      const gridLayer       = document.getElementById('annotation-grid-layer');
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

    fetch('data/annotated-data.csv')
      .then(res => res.text())
      .then(csvText => {
        const result = Papa.parse(csvText, {
          header: true,
          skipEmptyLines: true
        });

        rows = result.data;
        showAnnotation(0);
      })
      .catch(err => {
        console.error(err);
      });

    const prevBtn = document.createElement('button');
    prevBtn.className = 'arrow left';
    prevBtn.innerHTML = '&#10094;';

    const nextBtn = document.createElement('button');
    nextBtn.className = 'arrow right';
    nextBtn.innerHTML = '&#10095;';

    prevBtn.onclick = () => showAnnotation(currentIndex - 1);
    nextBtn.onclick = () => showAnnotation(currentIndex + 1);

    document.body.appendChild(prevBtn);
    document.body.appendChild(nextBtn);
  </script>
</body>

</html>