"use strict";

const countWords = () => {
  const text = textBox.value.toLowerCase();
  const searchWord = countWordInput.value.toLowerCase();

  //Eliminamos signos de puntuación.
  const cleanText = text.replace(/[,.:;]/g, "");

  //Dividimos por espacios
  const splittedText = cleanText.split(" ");

  //Buscamos palabra
  const filteredArray = splittedText.filter((word) => word === searchWord);
  const count = filteredArray.length;

  const result = `La palabra '${searchWord}' aparece ${count} veces`;
  countWordResult.innerHTML = result;
};
