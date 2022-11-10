//Functions wich take 1 operand to work.
const pressInverse = () => {
  //Solo se puede usar si hay un número.
  if (lastInput !== "number") return;

  result = 1 / parseFloat(result);
  memoryArray.splice(-1, 1, result);

  updateDisplay();
};

const pressSqroot = () => {
  if (!(lastInput === "number" || lastInput === "equal")) return;

  result = parseFloat(result) ** 0.5;
  memoryArray.splice(-1, 1, result);

  updateDisplay();
};

const pressSign = () => {
  if (lastInput !== "number") return;

  result = parseFloat(result) * -1;
  memoryArray.splice(-1, 1, result);

  updateDisplay();
};