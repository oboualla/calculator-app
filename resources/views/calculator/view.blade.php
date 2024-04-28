<html>
    <head>
        <title>Calculator</title>
        <style>
            #container {
                width : 100%;
                height : auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            #calculator-container {
                width : 400px;
                background-color : #856565;
                display : flex;
                flex-direction : column;
                align-items : center
            }

            #calculator-output-screen {
                width : 300px;
                height : 35px;
                background-color : #c7afaf;
                color : black;
                margin: 10px;
                border-color : black;
                border-width : 3px;
                border-style: dashed;
                font-size: x-large;
                overflow : hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }

            #calculator-operators {
                width : 90%;
                display : flex;
                flex-direction : column;
                align-items : center;
                margin-bottom : 10px;
            }

            .operators-row {
                width : 300px;
                display : flex;
                flex-direction : row;
            }

            .btn-number {
                width : 75px;
                height : 50px;
            }

        </style>
    </head>
    <body>
        <div id="container">
            <div>
                <h2>{{ $title }}<h2>
            </div>
            <div id="calculator-container">
                <div id="calculator-output-screen">
                    <p id="calculator-screen" style="margin : 3px;" data-value="">0</p>
                </div>
                <div id="calculator-operators">
                    <div class="operators-row" style="flex-direction : row-reverse;">
                        <button class="btn-number" data-value='ce'> CE </button>
                    </div>

                    <div class="operators-row">
                        <button class="btn-number" data-value="7"> 7 </button>
                        <button class="btn-number" data-value="8"> 8 </button>
                        <button class="btn-number" data-value="9"> 9 </button>
                        <button class="btn-number" data-value="/"> ÷ </button>
                    </div>

                    <div class="operators-row">
                        <button class="btn-number" data-value="4"> 4 </button>
                        <button class="btn-number" data-value="5"> 5 </button>
                        <button class="btn-number" data-value="6"> 6 </button>
                        <button class="btn-number" data-value="*"> × </button>
                    </div>

                    <div class="operators-row">
                        <button class="btn-number" data-value="1"> 1 </button>
                        <button class="btn-number" data-value="2"> 2 </button>
                        <button class="btn-number" data-value="3"> 3 </button>
                        <button class="btn-number" data-value="-"> - </button>
                    </div>

                    <div class="operators-row">
                        <button class="btn-number" data-value="0"> 0 </button>
                        <button class="btn-number" data-value="."> . </button>
                        <button class="btn-number" data-value="="> = </button>
                        <button class="btn-number" data-value="+"> + </button>
                    </div>

                </div>
            </div>
        </div>
        <script>
            // add listner on click for each button
            const btns = document.getElementsByTagName('button');
            const calcScreen = document.getElementById('calculator-screen');

            for (const element of btns) {
                if (['+', '-', '*', '/', 'ce', '='].includes(element.dataset.value)) {
                    // is operator
                    element.addEventListener('click', calcOperatorsListner);
                } else {
                    // is digit
                    element.addEventListener('click', calcDigitsListner);
                }
            }

            function calcDigitsListner(e) {
                onDigitClicked(e.target.dataset.value);
            }

            function calcOperatorsListner(e) {
                onOppClicked(e.target.dataset.value);
            }

            function onDigitClicked(digit) {
                // let oldValue = calcScreen.innerHTML.trim();
                let oldValue = calcScreen.dataset.value.trim();

                if (/\+$|\-$|\*$|\/$/.test(oldValue)) {
                    // add space after a operator
                    oldValue += ' ';
                }
                // protect multi "." symbole click (multi decimal fraction)
                if (digit === '.') {
                    const lastNbr = oldValue.match(/[\d]+[\.]*[\d]*$/,);
                    if (lastNbr == undefined || /\./.test(lastNbr)) {
                        // last number already has a decimal part
                        return ;
                    }
                }
                calcScreen.dataset.value = `${oldValue}${digit}`;
                calcScreen.innerHTML =
                calcScreen.dataset.value.length > 20 ?
                `... ${calcScreen.dataset.value.slice(calcScreen.dataset.value.length - 20)}` :
                calcScreen.dataset.value;
            }

            function onOppClicked(op) {
                // const oldValue = calcScreen.innerHTML.trim();
                const oldValue = calcScreen.dataset.value.trim();
                if (oldValue === '') return ;
                // empty screen
                if (op === 'ce') {
                    calcScreen.innerHTML = '0';
                    calcScreen.dataset.value = ''
                    return ;
                }
                // calc result
                if (op === '=') {
                    calcScreen.innerHTML = eval(oldValue);
                    calcScreen.dataset.value = calcScreen.innerHTML;
                    return ;
                }
                // protect repeated operators like "1 * 10 ++"
                if (/\+$|\-$|\*$|\/$/.test(oldValue)) {
                    return ;
                }
                calcScreen.dataset.value = `${oldValue} ${op}`;
                calcScreen.innerHTML =
                calcScreen.dataset.value.length > 20 ?
                `... ${calcScreen.dataset.value.slice(calcScreen.dataset.value.length - 20)}` :
                calcScreen.dataset.value;
            }

        </script>
    </body>
</html>
