"use strict";

const reverseText = () => {
  const text = textBox.value;

  //Separamos texto en caracteres.
  const splittedTextArr = text.split("");

  //Mapeamos, usando para cada caracter su índice inverso. -1, -2, -3 ...
  const result = splittedTextArr.map((el, idx, arr) => {
    return arr.at(-idx - 1);
  });

  textBoxResult.innerHTML = result.join("");
};
