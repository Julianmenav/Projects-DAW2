//Functions wich take 1 operand to work.
const pressInverse = () => {
  //Solo se puede usar si hay un número.
  if (!(lastInput === "number" || lastInput === "equal")) return;

  result = 1 / parseFloat(result);
  memoryArray.splice(-1, 1, result);

  updateDisplay();
  updateLastInput(inputs.equal);
};

const pressSqroot = () => {
  if (!(lastInput === "number" || lastInput === "equal")) return;

  result = parseFloat(result) ** 0.5;
  memoryArray.splice(-1, 1, result);

  updateDisplay();
  updateLastInput(inputs.equal);
};

const pressSign = () => {
  if (!(lastInput === "number" || lastInput === "equal")) return;

  result = parseFloat(result) * -1;
  memoryArray.splice(-1, 1, result);

  updateDisplay();
  updateLastInput(inputs.equal);
};

const pressLog = (e) => {
  if (!(lastInput === "number" || lastInput === "equal")) return;

  const operand = operateScientific([memoryArray.at(-1)]);
  const input = e.target.innerText;
  if (input === "log") {
    result = Math.log10(operand);
    memoryArray.splice(-1, 1, result);
  }
  if (input === "ln") {
    result = Math.log(operand);
    memoryArray.splice(-1, 1, result);
  }
  updateDisplay();
  updateLastInput(inputs.equal);
};



const pressPower = () => {
  if (!(lastInput === "number" || lastInput === "equal")) return;

  const operand = memoryArray.at(-1);

  memoryArray.splice(-1, 1, `2^${operand}`);
  result = 2 ** operand;

  updateDisplay();
  updateLastInput(inputs.equal);
};

const pressTrigonometric = (e) => {
  if (!(lastInput === "number" || lastInput === "equal")) return;
  const input = e.target.innerText;
  switch (input) {
    case "cos":
      result = Math.cos(result);
      memoryArray.splice(-1, 1, result);
      break;
    case "sen":
      result = Math.sin(result);
      memoryArray.splice(-1, 1, result);
      break;
    case "tan":
      result = Math.tan(result);
      memoryArray.splice(-1, 1, result);
      break;
  }
  updateDisplay();
  updateLastInput(inputs.equal);
};


//1 = 1
//2 = 1 * 2
//3 = 1 * 2 * 3
//4 = 1 * 2 * 3 * 4
//!4 = 4 * !3
const getFactorial = (n) => n <= 1 ? 1 : n * getFactorial(n-1);

const pressFactorial = () => {
  if (!(lastInput === "number" || lastInput === "equal")) return;

  result = getFactorial(result);
  memoryArray[memoryArray.length - 1] += "!";
  
  updateDisplay();
  memoryArray.splice(-1, 1, result);
  updateLastInput(inputs.equal);
};


