<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <title>Visually Barkcloth</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<nav class="nav">
  <ul>
    <li>
      <a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a>
    </li>
    <li>
      <a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Ideas?</a>
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

  <main class="page" style="position: relative;">
    <div id="submission-count">Submissions: 0</div>

    <?php if (!empty($_SESSION['submissions'])): ?>
      <a href="results.php" class="results-link">View your last results →</a>
    <?php endif; ?>

    <div id="quiz-container"></div>
    <div id="img-modal"
      style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:9999; cursor:pointer;">
      <img id="modal-img" src="" alt="Enlarged barkcloth image" style="max-width:90vw; max-height:90vh;">
    </div>
  </main>

  <script>

    const QUESTIONS = [
      {
        type: 'multiple',
        text: 'What building blocks do you see?',
        options: ['Cross']
      },
      {
        type: 'text',
        text: 'What pattern rhythm do you see?'
      },
      {
        type: 'text',
        text: 'What is the first thing you think of when you see this textile?'
      },
      {
        type: 'text',
        text: 'What pattern do you see?'
      }
    ];

    // allowlist for all checkbox dropdown values — validated on getChecked()
    const VALID_SHAPES = {
      'square-dropdown':   ['square', 'rectangle', 'rhombus'],
      'circle-dropdown':   ['circle', 'oval', 'dot'],
      'triangle-dropdown': ['equilateral', 'right', 'isosceles', 'scalene'],
      'lines-dropdown':    ['regular', 'dotted', 'curved'],
    };

    // escapes string for safe insertion into HTML
    function escapeHTML(str) {
      const div = document.createElement('div');
      div.textContent = str ?? '';
      return div.innerHTML;
    }

    // strips non-alphanumeric characters (except _ and -) from IDs
    function sanitizeId(id) {
      return String(id ?? '').replace(/[^a-zA-Z0-9_-]/g, '');
    }

    // trims and caps a string field to a max length
    function sanitizeField(val, maxLen = 500) {
      return String(val ?? '').trim().slice(0, maxLen);
    }

    function parseCSV(text) {
      const lines = text.trim().split('\n');
      const headers = splitCSVLine(lines[0]);
      return lines.slice(1).map(line => {
        const values = splitCSVLine(line);
        return Object.fromEntries(headers.map((h, i) => [h, values[i]?.trim() ?? '']));
      });
    }

    function splitCSVLine(line) {
      const result = [];
      let cur = '', inQuotes = false;
      for (const ch of line) {
        if (ch === '"') { inQuotes = !inQuotes; }
        else if (ch === ',' && !inQuotes) { result.push(cur); cur = ''; }
        else { cur += ch; }
      }
      result.push(cur);
      return result;
    }

    function pickRandom(arr) {
      return arr[Math.floor(Math.random() * arr.length)];
    }

    function getImageLink(barkcloth) {
      const safeId = sanitizeId(barkcloth.id);
      return `img/${safeId}.png`;
    }

    function getChecked(dropdownId) {
      const allowed = VALID_SHAPES[dropdownId] ?? [];
      return Array.from(
        document.querySelectorAll(`#${dropdownId} input[type="checkbox"]:checked`)
      )
        .map(cb => cb.value)
        .filter(v => allowed.includes(v))
        .join(', ');
    }

    // html builders
    function buildAnswerHTML(question) {
      if (question.type === 'multiple') {
        const dropdowns = [
          {
            id: "square-dropdown",
            label: "Square Shapes",
            options: [
              { value: "square",    text: "Square" },
              { value: "rectangle", text: "Rectangle" },
              { value: "rhombus",   text: "Rhombus" }
            ]
          },
          {
            id: "circle-dropdown",
            label: "Circular Shapes",
            options: [
              { value: "circle", text: "Circle" },
              { value: "oval",   text: "Oval" },
              { value: "dot",    text: "Dot" }
            ]
          },
          {
            id: "triangle-dropdown",
            label: "Triangular Shapes",
            options: [
              { value: "equilateral", text: "Equilateral" },
              { value: "right",       text: "Right" },
              { value: "isosceles",   text: "Isosceles" },
              { value: "scalene",     text: "Scalene" }
            ]
          },
          {
            id: "lines-dropdown",
            label: "Line Shapes",
            options: [
              { value: "regular", text: "Regular" },
              { value: "dotted",  text: "Dotted" },
              { value: "curved",  text: "Curved" }
            ]
          }
        ];

        const dropdownHTML = dropdowns.map(drop =>
          `<div class="dropdown" data-control="checkbox-dropdown" id="${escapeHTML(drop.id)}">
            <label class="dropdown-label">${escapeHTML(drop.label)}</label>
            <div class="dropdown-list">
              ${drop.options.map(opt => `
                <label class="dropdown-option">
                  <input type="checkbox" name="dropdown-group" value="${escapeHTML(opt.value)}" /> ${escapeHTML(opt.text)}
                </label>
              `).join('')}
            </div>
          </div>`
        ).join('');

        const optionsHTML = question.options.map(opt => `
          <label class="quiz-option">
            <input type="checkbox" name="answer" value="${escapeHTML(opt)}"> ${escapeHTML(opt)}
          </label>
        `).join('');

        return dropdownHTML + optionsHTML + `
          <label class="quiz-question">
            Other structures you see:
            <textarea class="quiz-textarea" name="answer" rows="4" placeholder="Your answer..."></textarea>
          </label>
        `;
      }

      return `
        <textarea class="quiz-textarea" name="answer" rows="4" placeholder="Your answer..."></textarea>
      `;
    }

    // quiz logic
    let barkcloth, question, submitCount = 0;

    function showQuiz(data) {
      const container = document.getElementById('quiz-container');
      barkcloth = pickRandom(data);
      question  = pickRandom(QUESTIONS);

      const safeImgSrc     = escapeHTML(getImageLink(barkcloth));
      const safeImgAlt     = escapeHTML(barkcloth.id);
      const safeCitation   = escapeHTML(barkcloth["reference citation"]);
      const safeQuestionTx = escapeHTML(question.text);
      const link = escapeHTML(barkcloth.link);

      container.innerHTML = `
      <div class="quiz-left">
        <img class="quiz-img" src="${safeImgSrc}" alt="${safeImgAlt}">
        <a href="${link}" target="_blank" class="quiz-citation">${safeCitation}</a>
      </div>
      <form id="quiz-form">
        <div class="quiz-question">${safeQuestionTx}</div>
        ${buildAnswerHTML(question)}
        <button class="quiz-submit" type="submit">Submit</button>
        <button class="quiz-skip" type="button" id="quiz-skip">Skip</button>
      </form>
    `;

      // img modal
      const quizImg  = container.querySelector('.quiz-img');
      const imgModal = document.getElementById('img-modal');
      const modalImg = document.getElementById('modal-img');

      quizImg.onclick = function () {
        modalImg.src = quizImg.src;
        imgModal.style.display = 'flex';
      };

      imgModal.onclick = function () {
        imgModal.style.display = 'none';
      };

      // checkbox dropdown w jquery
      if (document.querySelector('[data-control="checkbox-dropdown"]')) {
        (function ($) {
          var CheckboxDropdown = function (el) {
            var _this = this;
            this.isOpen = false;
            this.$el     = $(el);
            this.$label  = this.$el.find('.dropdown-label');
            this.$inputs = this.$el.find('[type="checkbox"]');
            this.$label.on('click', function (e) {
              e.preventDefault();
              _this.toggleOpen();
            });
          };
          CheckboxDropdown.prototype.toggleOpen = function (forceOpen) {
            var _this = this;
            if (!this.isOpen || forceOpen) {
              this.isOpen = true;
              this.$el.addClass('on');
              $(document).on('click', function (e) {
                if (!$(e.target).closest('[data-control]').length) {
                  _this.toggleOpen();
                }
              });
            } else {
              this.isOpen = false;
              this.$el.removeClass('on');
              $(document).off('click');
            }
          };
          var checkboxesDropdowns = document.querySelectorAll('[data-control="checkbox-dropdown"]');
          for (var i = 0, length = checkboxesDropdowns.length; i < length; i++) {
            new CheckboxDropdown(checkboxesDropdowns[i]);
          }
        })(jQuery);
      }

      // form skip
      document.getElementById('quiz-skip')
        .addEventListener('click', () => showQuiz(data));

      // form submission
      document.getElementById('quiz-form')
        .addEventListener('submit', async (e) => {
          e.preventDefault();

          const form      = e.target;
          const submitBtn = form.querySelector('.quiz-submit');

          const crossChecked = Array.from(
            form.querySelectorAll('input[name="answer"][type="checkbox"]:checked')
          )
            .map(cb => cb.value)
            .filter(v => ['Cross'].includes(v))
            .join(', ');

          const textareas       = form.querySelectorAll('textarea[name="answer"]');
          const structuresOther = textareas.length > 1 ? textareas[0].value.trim() : '';
          const generalTextarea = textareas[textareas.length - 1].value.trim();

          // all fields trimmed and cast to strings
          const payload = {
            barkcloth_id:     sanitizeField(barkcloth.id,              100),
            question:         sanitizeField(question.text,             200),
            square_shapes:    sanitizeField(getChecked('square-dropdown')),
            circle_shapes:    sanitizeField(getChecked('circle-dropdown')),
            triangle_shapes:  sanitizeField(getChecked('triangle-dropdown')),
            line_shapes:      sanitizeField(getChecked('lines-dropdown')),
            cross_shapes:     sanitizeField(crossChecked),
            structures_other: sanitizeField(structuresOther),
            textarea:         sanitizeField(generalTextarea,          2000),
          };

          submitBtn.disabled    = true;
          submitBtn.textContent = 'Saving…';

          try {
            const res  = await fetch('submit_quiz.php', {
              method:  'POST',
              headers: { 'Content-Type': 'application/json' },
              body:    JSON.stringify(payload),
            });

            const json = await res.json();

            if (!res.ok || json.error) {
              console.error('Submission error:', json.error);
            }
          } catch (err) {
            console.error('Network error:', err);
          }

          submitCount++;
          document.getElementById('submission-count').textContent = `Submissions: ${submitCount}`;

          // show results link after first submission in this session
          if (!document.querySelector('.results-link')) {
            const link = document.createElement('a');
            link.href = 'results.php';
            link.className = 'results-link';
            link.textContent = 'View your last results →';
            document.querySelector('main.page').insertBefore(link, document.getElementById('quiz-container'));
          }

          showQuiz(data);
        });
    }

    fetch('data/data.csv')
      .then(res => res.text())
      .then(csvText => showQuiz(parseCSV(csvText)))
      .catch(err => console.error("CSV failed to load:", err));
  </script>
</body>

</html>