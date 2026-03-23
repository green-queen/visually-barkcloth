<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <title>Visually Barkcloth</title>
</head>


<body>
  <nav class="nav">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="quiz.php">Quiz</a></li>
      <li><a href="annotations.php">Annotations</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>

    <main class="page">
        <div class="choice-icon">
            <svg viewBox="0 0 56 56" fill="none" stroke="var(--black)" stroke-width="1.5">
                <rect x="8" y="8" width="40" height="40" />
                <rect x="16" y="16" width="24" height="24" stroke-dasharray="2,2" />
                <rect x="24" y="24" width="8" height="8" />
                <line x1="28" y1="8" x2="28" y2="48" />
                <line x1="8" y1="28" x2="48" y2="28" />
            </svg>
        </div>

        <div class="filter-bar" id="filter-bar">
            <button class="filter-btn" data-structure="square-structure">Square Structure</button>
            <button class="filter-btn" data-structure="square-cross-structure">Square Cross Structure</button>
            <button class="filter-btn" data-structure="square-concentric-circle-structure">Square Concentric Circle
                Structure</button>
            <button class="filter-btn" data-structure="rectangle-structure">Rectangle Structure</button>
            <button class="filter-btn" data-structure="rhombus-structure">Rhombus Structure</button>
            <button class="filter-btn" data-structure="equilateral-structure">Equilateral Structure</button>
            <button class="filter-btn" data-structure="circle-structure">Circle Structure</button>
            <button class="filter-btn" data-structure="diag-sym">Diagonal Symmetry</button>
            <button class="filter-btn" data-structure="gen-sym">General Symmetry</button>
            <button class="filter-btn" data-structure="matrix-sym">Matrix Symmetry</button>
            <button class="filter-btn" data-structure="two-dir-sym">Two Direction Symmetry</button>
            <button class="filter-btn" data-structure="four-dir-sym">Four Direction Symmetry</button>
            <button class="filter-btn" data-structure="concentric-circle-sym">Concentric Circle Symmetry</button>
        </div>

        <section class="barkcloth-list" id="barkcloth-list">
        </section>
    </main>

    <div id="floating-layer"></div>
    <div id="no-match">No barkcloths match the selected filters.</div>

    <script>
        const barkcloths = [
            { id: "RV-4706-120", origin: "Fiji", structures: ["square-structure", "square-cross-structure", "equilateral-structure", "circle-structure"], link: "https://hdl.handle.net/20.500.11840/795173" },
            { id: "RV-265-1b", origin: "Futuna", structures: ["rectangle-structure", "two-dir-sym", "four-dir-sym", "concentric-circle-sym"], link: "https://hdl.handle.net/20.500.11840/598299" },
            { id: "RV-09-220", origin: "Tonga", structures: ["rectangle-structure", "rhombus-structure", "diag-sym"], link: "https://hdl.handle.net/20.500.11840/838810" },
            { id: "RV-489-87", origin: "Tonga", structures: ["diag-sym"], link: "https://hdl.handle.net/20.500.11840/660559" },
            { id: "RV-4241-1", origin: "Tonga", structures: ["rhombus-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/787757" },
            { id: "RV-4518-17", origin: "Tonga", structures: ["square-concentric-circle-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/791809" },
            { id: "RV-4518-18", origin: "Tonga", structures: ["rectangle-structure", "rhombus-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/791810" },
            { id: "RV-4518-19", origin: "Tonga", structures: ["gen-sym"], link: "https://hdl.handle.net/20.500.11840/791811" },
            { id: "RV-4518-22", origin: "Tonga", structures: ["square-structure", "rectangle-structure", "rhombus-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/791814" },
            { id: "RV-4518-25", origin: "Tonga", structures: ["square-structure", "gen-sym", "matrix-sym"], link: "https://hdl.handle.net/20.500.11840/791817" },
            { id: "RV-4518-26", origin: "Tonga", structures: ["square-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/791818" },
            { id: "RV-4518-27", origin: "Tonga", structures: ["square-structure", "square-cross-structure", "square-concentric-circle-structure", "rhombus-structure", "equilateral-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/791819" },
            { id: "RV-4518-30", origin: "Tonga", structures: ["rectangle-structure", "diag-sym"], link: "https://hdl.handle.net/20.500.11840/791822" },
            { id: "RV-4518-32", origin: "Tonga", structures: ["square-structure", "square-cross-structure", "square-concentric-circle-structure", "diag-sym", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/791824" },
            { id: "RV-265-7", origin: "Samoa", structures: ["square-structure", "square-cross-structure", "gen-sym", "concentric-circle-sym"], link: "https://hdl.handle.net/20.500.11840/598304" },
            { id: "RV-489-83", origin: "Samoa", structures: ["rectangle-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/660555" },
            { id: "RV-489-84", origin: "Samoa", structures: ["rectangle-structure", "rhombus-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/660556" },
            { id: "RV-489-85", origin: "Samoa", structures: ["square-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/660557" },
            { id: "RV-489-88", origin: "Samoa", structures: ["square-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/660560" },
            { id: "RV-552-5", origin: "Samoa", structures: ["square-cross-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/662722" },
            { id: "RV-828-122", origin: "Samoa", structures: ["square-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/673330" },
            { id: "RV-1141-133", origin: "Samoa", structures: ["square-cross-structure", "square-concentric-circle-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/686065" },
            { id: "RV-912-4", origin: "East Polynesian (Polynesia / Hawaii)", structures: ["rectangle-structure", "matrix-sym"], link: "" },
            { id: "RV-3600-7499", origin: "West Papua (Nafri, Sentani)", structures: [], link: "https://hdl.handle.net/20.500.11840/777783" },
            { id: "RV-121-65", origin: "West Papua (Karon)", structures: ["rectangle-structure", "diag-sym", "matrix-sym"], link: "https://hdl.handle.net/20.500.11840/595932" },
            { id: "RV-2972-2", origin: "West Papua (Karon)", structures: ["square-structure", "square-cross-structure", "rectangle-structure", "rhombus-structure"], link: "https://hdl.handle.net/20.500.11840/757315" },
            { id: "RV-2953-2", origin: "West Papua (Wandamen, probably Karon)", structures: ["square-structure", "square-cross-structure", "rectangle-structure", "rhombus-structure"], link: "https://hdl.handle.net/20.500.11840/754845" },
            { id: "RV-1759-31", origin: "Pebato", structures: ["square-cross-structure", "square-concentric-circle-structure", "circle-structure"], link: "https://hdl.handle.net/20.500.11840/718435" },
            { id: "RV-03-277", origin: "Toraja", structures: ["square-structure", "square-cross-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/828350" },
            { id: "RV-03-2400", origin: "Toraja", structures: ["square-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/849873" },
            { id: "RV-776-45", origin: "Toraja", structures: ["square-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/671205" },
            { id: "RV-776-45a", origin: "Toraja", structures: ["square-structure", "rectangle-structure", "circle-structure", "matrix-sym", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/671206" },
            { id: "RV-1232-93", origin: "Toraja", structures: ["square-structure", "rectangle-structure", "circle-structure", "matrix-sym", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/690654" },
            { id: "RV-1372-2", origin: "Toraja (Poso Toraja)", structures: ["square-structure", "square-cross-structure", "circle-structure"], link: "https://hdl.handle.net/20.500.11840/701086" },
            { id: "RV-1232-87", origin: "Toraja", structures: ["square-structure", "square-cross-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/690648" },
            { id: "RV-1232-92", origin: "Toraja", structures: ["square-structure", "square-cross-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/690653" },
            { id: "RV-1759-27", origin: "Pebato", structures: ["square-cross-structure", "rectangle-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/718431" },
            { id: "RV-1232-90", origin: "Toraja", structures: ["square-structure", "square-cross-structure", "square-concentric-circle-structure", "square-concentric-circle-structure", "circle-structure"], link: "https://hdl.handle.net/20.500.11840/690651" },
            { id: "RV-1926-205", origin: "Toraja (Poso Toraja)", structures: ["square-structure", "square-cross-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/724867" },
            { id: "RV-1759-36", origin: "Toraja (Lage)", structures: ["square-structure", "square-cross-structure", "circle-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/718440" },
            { id: "RV-1759-38", origin: "Toraja (Lage)", structures: ["square-structure", "square-cross-structure", "four-dir-sym"], link: "https://hdl.handle.net/20.500.11840/718442" },
            { id: "RV-1926-211", origin: "Toraja (Poso Toraja)", structures: ["square-structure", "square-cross-structure", "rectangle-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/724873" },
            { id: "RV-03-276", origin: "Toraja", structures: ["equilateral-structure", "two-dir-sym"], link: "https://hdl.handle.net/20.500.11840/828349" },
            { id: "RV-03-2349", origin: "Toraja", structures: ["square-structure", "equilateral-structure", "two-dir-sym"], link: "https://hdl.handle.net/20.500.11840/849473" },
            { id: "RV-1232-94", origin: "Toraja", structures: ["rectangle-structure", "gen-sym"], link: "https://hdl.handle.net/20.500.11840/690655" },
            { id: "RV-03-2391", origin: "Toraja (Poso Toraja)", structures: ["square-structure", "square-cross-structure", "rectangle-structure", "rhombus-structure"], link: "https://hdl.handle.net/20.500.11840/849514" },
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

        function renderBarkcloths() {
            let floatingLayer = document.getElementById('floating-layer');
            let noMatch = document.getElementById('no-match');

            floatingLayer.innerHTML = '';
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

                let card = document.createElement('div');
                card.className = 'floating-card';
                card.style.setProperty('--rotate', rotate + 'deg');

                let structureList = bc.structures.length > 0 ? bc.structures.join(', ') : 'No structures';
                card.innerHTML =
                    '<img src="img/' + bc.id + '.png" alt="' + bc.id + '" onerror="this.style.display=\'none\'">' +
                    '<div class="card-id">' + bc.id + '</div>' +
                    '<div class="card-origin">' + bc.origin + '</div>' +
                    '<div class="card-shapes">' + structureList + '</div>';

                yWrap.appendChild(card);
                xWrap.appendChild(yWrap);
                floatingLayer.appendChild(xWrap);
            }
        }

        renderBarkcloths();
    </script>
</body>

</html>