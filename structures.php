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
      <li><a class="<?= ($currentPage == 'quiz.php') ? 'active' : '' ?>" href="quiz.php">Ideas?</a></li>
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

    <h2 class="choice-title">Structures</h2>

    <div class="filter-bar" id="filter-bar">
    <button class="filter-btn" data-structure="square-concentric-structure" title="Square Concentric Structure">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round">
        <rect x="4" y="4" width="24" height="24"/>
        <rect x="9" y="9" width="14" height="14"/>
        <rect x="14" y="14" width="4" height="4"/>
        </svg>
    </button>

    <button class="filter-btn" data-structure="square-cross-structure" title="Square Cross Structure">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1" stroke-linejoin="round" stroke-linecap="round">
        <rect x="4" y="4" width="24" height="24"/>
        <line x1="4" y1="4" x2="28" y2="28"/>
        <line x1="28" y1="4" x2="4" y2="28"/>
        </svg>
    </button>

    <button class="filter-btn" data-structure="grid-structure" title="Grid Structure">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round">
        <line x1="4" y1="4" x2="4" y2="28"/>
        <line x1="12" y1="4" x2="12" y2="28"/>
        <line x1="20" y1="4" x2="20" y2="28"/>
        <line x1="28" y1="4" x2="28" y2="28"/>
        <line x1="4" y1="4" x2="28" y2="4"/>
        <line x1="4" y1="12" x2="28" y2="12"/>
        <line x1="4" y1="20" x2="28" y2="20"/>
        <line x1="4" y1="28" x2="28" y2="28"/>
        </svg>
    </button>

    <button class="filter-btn" data-structure="horizontal-line-structure" title="Horizontal Line Structure">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
        <rect x="4" y="6" width="24" height="20"/>
        <line x1="4" y1="11" x2="28" y2="11"/>
        <line x1="4" y1="16" x2="28" y2="16"/>
        <line x1="4" y1="21" x2="28" y2="21"/>
        </svg>
    </button>

    <button class="filter-btn" data-structure="vertical-line-structure" title="Vertical Line Structure">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
        <rect x="4" y="6" width="24" height="20"/>
        <line x1="10" y1="6" x2="10" y2="26"/>
        <line x1="16" y1="6" x2="16" y2="26"/>
        <line x1="22" y1="6" x2="22" y2="26"/>
        </svg>
    </button>

   <button class="filter-btn" data-structure="sym" title="Symmetrical Structure">
    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
        <rect x="4" y="8" width="24" height="16"/>
        <line x1="16" y1="2" x2="16" y2="30" stroke-dasharray="2 2"/>
    </svg>
</button>

<button class="filter-btn" data-structure="a-sym" title="Asymmetrical Structure">
    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
        stroke="currentColor" stroke-width="1"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M4,8 L16,8 M16,24 L4,24 L4,8"/>
        <path d="
        M16,8
        Q22,6 24,10
        Q28,14 24,16
        Q20,18 24,20
        Q28,22 24,24
        L16,24
        "/>
        <line x1="16" y1="2" x2="16" y2="30" stroke-dasharray="2 2"/>
    </svg>
</button>
</div>

    <div class="filter-bar" id="filter-bar">
        <button id="clear-filters" class="clear-btn">Clear All</button>
    </div>

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
          document.getElementById('card-modal-shapes').textContent = bc.structures.length > 0 ? 'Structures: ' + bc.structures.join(', ') : '';

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
    { id: "RV-4706-120", origin: "Fiji", structures: ["square-concentric-structure", "square-cross-structure", "horizontal-line-structure"], link: "https://hdl.handle.net/20.500.11840/795173" },
    { id: "RV-265-1b", origin: "Futuna", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/598299" },
    { id: "RV-09-220", origin: "Tonga", structures: ["vertical-line-structure"], link: "https://hdl.handle.net/20.500.11840/838810" },
    { id: "RV-489-87", origin: "Tonga", structures: ["vertical-line-structure"], link: "https://hdl.handle.net/20.500.11840/660559" },
    { id: "RV-4241-1", origin: "Tonga", structures: ["grid-structure", "horizontal-line-structure"], link: "https://hdl.handle.net/20.500.11840/787757" },
    { id: "RV-4518-17", origin: "Tonga", structures: ["grid-structure", "vertical-line-structure"], link: "https://hdl.handle.net/20.500.11840/791809" },
    { id: "RV-4518-18", origin: "Tonga", structures: ["grid-structure", "vertical-line-structure"], link: "https://hdl.handle.net/20.500.11840/791810" },
    { id: "RV-4518-19", origin: "Tonga", structures: ["grid-structure", "vertical-line-structure"], link: "https://hdl.handle.net/20.500.11840/791811" },
    { id: "RV-4518-22", origin: "Tonga", structures: ["grid-structure", "vertical-line-structure"], link: "https://hdl.handle.net/20.500.11840/791814" },
    { id: "RV-4518-25", origin: "Tonga", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/791817" },
    { id: "RV-4518-26", origin: "Tonga", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/791818" },
    { id: "RV-4518-27", origin: "Tonga", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/791819" },
    { id: "RV-4518-30", origin: "Tonga", structures: ["horizontal-line-structure"], link: "https://hdl.handle.net/20.500.11840/791822" },
    { id: "RV-4518-32", origin: "Tonga", structures: ["square-concentric-structure"], link: "https://hdl.handle.net/20.500.11840/791824" },
    { id: "RV-265-7", origin: "Samoa", structures: ["grid-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/598304" },
    { id: "RV-489-83", origin: "Samoa", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/660555" },
    { id: "RV-489-84", origin: "Samoa", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/660556" },
    { id: "RV-489-85", origin: "Samoa", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/660557" },
    { id: "RV-489-88", origin: "Samoa", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/660560" },
    { id: "RV-552-5", origin: "Samoa", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/662722" },
    { id: "RV-828-122", origin: "Samoa", structures: ["grid-structure"], link: "https://hdl.handle.net/20.500.11840/673330" },
    { id: "RV-1141-133", origin: "Samoa", structures: ["square-concentric-structure", "square-cross-structure", "grid-structure"], link: "https://hdl.handle.net/20.500.11840/686065" },
    { id: "RV-912-4", origin: "East Polynesian (Polynesia / Hawaii)", structures: ["vertical-line-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/676213" },
    { id: "RV-3600-7499", origin: "West Papua (Nafri, Sentani)", structures: ["a-sym"], link: "https://hdl.handle.net/20.500.11840/777783" },
    { id: "RV-121-65", origin: "West Papua (Karon)", structures: ["grid-structure", "vertical-line-structure", "a-sym"], link: "https://hdl.handle.net/20.500.11840/595932" },
    { id: "RV-2972-2", origin: "West Papua (Karon)", structures: ["vertical-line-structure", "a-sym"], link: "https://hdl.handle.net/20.500.11840/757315" },
    { id: "RV-2953-2", origin: "West Papua (Wandamen, probably Karon)", structures: ["vertical-line-structure", "a-sym"], link: "https://hdl.handle.net/20.500.11840/754845" },
    { id: "RV-1759-31", origin: "Pebato", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/718435" },
    { id: "RV-03-277", origin: "Toraja", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/828350" },
    { id: "RV-03-2400", origin: "Toraja", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/849873" },
    { id: "RV-776-45", origin: "Toraja", structures: ["square-concentric-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/671205" },
    { id: "RV-776-45a", origin: "Toraja", structures: ["square-concentric-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/671206" },
    { id: "RV-1232-93", origin: "Toraja", structures: ["square-concentric-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/690654" },
    { id: "RV-1372-2", origin: "Toraja (Poso Toraja)", structures: ["square-cross-structure", "grid-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/701086" },
    { id: "RV-1232-87", origin: "Toraja", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/690648" },
    { id: "RV-1232-92", origin: "Toraja", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/690653" },
    { id: "RV-1759-27", origin: "Pebato", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/718431" },
    { id: "RV-1232-90", origin: "Toraja", structures: ["square-cross-structure", "grid-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/690651" },
    { id: "RV-1926-205", origin: "Toraja (Poso Toraja)", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/724867" },
    { id: "RV-1759-36", origin: "Toraja (Lage)", structures: ["square-concentric-structure", "square-cross-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/718440" },
    { id: "RV-1759-38", origin: "Toraja (Lage)", structures: ["square-concentric-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/718442" },
    { id: "RV-1926-211", origin: "Toraja (Poso Toraja)", structures: ["square-cross-structure", "grid-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/724873" },
    { id: "RV-03-276", origin: "Toraja", structures: ["grid-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/828349" },
    { id: "RV-03-2349", origin: "Toraja", structures: ["grid-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/849473" },
    { id: "RV-1232-94", origin: "Toraja", structures: ["grid-structure", "vertical-line-structure", "sym"], link: "https://hdl.handle.net/20.500.11840/690655" },
    { id: "RV-03-2391", origin: "Toraja (Poso Toraja)", structures: ["vertical-line-structure", "a-sym"], link: "https://hdl.handle.net/20.500.11840/849514" },
];

        let selectedStructures = [];

        // filter button clicks
        let buttons = document.querySelectorAll('.filter-btn');
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', function () {
                let structure = this.dataset.structure;
                this.classList.toggle('selected');

                if (selectedStructures.includes(structure)) {
                    // remove
                    let index = selectedStructures.indexOf(structure);
                    selectedStructures.splice(index, 1);
                } else {
                    // add
                    selectedStructures.push(structure);
                }

                renderBarkcloths();
            });
        }

            document.getElementById('clear-filters').addEventListener('click', function () {
            selectedStructures = [];
            let buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('selected'));
            document.getElementById('floating-layer').innerHTML = '';
            document.getElementById('grid-inner').innerHTML = '';
            document.getElementById('no-match').style.display = 'none';
        });

          function makeCardHTML(bc) {
            let structureList = bc.structures.length > 0 ? bc.structures.join(', ') : 'No structures';
            return '<img src="img/' + bc.id + '.png" alt="' + bc.id + '" onerror="this.style.display=\'none\'">' +
                   '<div class="card-id">' + bc.id + '</div>' +
                   '<div class="card-origin">' + bc.origin + '</div>' +
                   '<div class="card-shapes">' + structureList + '</div>';
        }

        function renderBarkcloths() {
            let floatingLayer = document.getElementById('floating-layer');
            let gridInner = document.getElementById('grid-inner');
            let noMatch = document.getElementById('no-match');

            floatingLayer.innerHTML = '';
            gridInner.innerHTML = '';
            noMatch.style.display = 'none';

            if (selectedStructures.length === 0) return;

            // find barkcloths w all selected structures
            let filtered = [];
            for (let i = 0; i < barkcloths.length; i++) {
                let bc = barkcloths[i];
                let hasAllStructures = true;
                for (let j = 0; j < selectedStructures.length; j++) {
                    if (!bc.structures.includes(selectedStructures[j])) {
                        hasAllStructures = false;
                        break;
                    }
                }
                if (hasAllStructures) {
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