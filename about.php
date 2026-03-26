<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <title>Visually Barkcloth</title>
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
      <a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a>
    </li>
  </ul>
</nav>

</body>
</html>