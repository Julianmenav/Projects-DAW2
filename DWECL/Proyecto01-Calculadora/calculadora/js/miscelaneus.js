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