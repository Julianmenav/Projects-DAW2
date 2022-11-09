const inputs = {
  number: "number",
  operator: "operator",
  negative: "negative",
  decimal: "decimal",
  equal: "equal",
};

let lastInput = null;
let memory = [];
let result = "";

const errorStyleEffect = () => {
  const backUp = display.style;
  display.style.border = "2px solid tomato";
  setTimeout(() => {
    display.style = backUp;
  }, 500);
};

const nextIsNegative = () => {
  memory.push("-");
  updateLastInput(inputs.negative);
};
const updateLastInput = (input) => {
  lastInput = input;
};
const updateDisplay = () => {
  const memoryString = memory.join(" ");
  if (result === 0) {
    result = "";
  }
  memoryOutput.innerText = memoryString || "0";
  displayOutput.innerText = result || "0";
};

const resolve = () => {
  result = myEval(memory);
  return result;
};

const pressNumber = (e) => {
  const number = e.target.innerText;

  switch (lastInput) {
    case null:
      memory.push(number);
      result = number;
      break;
    case "number":
      memory[memory.length - 1] = memory[memory.length - 1] + number;
      result += number;
      break;
    case "operator":
      memory.push(number);
      result = number;
      break;
    case "negative":
      const negativeNumber = number * -1;
      memory.splice(-1, 1, negativeNumber);
      result = negativeNumber;
      break;
    case "decimal":
      //Result será algo como "2."
      memory[memory.length - 1] = memory[memory.length - 1] + number;
      result = result + number;
      break;
    case "equal":
      memory = [number];
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
      memory = [result, newOperator];

      updateLastInput(inputs.operator);
      break;
    case "operator":
      if (newOperator === "-" && memory.at(-1) !== "-") {
        nextIsNegative();
      } else {
        memory.splice(-1, 1, newOperator);
      }
      break;
    case "equal":
      memory.push(newOperator);
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
  console.log(memory);
  const result = resolve();

  updateLastInput(inputs.equal);
  updateDisplay();

  memory = [result];
};

const pressBack = () => {
  if (lastInput === inputs.number) {
    result = result.slice(0, -1);
    memory.splice(-1, 1);
  }
  updateDisplay();
};

const pressClearEntry = () => {
  result = "";
  if (lastInput === "number") memory.pop();

  //En caso de que ya se estuviese operando se deja como "lastInput".
  if (memory.length > 1) {
    updateLastInput(inputs.operator);
  } else {
    updateLastInput(null);
  }

  updateDisplay();
};

const pressClear = () => {
  result = "";
  memory = [];
  updateLastInput(null);
  updateDisplay();
};

const pressInverse = () => {
  //Solo se puede usar si hay un número.
  if (lastInput !== "number") return;

  result = 1 / parseFloat(result);
  memory.splice(-1, 1, result);

  updateDisplay();
};

const pressSquared = () => {
  if (lastInput !== "number") return;

  result = parseFloat(result) ** 2;
  memory.splice(-1, 1, result);

  updateDisplay();
};

const pressSqroot = () => {
  if (lastInput !== "number") return;

  result = parseFloat(result) ** 0.5;
  memory.splice(-1, 1, result);

  updateDisplay();
};

const pressSign = () => {
  if (lastInput !== "number") return;

  result = parseFloat(result) * -1;
  memory.splice(-1, 1, result);

  updateDisplay();
};

const pressPercentage = () => {
  const operand = memory.at(-1);
  const lastOperator = memory.at(-2);
  const lastOperand = memory.at(-3);
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
  memory.push("%");
  result = output;

  updateDisplay();
  memory = [output];
};

const pressDecimal = () => {
  //Solo se activa si el número que manejamos no es decimal aún,
  if (lastInput === "decimal") return;
  if (memory.at(-1) % 1 !== 0) return;
  if (lastInput !== "number" && lastInput !== null) return;

  //Tanto el resultado como el último digito de la memoria son string ahora.
  memory[memory.length - 1] = memory[memory.length - 1] + ".";
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
squared.onclick = pressSquared;
sqroot.onclick = pressSqroot;
sign.onclick = pressSign;
dot.onclick = pressDecimal;
