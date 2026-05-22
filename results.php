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
    <h2 class="wordcloud-title">My Ideas</h2>
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

  <section class="wordcloud-section" id="wordcloud-section">
    <h2 class="wordcloud-title">What everyone sees</h2>
    <p class="wordcloud-loading" id="wc-status">Loading…</p>
    <canvas id="wordcloud-canvas" width="860" height="480"></canvas>
  </section>

  <section class="wordcloud-section" id="wordcloud-section">

    <h2 class="wordcloud-title">Leave a thought</h2>

    <form class="comment-form" id="comment-form" novalidate>

      <div>
        <label for="cf-name">What do you want to be called? </label>
        <input
          type="text" id="cf-name" name="name"
          maxlength="20" autocomplete="nickname"
          aria-required="true" aria-describedby="cf-name-count"
          placeholder="Your (nick)name"
        >
        <p class="char-counter" id="cf-name-count" aria-live="polite">0 / 20</p>
      </div>

      <div>
        <label for="cf-role">What do you do?</label>
        <input
          type="text" id="cf-role" name="role"
          maxlength="40" autocomplete="organization-title"
          aria-required="true" aria-describedby="cf-role-count"
          placeholder="e.g. Student, Researcher, Textile lover"
        >
        <p class="char-counter" id="cf-role-count" aria-live="polite">0 / 40</p>
      </div>

      <div class="field-full">
        <label for="cf-comment">Comment</label>
        <textarea
          id="cf-comment" name="comment"
          maxlength="200"
          aria-required="true" aria-describedby="cf-comment-count"
          placeholder="Is there anything you want to share with us?"
        ></textarea>
        <p class="char-counter" id="cf-comment-count" aria-live="polite">0 / 200</p>
      </div>

      <div class="comment-form-footer field-full">
        <button type="submit" class="comment-submit-btn" id="cf-submit">Post comment</button>
        <span class="comment-form-msg" id="cf-msg" role="alert" aria-live="assertive"></span>
      </div>

    </form>

  <div class="comment-list-scrollbox">
    <div class="comment-list" id="comment-list" aria-live="polite">
      <p class="comments-loading" id="comments-loading">Loading comments…</p>
    </div>
  </div>
  </section>

</main>

<script>
  (function () {
    const canvas = document.getElementById('wordcloud-canvas');
    const status = document.getElementById('wc-status');

    const palette = [
      '#67c6e6', '#34db9e', '#2C1320', '#E6236E',
      '#B61D0F', '#9f7263', '#532F25', '#D6B51D', '#989190', '#1B396C'
    ];

    fetch('wordcloud_data.php')
      .then(r => r.json())
      .then(words => {
        if (!words.length) {
          status.textContent = '';
          return;
        }
        status.textContent = '';
        const maxWeight = words[0][1];
        const minWeight = words[words.length - 1][1];
        const range     = maxWeight - minWeight || 1;
        const scaled    = words.map(([word, weight]) => {
          const ratio = (weight - minWeight) / range;
          return [word, Math.round(14 + ratio * 56)];
        });
        WordCloud(canvas, {
          list:            scaled,
          gridSize:        8,
          weightFactor:    1,
          fontFamily:      'Georgia, serif',
          color:           () => palette[Math.floor(Math.random() * palette.length)],
          rotateRatio:     0.3,
          rotationSteps:   2,
          backgroundColor: '#faf6ee',
          shuffle:         true,
          drawOutOfBound:  false,
          minSize:         10,
        });
      })
      .catch(() => { status.textContent = 'Could not load word cloud data.'; });
  })();

  (function () {
    'use strict';

    const form      = document.getElementById('comment-form');
    const nameInput = document.getElementById('cf-name');
    const roleInput = document.getElementById('cf-role');
    const commentTA = document.getElementById('cf-comment');
    const submitBtn = document.getElementById('cf-submit');
    const msgEl     = document.getElementById('cf-msg');
    const listEl    = document.getElementById('comment-list');
    const loadingEl = document.getElementById('comments-loading');

    function setupCounter(inputEl, counterId, max) {
      const counter = document.getElementById(counterId);
      function update() {
        const len = inputEl.value.length;
        counter.textContent = len + ' / ' + max;
        counter.classList.toggle('near-limit', len >= max * 0.8 && len < max);
        counter.classList.toggle('at-limit',   len >= max);
      }
      inputEl.addEventListener('input', update);
      update();
    }
    setupCounter(nameInput,  'cf-name-count',    20);
    setupCounter(roleInput,  'cf-role-count',    40);
    setupCounter(commentTA,  'cf-comment-count', 200);

    function validate() {
      const name    = nameInput.value.trim();
      const role    = roleInput.value.trim();
      const comment = commentTA.value.trim();
      if (!name || name.length < 2)       return 'Name must be at least 2 characters.';
      if (name.length > 20)               return 'Name is too long.';
      if (!role || role.length < 2)       return 'Role must be at least 2 characters.';
      if (role.length > 40)               return 'Role is too long.';
      if (!comment || comment.length < 5) return 'Comment must be at least 5 characters.';
      if (comment.length > 200)           return 'Comment is too long.';
      return null;
    }

    function esc(s) {
      return String(s)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
    }

    function renderCard(c, prepend) {
      const card = document.createElement('div');
      card.className = 'comment-card';
      card.dataset.id = c.id;
      card.innerHTML =
        '<div class="comment-card-meta">' +
          '<span class="comment-card-name">' + esc(c.name) + '</span>' +
          '<span class="comment-card-role">'  + esc(c.role) + '</span>' +
        '</div>' +
        '<p class="comment-card-body">' + esc(c.comment) + '</p>';

      if (prepend && listEl.firstChild) {
        listEl.insertBefore(card, listEl.firstChild);
      } else {
        listEl.appendChild(card);
      }
    }

    fetch('comments_get.php')
      .then(r => { if (!r.ok) throw new Error(); return r.json(); })
      .then(comments => {
        loadingEl.remove();
        if (!comments.length) {
          const p = document.createElement('p');
          p.className = 'comments-empty';
          p.textContent = 'No comments yet — be the first!';
          listEl.appendChild(p);
          return;
        }
        comments.forEach(c => renderCard(c, false));
      })
      .catch(() => { loadingEl.textContent = 'Could not load comments.'; });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      msgEl.className   = 'comment-form-msg';
      msgEl.textContent = '';

      const err = validate();
      if (err) {
        msgEl.className   = 'comment-form-msg error';
        msgEl.textContent = err;
        return;
      }

      submitBtn.disabled    = true;
      submitBtn.textContent = 'Posting…';

      fetch('comments_post.php', {
        method:  'POST',
        headers: { 'Content-Type': 'application/json' },
        body:    JSON.stringify({
          name:    nameInput.value.trim(),
          role:    roleInput.value.trim(),
          comment: commentTA.value.trim(),
        }),
      })
        .then(r => r.json().then(data => ({ ok: r.ok, data })))
        .then(({ ok, data }) => {
          if (!ok || !data.success) throw new Error(data.error || 'Submission failed.');

          const emptyEl = listEl.querySelector('.comments-empty');
          if (emptyEl) emptyEl.remove();

          renderCard({
            id:      data.id,
            name:    nameInput.value.trim(),
            role:    roleInput.value.trim(),
            comment: commentTA.value.trim(),
          }, true);

          msgEl.className   = 'comment-form-msg success';
          msgEl.textContent = 'Comment posted';
          form.reset();

          [['cf-name-count','0 / 20'],['cf-role-count','0 / 40'],['cf-comment-count','0 / 200']]
            .forEach(([id, txt]) => { document.getElementById(id).textContent = txt; });
        })
        .catch(err => {
          msgEl.className   = 'comment-form-msg error';
          msgEl.textContent = err.message || 'Could not post comment. Please try again.';
        })
        .finally(() => {
          submitBtn.disabled    = false;
          submitBtn.textContent = 'Post comment';
        });
    });

  })();
</script>

</body>
</html>