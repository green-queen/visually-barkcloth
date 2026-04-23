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
  <nav class="nav black-stripe">
    <ul>
      <li><a class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
      <li><a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Quiz</a></li>
      <li><a class="<?= ($currentPage == 'annotations.php') ? 'active' : '' ?>" href="annotations.php">Annotations</a></li>
      <li><a class="<?= ($currentPage == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a></li>
      <li><a class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
    </ul>
  </nav>

    <a class="view-btn-filter" href="filters.php" title="Back to Filters" style="position:fixed; top:57px; left:1rem; z-index:10000;">&#8592; Back to Filters</a>

    <div class="view-toggle">
        <button class="view-btn active" id="btn-float" title="Float view">
            Float
        </button>
        <button class="view-btn" id="btn-grid" title="Grid view">
            Grid
        </button>
    </div>

    <main class="page">

        <h2 class="choice-title">Shapes</h2>

        <div class="filter-bar" id="filter-bar">
        <button class="filter-btn" data-shape="square" title="Square">
            <svg width="32" height="32" viewBox="0 0 32 32"><rect x="4" y="4" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="rhombus" title="Rhombus">
            <svg width="32" height="32" viewBox="0 0 32 32"><polygon points="16,2 30,16 16,30 2,16" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="rectangle" title="Rectangle">
            <svg width="32" height="32" viewBox="0 0 32 32"><rect x="2" y="8" width="28" height="16" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        </div>

        <div class="filter-bar" id="filter-bar">
        <button class="filter-btn" data-shape="right" title="Right Triangle">
            <svg width="32" height="32" viewBox="0 0 32 32"><polygon points="4,28 4,4 28,28" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="equilateral" title="Equilateral Triangle">
            <svg width="32" height="32" viewBox="0 0 32 32"><polygon points="16,3 30,28 2,28" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="isoceles" title="Isosceles Triangle">
            <svg width="32" height="32" viewBox="0 0 32 32"><polygon points="16,3 26,28 6,28" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        </div>

        <div class="filter-bar" id="filter-bar">
        <button class="filter-btn" data-shape="circle" title="Circle">
            <svg width="32" height="32" viewBox="0 0 32 32"><circle cx="16" cy="16" r="12" fill="none" stroke="currentColor" stroke-width="1"/></svg>
        </button>
        <button class="filter-btn" data-shape="line" title="Line">
            <svg width="32" height="32" viewBox="0 0 32 32"><line x1="4" y1="16" x2="28" y2="16" stroke="currentColor" stroke-width="1" stroke-linecap="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="curve" title="Curve">
            <svg width="32" height="32" viewBox="0 0 32 32"><path d="M4,26 Q16,2 28,26" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="cross" title="Cross">
            <svg width="32" height="32" viewBox="0 0 32 32"><line x1="16" y1="4" x2="16" y2="28" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="4" y1="16" x2="28" y2="16" stroke="currentColor" stroke-width="1" stroke-linecap="round"/></svg>
        </button>
        </div>

        <div class="filter-bar" id="filter-bar">
        <button class="filter-btn" data-shape="sun" title="Sun">
            <svg width="32" height="32" viewBox="0 0 32 32"><circle cx="16" cy="16" r="5" fill="none" stroke="currentColor" stroke-width="1"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="16" y1="26" x2="16" y2="30" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="2" y1="16" x2="6" y2="16" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="26" y1="16" x2="30" y2="16" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="5.9" y1="5.9" x2="8.8" y2="8.8" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="23.2" y1="23.2" x2="26.1" y2="26.1" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="23.2" y1="8.8" x2="26.1" y2="5.9" stroke="currentColor" stroke-width="1" stroke-linecap="round"/><line x1="5.9" y1="26.1" x2="8.8" y2="23.2" stroke="currentColor" stroke-width="1" stroke-linecap="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="moon" title="Moon">
        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
        </button>
        <button class="filter-btn" data-shape="star" title="Star">
            <svg width="32" height="32" viewBox="0 0 32 32"><polygon points="16,2 19.5,12 30,12 21.5,18.5 24.7,29 16,22.5 7.3,29 10.5,18.5 2,12 12.5,12" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/></svg>
        </button>
        <button class="filter-btn" data-shape="flower" title="Flower">
        <svg width="32" height="32" viewBox="0 0 32 32">
            <ellipse cx="16" cy="8" rx="3" ry="5" fill="none" stroke="currentColor" stroke-width="1"/>
            <ellipse cx="16" cy="8" rx="3" ry="5" fill="none" stroke="currentColor" stroke-width="1" transform="rotate(60 16 16)"/>
            <ellipse cx="16" cy="8" rx="3" ry="5" fill="none" stroke="currentColor" stroke-width="1" transform="rotate(120 16 16)"/>
            <ellipse cx="16" cy="8" rx="3" ry="5" fill="none" stroke="currentColor" stroke-width="1" transform="rotate(180 16 16)"/>
            <ellipse cx="16" cy="8" rx="3" ry="5" fill="none" stroke="currentColor" stroke-width="1" transform="rotate(240 16 16)"/>
            <ellipse cx="16" cy="8" rx="3" ry="5" fill="none" stroke="currentColor" stroke-width="1" transform="rotate(300 16 16)"/>
            <circle cx="16" cy="16" r="3" fill="none" stroke="currentColor" stroke-width="1"/>
        </svg>
        </button>
        </div>

        <div class="filter-bar" id="filter-bar">
            <button id="clear-filters" class="clear-btn">Clear All</button>
        </div>

        <section class="barkcloth-list" id="barkcloth-list">
        </section>
    </main>

    <div id="floating-layer"></div>
    <div id="grid-layer"><div class="grid-inner" id="grid-inner"></div></div>
    <div id="no-match">No barkcloths match the selected filters.</div>

    <div id="card-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:100000; cursor:pointer;">
      <div id="card-modal-inner" style="background:#fff; padding:2rem; max-width:480px; width:90%; cursor:default; display:flex; flex-direction:column; align-items:center; gap:1rem;">
        <img id="card-modal-img" src="" alt="" style="max-width:100%; max-height:50vh; object-fit:contain;">
        <div id="card-modal-id" style="font-weight:bold; font-size:1.1rem;"></div>
        <div id="card-modal-origin" style="opacity:0.7;"></div>
        <div id="card-modal-shapes" style="font-size:0.9rem;"></div>
        <a id="card-modal-link" href="#" target="_blank" rel="noopener noreferrer" style="margin-top:0.5rem; color: rgba(165, 17, 17, 0.8);word-spacing: 0.2em;">View Source</a>
      </div>
    </div>

    <script>
        let currentView = 'float'; // 'float' or 'grid'

        // modal logic
        const cardModal      = document.getElementById('card-modal');
        const cardModalInner = document.getElementById('card-modal-inner');

        function openModal(bc) {
          document.getElementById('card-modal-img').src    = 'img/' + bc.id + '.png';
          document.getElementById('card-modal-img').alt    = bc.id;
          document.getElementById('card-modal-id').textContent     = bc.id;
          document.getElementById('card-modal-origin').textContent = bc.origin;
          document.getElementById('card-modal-shapes').textContent = bc.shapes.length > 0 ? 'Shapes: ' + bc.shapes.join(', ') : '';

          const link = document.getElementById('card-modal-link');
          if (bc.link) {
            link.href = bc.link;
            link.style.display = 'inline';
          } else {
            link.style.display = 'none';
          }

          cardModal.style.display = 'flex';
        }

        // clicking the backdrop closes the modal; clicking inside does not
        cardModal.addEventListener('click', function () {
          cardModal.style.display = 'none';
        });
        cardModalInner.addEventListener('click', function (e) {
          e.stopPropagation();
        });

        document.getElementById('btn-float').addEventListener('click', function () {
            if (currentView === 'float') return;
            currentView = 'float';
            this.classList.add('active');
            document.getElementById('btn-grid').classList.remove('active');
            document.getElementById('grid-layer').classList.remove('visible');
            renderBarkcloths();
        });

        document.getElementById('btn-grid').addEventListener('click', function () {
            if (currentView === 'grid') return;
            currentView = 'grid';
            this.classList.add('active');
            document.getElementById('btn-float').classList.remove('active');
            document.getElementById('floating-layer').innerHTML = '';
            document.getElementById('grid-layer').classList.add('visible');
            renderBarkcloths();
        });

        const barkcloths = [
            { id: "RV-4706-120", origin: "Fiji", shapes: ["square", "right", "circle", "line", "cross", "flower"], link: "https://hdl.handle.net/20.500.11840/795173" },
            { id: "RV-265-1b", origin: "Futuna", shapes: ["square", "line", "cross", "sun"], link: "https://hdl.handle.net/20.500.11840/598299" },
            { id: "RV-09-220", origin: "Tonga", shapes: ["moon"], link: "https://hdl.handle.net/20.500.11840/838810" },
            { id: "RV-489-87", origin: "Tonga", shapes: ["equilateral", "circle", "line"], link: "https://hdl.handle.net/20.500.11840/660559" },
            { id: "RV-4241-1", origin: "Tonga", shapes: ["equilateral", "circle", "sun", "moon", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/787757" },
            { id: "RV-4518-17", origin: "Tonga", shapes: ["right", "circle", "line", "moon", "star"], link: "https://hdl.handle.net/20.500.11840/791809" },
            { id: "RV-4518-18", origin: "Tonga", shapes: ["equilateral", "circle", "moon", "flower"], link: "https://hdl.handle.net/20.500.11840/791810" },
            { id: "RV-4518-19", origin: "Tonga", shapes: ["equilateral", "isoceles", "flower"], link: "https://hdl.handle.net/20.500.11840/791811" },
            { id: "RV-4518-22", origin: "Tonga", shapes: ["right", "equilateral", "circle", "cross", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/791814" },
            { id: "RV-4518-25", origin: "Tonga", shapes: ["right", "cross", "flower"], link: "https://hdl.handle.net/20.500.11840/791817" },
            { id: "RV-4518-26", origin: "Tonga", shapes: ["right", "circle", "flower"], link: "https://hdl.handle.net/20.500.11840/791818" },
            { id: "RV-4518-27", origin: "Tonga", shapes: ["right", "equilateral", "cross", "flower"], link: "https://hdl.handle.net/20.500.11840/791819" },
            { id: "RV-4518-30", origin: "Tonga", shapes: ["equilateral", "line", "moon"], link: "https://hdl.handle.net/20.500.11840/791822" },
            { id: "RV-4518-32", origin: "Tonga", shapes: ["square", "line", "curve"], link: "https://hdl.handle.net/20.500.11840/791824" },
            { id: "RV-265-7", origin: "Samoa", shapes: ["equilateral", "circle", "curve", "cross", "sun", "moon"], link: "https://hdl.handle.net/20.500.11840/598304" },
            { id: "RV-489-83", origin: "Samoa", shapes: ["isoceles", "line", "curve"], link: "https://hdl.handle.net/20.500.11840/660555" },
            { id: "RV-489-84", origin: "Samoa", shapes: ["line"], link: "https://hdl.handle.net/20.500.11840/660556" },
            { id: "RV-489-85", origin: "Samoa", shapes: ["line", "cross", "moon", "star"], link: "https://hdl.handle.net/20.500.11840/660557" },
            { id: "RV-489-88", origin: "Samoa", shapes: ["right", "equilateral", "isoceles", "line"], link: "https://hdl.handle.net/20.500.11840/660560" },
            { id: "RV-552-5", origin: "Samoa", shapes: ["square", "equilateral", "line", "curve"], link: "https://hdl.handle.net/20.500.11840/662722" },
            { id: "RV-828-122", origin: "Samoa", shapes: ["line", "curve"], link: "https://hdl.handle.net/20.500.11840/673330" },
            { id: "RV-1141-133", origin: "Samoa", shapes: ["equilateral", "line"], link: "https://hdl.handle.net/20.500.11840/686065" },
            { id: "RV-912-4", origin: "East Polynesian (Polynesia / Hawaii)", shapes: ["circle", "line"], link: "" },
            { id: "RV-3600-7499", origin: "West Papua (Nafri, Sentani)", shapes: [], link: "https://hdl.handle.net/20.500.11840/777783" },
            { id: "RV-121-65", origin: "West Papua (Karon)", shapes: ["square", "rhombus", "circle", "line", "curve", "cross", "sun"], link: "https://hdl.handle.net/20.500.11840/595932" },
            { id: "RV-2972-2", origin: "West Papua (Karon)", shapes: ["square", "rhombus", "right", "equilateral", "isoceles", "circle", "line", "curve", "cross"], link: "https://hdl.handle.net/20.500.11840/757315" },
            { id: "RV-2953-2", origin: "West Papua (Wandamen, probably Karon)", shapes: ["square", "rhombus", "rectangle", "right", "equilateral", "circle", "line", "curve", "cross"], link: "https://hdl.handle.net/20.500.11840/754845" },
            { id: "RV-1759-31", origin: "Pebato", shapes: ["square", "rhombus", "right", "equilateral", "circle", "line", "curve", "sun", "moon"], link: "https://hdl.handle.net/20.500.11840/718435" },
            { id: "RV-03-277", origin: "Toraja", shapes: ["rhombus", "line", "curve", "moon"], link: "https://hdl.handle.net/20.500.11840/828350" },
            { id: "RV-03-2400", origin: "Toraja", shapes: ["rhombus", "equilateral", "line", "curve", "cross", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/849873" },
            { id: "RV-776-45", origin: "Toraja", shapes: ["circle", "curve", "cross", "sun"], link: "https://hdl.handle.net/20.500.11840/671205" },
            { id: "RV-776-45a", origin: "Toraja", shapes: ["right", "equilateral", "circle", "cross", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/671206" },
            { id: "RV-1232-93", origin: "Toraja", shapes: ["circle", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/690654" },
            { id: "RV-1372-2", origin: "Toraja (Poso Toraja)", shapes: ["square", "rhombus", "equilateral", "circle", "curve", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/701086" },
            { id: "RV-1232-87", origin: "Toraja", shapes: ["equilateral", "isoceles", "circle", "line", "curve", "cross", "star", "flower"], link: "https://hdl.handle.net/20.500.11840/690648" },
            { id: "RV-1232-92", origin: "Toraja", shapes: ["rhombus", "line", "curve"], link: "https://hdl.handle.net/20.500.11840/690653" },
            { id: "RV-1759-27", origin: "Pebato", shapes: ["equilateral", "circle", "line", "sun", "star"], link: "https://hdl.handle.net/20.500.11840/718431" },
            { id: "RV-1232-90", origin: "Toraja", shapes: ["square", "rectangle", "equilateral", "line", "curve", "flower"], link: "https://hdl.handle.net/20.500.11840/690651" },
            { id: "RV-1926-205", origin: "Toraja (Poso Toraja)", shapes: ["rhombus", "circle", "line", "curve", "moon", "flower"], link: "https://hdl.handle.net/20.500.11840/724867" },
            { id: "RV-1759-36", origin: "Toraja (Lage)", shapes: ["rhombus", "right", "equilateral", "line", "curve", "moon"], link: "https://hdl.handle.net/20.500.11840/718440" },
            { id: "RV-1759-38", origin: "Toraja (Lage)", shapes: ["square", "equilateral", "line", "cross", "star"], link: "https://hdl.handle.net/20.500.11840/718442" },
            { id: "RV-1926-211", origin: "Toraja (Poso Toraja)", shapes: ["square", "rhombus", "right", "equilateral", "circle", "line", "curve", "cross", "flower"], link: "https://hdl.handle.net/20.500.11840/724873" },
            { id: "RV-03-276", origin: "Toraja", shapes: ["circle", "star"], link: "https://hdl.handle.net/20.500.11840/828349" },
            { id: "RV-03-2349", origin: "Toraja", shapes: ["right", "circle", "star"], link: "https://hdl.handle.net/20.500.11840/849473" },
            { id: "RV-1232-94", origin: "Toraja", shapes: ["rhombus", "line", "curve"], link: "https://hdl.handle.net/20.500.11840/690655" },
            { id: "RV-03-2391", origin: "Toraja (Poso Toraja)", shapes: ["square", "rhombus", "equilateral", "isoceles", "line", "curve"], link: "https://hdl.handle.net/20.500.11840/849514" },
        ];

        let selectedShapes = [];

        // filter button clicks
        let buttons = document.querySelectorAll('.filter-btn');
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', function () {
                let shape = this.dataset.shape;
                this.classList.toggle('selected');

                if (selectedShapes.includes(shape)) {
                    // remove
                    let index = selectedShapes.indexOf(shape);
                    selectedShapes.splice(index, 1);
                } else {
                    // add
                    selectedShapes.push(shape);
                }

                renderBarkcloths();
            });
        }

        document.getElementById('clear-filters').addEventListener('click', function () {
            selectedShapes = [];
            let buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('selected'));
            document.getElementById('floating-layer').innerHTML = '';
            document.getElementById('grid-inner').innerHTML = '';
            document.getElementById('no-match').style.display = 'none';
        });

        function makeCardHTML(bc) {
            let shapeList = bc.shapes.length > 0 ? bc.shapes.join(', ') : 'No shapes';
            return '<img src="img/' + bc.id + '.png" alt="' + bc.id + '" onerror="this.style.display=\'none\'">' +
                   '<div class="card-id">' + bc.id + '</div>' +
                   '<div class="card-origin">' + bc.origin + '</div>' +
                   '<div class="card-shapes">' + shapeList + '</div>';
        }

        function renderBarkcloths() {
            let floatingLayer = document.getElementById('floating-layer');
            let gridInner     = document.getElementById('grid-inner');
            let noMatch       = document.getElementById('no-match');

            floatingLayer.innerHTML = '';
            gridInner.innerHTML     = '';
            noMatch.style.display   = 'none';

            if (selectedShapes.length === 0) return;

            // find barkcloths w all selected shapes
            let filtered = [];
            for (let i = 0; i < barkcloths.length; i++) {
                let bc = barkcloths[i];
                let hasAllShapes = true;
                for (let j = 0; j < selectedShapes.length; j++) {
                    if (!bc.shapes.includes(selectedShapes[j])) {
                        hasAllShapes = false;
                        break;
                    }
                }
                if (hasAllShapes) filtered.push(bc);
            }

            if (filtered.length === 0) {
                noMatch.style.display = 'block';
                return;
            }

            if (currentView === 'grid') {
                for (let i = 0; i < filtered.length; i++) {
                    let bc = filtered[i];

                    let card = document.createElement('div');
                    card.className = 'grid-card';
                    card.style.animationDelay = (i * 0.04) + 's';
                    card.style.cursor = 'pointer';
                    card.innerHTML = makeCardHTML(bc);
                    card.addEventListener('click', (function(b) {
                        return function() { openModal(b); };
                    })(bc));

                    gridInner.appendChild(card);
                }
            } else {
                for (let i = 0; i < filtered.length; i++) {
                    let bc = filtered[i];

                    let xSpeed = Math.random() * 9 + 9;
                    let ySpeed = Math.random() * 5 + 5;
                    let xDelay = Math.random() * -xSpeed;
                    let yDelay = Math.random() * -ySpeed;
                    let xEnd   = 'calc(' + (Math.random() * 40 + 60) + 'vw - 180px)';
                    let yEnd   = 'calc(' + (Math.random() * 40 + 60) + 'vh - 180px)';
                    let rotate = Math.random() * 12 - 6;
                    let goRight = i % 2 === 0;

                    let xWrap = document.createElement('div');
                    xWrap.className = 'card-x ' + (goRight ? 'go-right' : 'go-left');
                    xWrap.style.cssText =
                        '--x-speed: ' + xSpeed + 's;' +
                        '--x-delay: ' + xDelay + 's;' +
                        '--x-end: ' + xEnd + ';' +
                        'top: 0; left: 0;';

                    let yWrap = document.createElement('div');
                    yWrap.className = 'card-y';
                    yWrap.style.cssText =
                        '--y-speed: ' + ySpeed + 's;' +
                        '--y-delay: ' + yDelay + 's;' +
                        '--y-end: ' + yEnd + ';';

                    let card = document.createElement('div');
                    card.className = 'floating-card';
                    card.style.setProperty('--rotate', rotate + 'deg');
                    card.style.cursor = 'pointer';
                    card.innerHTML = makeCardHTML(bc);
                    card.addEventListener('click', (function(b) {
                        return function() { openModal(b); };
                    })(bc));

                    yWrap.appendChild(card);
                    xWrap.appendChild(yWrap);
                    floatingLayer.appendChild(xWrap);
                }
            }
        }

        renderBarkcloths();
    </script>
</body>

</html>