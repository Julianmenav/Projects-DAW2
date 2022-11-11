//Functions wich take 2 operand to work.
//Numbers, Operators, Percentage

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


// + , - , / , * , ^ , mod
const pressOperator = (e) => {
  let newOperator = e.target.innerText;
  console.log(newOperator);
  newOperator = newOperator.replace("a^b", "^" ).replace("mod", "%");

  switch (lastInput) {
    case null:
      newOperator === "-" ? nextIsNegative() : errorStyleEffect();
      break;
    case "number":
      // Para el modo Cientifico
      // memory.push(operator);
      if (scientificMode){
        result = operateScientific(memoryArray)
        memoryArray.push(newOperator);
      } else {
        result = operateInOrder(memoryArray)
        memoryArray = [result, newOperator];
      }

      updateLastInput(inputs.operator);
      break;
    case "operator":
      if (newOperator === "-" && memoryArray.at(-1) !== "-") {
        nextIsNegative();
      } else if(newOperator !== "^"){
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

const pressPercentage = () => {
  const operand = memoryArray.at(-1);
  const lastOperator = memoryArray.at(-2);
  const lastOperand = memoryArray.at(-3);
  if (!(lastInput === "number" && ["+", "-", "×"].includes(lastOperator))) return;
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
  output = parseFloat(output.toFixed(6));
  if(scientificMode){
    memoryArray.splice(-3,3,output);
    result = operateScientific(memoryArray);
    updateDisplay();
  } else {
    memoryArray.push("%");
    result = output;
    updateDisplay();
    memoryArray = [output];
  }
  
  updateLastInput(inputs.equal);
};