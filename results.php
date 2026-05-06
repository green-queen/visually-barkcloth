<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);

if (empty($_SESSION['submissions'])) {
    header('Location: quiz.php');
    exit;
}

function h(string $val): string {
    return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
}

$submissions = array_reverse($_SESSION['submissions']); // most recent first
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <title>Your Results – Visually Barkcloth</title>
  <script src="https://cdn.jsdelivr.net/npm/wordcloud@1.2.2/src/wordcloud2.js"></script>
  <style>
    .results-scrollbox {
      max-height: 500px;
      width: 100%;
      overflow-y: auto;
      padding: 16px;
      margin-bottom: 24px;
      border: 1px solid var(--black);
      background: #fff;
      box-sizing: border-box;
    }
    .results-entry {
      margin-bottom: 24px;
      padding-bottom: 16px;
    }
    .results-entry:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }
    .wordcloud-section {
      margin-top: 20px;
      text-align: center;
    }
    #wordcloud-canvas {
      border: 1px solid var(--black);
      background: #ffffff;
      max-width: 100%;
      display: block;
      margin: 0 auto;
      margin-bottom: 24px;
    }
  </style>
</head>

<body>

<nav class="nav">
  <ul>
    <li><a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
    <li><a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Ideas?</a></li>
    <li><a class="<?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a></li>
    <li><a class="<?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a></li>
    <li><a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
  </ul>
</nav>

<main class="results-page">

  <div class="results-actions-top">
    <a href="quiz.php" class="results-btn-primary">← Back to quiz</a>
  </div>

  <div class="results-scrollbox">
    <?php foreach ($submissions as $i => $s):
      $shape_groups = [
          'Square Shapes'     => $s['square_shapes'],
          'Circular Shapes'   => $s['circle_shapes'],
          'Triangular Shapes' => $s['triangle_shapes'],
          'Line Shapes'       => $s['line_shapes'],
          'Cross Shapes'      => $s['cross_shapes'],
      ];
      $has_shapes = array_filter($shape_groups);
      $is_shapes_question = str_contains($s['question'], 'building blocks');
    ?>
    <div class="results-entry">
      <div class="results-entry-meta">
        <span class="results-entry-num"><?= count($submissions) - $i ?></span>
      </div>

      <div class="results-body">
        <div class="results-image-wrap">
          <img
            class="results-image"
            src="img/<?= h($s['barkcloth_id']) ?>.png"
            alt="Barkcloth <?= h($s['barkcloth_id']) ?>"
          >
          <p class="results-image-id"><?= h($s['barkcloth_id']) ?></p>
        </div>

        <div class="results-answers">

          <div class="results-question">
            <span class="results-q-label">Question</span>
            <p class="results-q-text"><?= h($s['question']) ?></p>
          </div>

          <?php if ($is_shapes_question && $has_shapes): ?>
            <div class="results-answer-block">
              <span class="results-a-label">Shapes selected</span>
              <ul class="results-shapes-list">
                <?php foreach ($shape_groups as $group => $values): ?>
                  <?php if (!empty($values)): ?>
                    <li>
                      <span class="results-shape-group"><?= h($group) ?>:</span>
                      <?= h($values) ?>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <?php if ($is_shapes_question && !empty($s['structures_other'])): ?>
            <div class="results-answer-block">
              <span class="results-a-label">Other structures</span>
              <p class="results-a-text"><?= h($s['structures_other']) ?></p>
            </div>
          <?php endif; ?>

          <?php if (!empty($s['textarea'])): ?>
            <div class="results-answer-block">
              <span class="results-a-label">Your answer</span>
              <p class="results-a-text"><?= h($s['textarea']) ?></p>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="center">
    <button class="down" onclick="document.getElementById('wordcloud-section').scrollIntoView({ behavior: 'smooth' })" title="Scroll to word cloud">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 5v14M19 12l-7 7-7-7"/>
      </svg>
    </button>
  </div>

  <section class="wordcloud-section" id="wordcloud-section">
    <canvas id="wordcloud-canvas" width="860" height="480"></canvas>
  </section>

</main>

<script>
  (function () {
    const canvas = document.getElementById('wordcloud-canvas');
    const status = document.getElementById('wc-status');

    // color palette inspired by the barkcloth images, but feel free to tweak!
    const palette = [
      '#8B5A2B', '#B47C3C', '#507850', '#A05040',
      '#3C5A82', '#8C64A0', '#BE8C3C', '#507878',
    ];

    fetch('wordcloud_data.php')
      .then(r => r.json())
      .then(words => {
        if (!words.length) {
          status.textContent = 'No responses yet — be the first!';
          return;
        }

        status.textContent = '';

        // Scale weights so largest word isn't absurdly huge
        const maxWeight = words[0][1];
        const minWeight = words[words.length - 1][1];
        const range     = maxWeight - minWeight || 1;

        const scaled = words.map(([word, weight]) => {
          const ratio = (weight - minWeight) / range;
          return [word, Math.round(14 + ratio * 56)]; // 14px–70px
        });

        WordCloud(canvas, {
          list:            scaled,
          gridSize:        8,
          weightFactor:    1,
          fontFamily:      'Georgia, serif',
          color:           () => palette[Math.floor(Math.random() * palette.length)],
          rotateRatio:     0.3,
          rotationSteps:   2,
          backgroundColor: '#ffffff',
          shuffle:         true,
          drawOutOfBound:  false,
          minSize:         10
        });
      })
      .catch(() => {
        status.textContent = 'Could not load word cloud data.';
      });
  })();
</script>

</body>
</html>