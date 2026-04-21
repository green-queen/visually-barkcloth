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
    <div id="annotation-container"></div>
  </main>

  <script>
    let currentIndex = 0;
    let rows = [];

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