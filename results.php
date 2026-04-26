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

  <div class="results-header">
    <h1 class="results-title">Your responses</h1>
    <p class="results-count"><?= count($submissions) ?> submission<?= count($submissions) !== 1 ? 's' : '' ?> this session</p>
  </div>

  <div class="results-actions-top">
    <a href="quiz.php" class="results-btn-primary">← Back to quiz</a>
  </div>

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

    <a href="quiz.php" class="results-btn-primary">← Back to quiz</a>

</main>

</body>
</html>