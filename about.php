<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <title>About — Visually Barkcloth</title>
</head>

<body class="hero">
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

<main class="about-hero-wrap">
  <div class="about-page">

  <section class="about-section">
    <div class="about-section-header">
      <span class="about-section-num">01</span>
      <span class="about-section-title" id="section-textile">The Textile</span>
    </div>
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

  <section class="about-section">
    <div class="about-section-header">
      <span class="about-section-num">02</span>
      <span class="about-section-title" id="section-game">The Game</span>
    </div>
    <p class="about-body">
      <em>Visually the Barkcloth</em> is an experiment in looking differently. What if, instead of starting
      with labels like "Indonesia," "Polynesia," "tapa," or "fuya," you started with what you actually see?
      A stripe. A repeating curve. Something that almost looks like a crescent, or maybe just a shape
      that does not have a name yet.
    </p>
    <p class="about-body">
      This project takes a collection of barkcloth objects from Wereldmuseum Leiden in the Netherlands
      and reorganizes them by their visual patterns — their building blocks and structural forms — rather
      than by where they came from. When you search this way, surprising things happen. Objects from
      opposite ends of the Austronesian world start to find each other.
    </p>
  </section>

  <div class="about-deco">
    <img src="deco/IMG_3708.jpg" alt="">
  </div>

  <section class="about-section">
    <div class="about-section-header">
      <span class="about-section-num">03</span>
      <span class="about-section-title" id="section-turn">Your Turn</span>
    </div>
    <p class="about-body">
      On this website, you can view digitized barkcloth objects and share what you see with us. There are
      some multiple-choice questions to get you started, and space to write freely if you want. After you
      respond, you can see what other people said — people from different backgrounds, different places,
      different ways of looking.
    </p>
    <p class="about-body">
      You can also compare your interpretation with the analysis of Simon Kooijman, a curator at
      Wereldmuseum Leiden in the 1960s and 1970s who spent years studying these exact objects. He was
      brilliant and careful. He was also, sometimes, guessing — just like you might be.
    </p>
    <p class="about-body">
      Reading his descriptions closely, you can find the moments where he was not quite sure either:
      where he wrote "buffalo horn-like, but not clearly a buffalo horn," or proposed a connection he
      could not fully prove. That is not a failure. That is what interpretation looks like without enough
      information, honestly.
    </blockquote>
    <p class="about-body">
      There are no right answers here. The goal is not to decode barkcloth, but to see what happens when
      many different people pay close attention to the same objects, and what kinds of knowledge emerge
      from that shared experience of observation.
    </p>
  </section>

  <div class="about-deco">
    <img src="deco/IMG_3712.jpg" alt="">
  </div>

  <footer class="about-note">
    <p class="about-note-label">A Note</p>
    <p class="about-body">
      This project is part of an ongoing doctoral research on digital archives, material culture, and how
      we organize knowledge. It is built on the belief that the categories we inherit are worth questioning,
      and that the best way to question them is to play, look carefully, and stay curious.
    </p>
    <p class="about-body">
      <em>Visually the Barkcloth</em> is imperfect and a work in progress. Welcome — and have fun.
    </p>
  </footer>

  </div>
</main>

</body>
</html>