const inputs = {
  number: "number",
  operator: "operator",
  negative: "negative",
  decimal: "decimal",
  equal: "equal",
};

let lastInput = null;
let memoryArray = [];
let memoryValue = "";
let result = "";

const errorStyleEffect = () => {
  const backUp = display.style;
  display.style.border = "2px solid tomato";
  setTimeout(() => {
    display.style = backUp;
  }, 500);
};

const nextIsNegative = () => {
  memoryArray.push("-");
  updateLastInput(inputs.negative);
};
const updateLastInput = (input) => {
  lastInput = input;
};
const updateDisplay = () => {
  const memoryString = memoryArray.join(" ");
  if (result === 0) {
    result = "";
  }
  memoryOutput.innerText = memoryString || "0";
  displayOutput.innerText = result || "0";
};

const resolve = () => {
  result = operateInOrder(memoryArray);
  return result;
};

const pressNumber = (e) => {
  const number = e.target.innerText;

  switch (lastInput) {
    case null:
      memoryArray.push(number);
      result = number;
      break;
    case "number":
      memoryArray[memoryArray.length - 1] = memoryArray[memoryArray.length - 1] + number;
      result += number;
      break;
    case "operator":
      memoryArray.push(number);
      result = number;
      break;
    case "negative":
      const negativeNumber = number * -1;
      memoryArray.splice(-1, 1, negativeNumber);
      result = negativeNumber;
      break;
    case "decimal":
      //Result será algo como "2."
      memoryArray[memoryArray.length - 1] = memoryArray[memoryArray.length - 1] + number;
      result = result + number;
      break;
    case "equal":
      memoryArray = [number];
      result = number;
      break;
    default:
      return errorStyleEffect();
  }
  updateLastInput(inputs.number);
  updateDisplay();
};

const pressOperator = (e) => {
  const newOperator = e.target.innerText;

  switch (lastInput) {
    case null:
      newOperator === "-" ? nextIsNegative() : errorStyleEffect();
      break;
    case "number":
      result = resolve();
      // Para el modo Cientifico
      // memory.push(operator);
      //Modo Normal (Faltaria guardar en alguna memoria solo visual (opcional))
      memoryArray = [result, newOperator];

      updateLastInput(inputs.operator);
      break;
    case "operator":
      if (newOperator === "-" && memoryArray.at(-1) !== "-") {
        nextIsNegative();
      } else {
        memoryArray.splice(-1, 1, newOperator);
      }
      break;
    case "equal":
      memoryArray.push(newOperator);
      updateLastInput(inputs.operator);
      break;
    default:
      //Ahora solo se pueden poner números
      errorStyleEffect();
      break;
  }

  updateDisplay();
};

const pressEqual = () => {
  const result = resolve();

  updateLastInput(inputs.equal);
  updateDisplay();

  memoryArray = [result];
};

const pressBack = () => {
  if (lastInput === inputs.number) {
    result = result.slice(0, -1);
    memoryArray.splice(-1, 1);
  }
  updateDisplay();
};

const pressClearEntry = () => {
  result = "";
  if (lastInput === "number" || lastInput === "equal") memoryArray.pop();

  //En caso de que ya se estuviese operando se deja como "lastInput".
  if (memoryArray.length > 1) {
    updateLastInput(inputs.operator);
  } else {
    updateLastInput(null);
  }

  updateDisplay();
};

const pressClear = () => {
  result = "";
  memoryArray = [];
  memoryValue = "";
  memoryButton.style.backgroundColor = "#c6e09b"
  updateLastInput(null);
  updateDisplay();
};

const pressInverse = () => {
  //Solo se puede usar si hay un número.
  if (lastInput !== "number") return;

  result = 1 / parseFloat(result);
  memoryArray.splice(-1, 1, result);

  updateDisplay();
};

const pressMemory = () => {
  //Store value
  if(memoryValue === "" && lastInput === "equal"){
    memoryArray = [];
    memoryValue = result;
    memoryButton.style.backgroundColor = "white"
  }
  //Use value
  if (lastInput === "operator") {
    memoryArray.push(memoryValue);
    result = memoryValue;
    updateLastInput(inputs.number);
  }

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

const pressPercentage = () => {
  const operand = memoryArray.at(-1);
  const lastOperator = memoryArray.at(-2);
  const lastOperand = memoryArray.at(-3);
  if (!(lastInput === "number" && ["+", "-", "×"].includes(lastOperator)))
    return;
  let output;
  switch (lastOperator) {
    case "+":
      output = lastOperand * (1 + operand / 100);
      break;
    case "-":
      output = lastOperand * (1 - operand / 100);
      break;
    case "×":
      output = lastOperand * (operand / 100);
      break;
  }
  memoryArray.push("%");
  result = output;

  updateDisplay();
  memoryArray = [output];
};

const pressDecimal = () => {
  //Solo se activa si el número que manejamos no es decimal aún,
  if (lastInput === "decimal") return;
  if (memoryArray.at(-1) % 1 !== 0) return;
  if (lastInput !== "number" && lastInput !== null) return;

  //Tanto el resultado como el último digito de la memoria son string ahora.
  memoryArray[memoryArray.length - 1] = memoryArray[memoryArray.length - 1] + ".";
  result += ".";

  updateLastInput(inputs.decimal);
  updateDisplay();
};

zero.onclick = pressNumber;
one.onclick = pressNumber;
two.onclick = pressNumber;
three.onclick = pressNumber;
four.onclick = pressNumber;
five.onclick = pressNumber;
six.onclick = pressNumber;
seven.onclick = pressNumber;
eight.onclick = pressNumber;
nine.onclick = pressNumber;

divide.onclick = pressOperator;
multiply.onclick = pressOperator;
substract.onclick = pressOperator;
plus.onclick = pressOperator;

equal.onclick = pressEqual;

percentage.onclick = pressPercentage;
clearEntry.onclick = pressClearEntry;
clear.onclick = pressClear;
back.onclick = pressBack;
inverse.onclick = pressInverse;
memoryButton.onclick = pressMemory;
sqroot.onclick = pressSqroot;
sign.onclick = pressSign;
dot.onclick = pressDecimal;
