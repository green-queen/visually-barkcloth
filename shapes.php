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

        <div class="view-toggle">
            <button class="view-btn active" id="btn-float" title="Float view">
                Float
            </button>
            <button class="view-btn" id="btn-grid" title="Grid view">
                Grid
            </button>
        </div>

    <main class="page">
        <div class="choice-icon">
            <svg viewBox="0 0 56 56" fill="none" stroke="var(--black)" stroke-width="1.5">
                <rect x="8" y="8" width="16" height="16" />
                <circle cx="42" cy="16" r="8" />
                <polygon points="8,48 24,32 8,32" />
                <path d="M32 40 L48 40 L40 32 Z" />
            </svg>
        </div>
        </div>

        <div class="filter-bar" id="filter-bar">
            <button class="filter-btn" data-shape="square">Square</button>
            <button class="filter-btn" data-shape="rhombus">Rhombus</button>
            <button class="filter-btn" data-shape="rectangle">Rectangle</button>
        </div>

        <div class="filter-bar" id="filter-bar">
            <button class="filter-btn" data-shape="right">Right Triangle</button>
            <button class="filter-btn" data-shape="equilateral">Equilateral Triangle</button>
            <button class="filter-btn" data-shape="isoceles">Isoceles Triangle</button>
        </div>

        <div class="filter-bar" id="filter-bar">
            <button class="filter-btn" data-shape="circle">Circle</button>
            <button class="filter-btn" data-shape="line">Line</button>
            <button class="filter-btn" data-shape="curve">Curve</button>
            <button class="filter-btn" data-shape="cross">Cross</button>
        </div>

        <div class="filter-bar" id="filter-bar">
            <button class="filter-btn" data-shape="sun">Sun</button>
            <button class="filter-btn" data-shape="moon">Moon</button>
            <button class="filter-btn" data-shape="star">Star</button>
            <button class="filter-btn" data-shape="flower">Flower</button>
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

    <script>
        let currentView = 'float'; // 'float' or 'grid'

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

            // remove "selected" class from all buttons
            let buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('selected'));

            // clear rendered results
            document.getElementById('floating-layer').innerHTML = '';
            document.getElementById('grid-inner').innerHTML = '';
            document.getElementById('no-match').style.display = 'none';
        });

        function renderBarkcloths() {
            let floatingLayer = document.getElementById('floating-layer');
            let gridInner = document.getElementById('grid-inner');
            let noMatch = document.getElementById('no-match');

            floatingLayer.innerHTML = '';
            gridInner.innerHTML = '';
            noMatch.style.display = 'none';

            if (selectedShapes.length === 0) return;

            // find barkcloths with all selected shapes
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
                if (hasAllShapes) {
                    filtered.push(bc);
                }
            }

            if (filtered.length === 0) {
                noMatch.style.display = 'block';
                return;
            }

            if (currentView === 'grid') {
                for (let i = 0; i < filtered.length; i++) {
                    let bc = filtered[i];
                    let shapeList = bc.shapes.length > 0 ? bc.shapes.join(', ') : 'No shapes';

                    let cardLink = document.createElement('a');
                    cardLink.href = bc.link || '#';
                    cardLink.target = '_blank';
                    cardLink.className = 'grid-card';
                    cardLink.style.animationDelay = (i * 0.04) + 's';
                    cardLink.innerHTML =
                        '<img src="img/' + bc.id + '.png" alt="' + bc.id + '" onerror="this.style.display=\'none\'">' +
                        '<div class="card-id">' + bc.id + '</div>' +
                        '<div class="card-origin">' + bc.origin + '</div>' +
                        '<div class="card-shapes">' + shapeList + '</div>';

                    gridInner.appendChild(cardLink);
                }
            } else {
                for (let i = 0; i < filtered.length; i++) {
                    let bc = filtered[i];

                    // random speeds and positions for animations
                    let xSpeed = Math.random() * 9 + 9;   // 9 to 18
                    let ySpeed = Math.random() * 5 + 5;   // 5 to 10
                    let xDelay = Math.random() * -xSpeed;
                    let yDelay = Math.random() * -ySpeed;
                    let xEnd = 'calc(' + (Math.random() * 40 + 60) + 'vw - 180px)';
                    let yEnd = 'calc(' + (Math.random() * 40 + 60) + 'vh - 180px)';
                    let rotate = Math.random() * 12 - 6;  // -6 to 6
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

                    let cardLink = document.createElement('a');
                    cardLink.href = bc.link || '#';
                    cardLink.target = '_blank';
                    cardLink.className = 'floating-card';
                    cardLink.style.setProperty('--rotate', rotate + 'deg');

                    let shapeList = bc.shapes.length > 0 ? bc.shapes.join(', ') : 'No shapes';
                    cardLink.innerHTML =
                        '<img src="img/' + bc.id + '.png" alt="' + bc.id + '" onerror="this.style.display=\'none\'">' +
                        '<div class="card-id">' + bc.id + '</div>' +
                        '<div class="card-origin">' + bc.origin + '</div>' +
                        '<div class="card-shapes">' + shapeList + '</div>';

                    yWrap.appendChild(cardLink);
                    xWrap.appendChild(yWrap);
                    floatingLayer.appendChild(xWrap);
                }
            }
        }

        renderBarkcloths();
    </script>
</body>

</html>