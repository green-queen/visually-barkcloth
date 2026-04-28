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
    <button class="down" onclick="document.getElementById('test').scrollIntoView({ behavior: 'smooth' })" title="Scroll to section">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" >
        <path d="M12 5v14M19 12l-7 7-7-7"/>
        </svg>
    </button>
  </div>


     <section class="test" id="test">
    <div class="about-section-header">
      <span class="about-section-num">01</span>
      <span class="about-section-title" id="section-textile">The Textile</span>
    </div>
      <p class="about-body">
      Barkcloth is made from the inner bark of trees. It is soaked, fermented, and beaten until it becomes
      soft and flat, ready to be worn, used, or decorated. 
      </p>
      
      <p class="about-body">
      People across the Austronesian world have been
      making it for at least five thousand years — from the forests of Central Sulawesi in Eastern
      Indonesia, where it is called <em>fuya</em>, to the islands of Polynesia, where it is known as
      <em>tapa</em>. As Austronesian voyagers sailed across the Pacific, they brought the knowledge of
      barkcloth with them.
    </p>

    <p class="about-body">
      The patterns on these textiles — dots, stripes, crescents, zigzags, forms that repeat and transform —
      carry quiet traces of those journeys and the connections between distant places.
    </p>
    <p class="about-body">
      Sometimes, when you look closely at a piece of <em>fuya</em> from Sulawesi and a piece of
      <em>tapa</em> from Samoa, something quietly rhymes.
    </p>
    <p class="about-body">
      These connections are not always easy to see. Museum collections have their own geographies:
      Indonesian barkcloth here, Polynesian tapa there, organized by the categories of their time.
      Many institutions are now rethinking how their collections are arranged and described. This project
      is part of that conversation — starting not from inherited labels, but from what you can actually
      see on the objects themselves.
    </p>
  </section>

  <div class="about-deco">
    <img src="deco/IMG_3707.jpg" alt="">
  </div>

</main>

</body>
</html>