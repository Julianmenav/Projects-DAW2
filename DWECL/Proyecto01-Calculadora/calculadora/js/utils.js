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