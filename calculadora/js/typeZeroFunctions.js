
const pressMathNumber = (e) => {
  if ((lastInput === "operator" || lastInput === null || lastInput === "equal")) return;

  const input = e.target.innerText;
  result = input;

  if (lastInput === "equal") {
    memoryArray = [result];
  } else {
    memoryArray.push(result);
  }

  updateDisplay();
  updateLastInput(inputs.equal);
};

const pressRandom = () => {
  if (!(lastInput === "operator" || lastInput === null || lastInput === "equal"))return;

  const randomValue = (Math.random() * 100).toFixed(2);
  result = randomValue;

  if (lastInput === "equal") {
    memoryArray = [result];
  } else {
    memoryArray.push(result);
  }

  updateDisplay();
  updateLastInput(inputs.equal);
};