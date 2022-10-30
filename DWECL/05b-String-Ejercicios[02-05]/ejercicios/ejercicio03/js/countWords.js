"use strict";

const countWords = () => {
  const text = textBox.value.toLowerCase().trim();

  //Eliminamos signos de puntuación.
  const cleanText = text.replace(/[\r\n,.:;-]/g, "");

  //VOCALES y CONSONANTES
  //Creamos un array con sólo las letras, sin espacios.
  const splitLetters = cleanText.replace(/\s+/, "").split("");

  const onlyVowels = splitLetters.filter((letter) => /[aeiou]/.test(letter));

  const onlyConsonants = splitLetters.filter((letter) =>
    /[^aeiou]/.test(letter)
  );

  //PALABRAS
  //Dividimos por espacios
  const words = cleanText.split(/\s+/);

  vowelsResult.innerHTML = onlyVowels.length;
  consonantsResult.innerHTML = onlyConsonants.length;
  wordsResult.innerHTML = words.length;
};
