"use strict";

const isPalindrom = (text) => {
  if(text === "") return false

  const lowerCased = text.toLowerCase();

  //Eliminamos todo lo que no sean letras.
  const cleanText = lowerCased.replace(/[^A-Za-zÀ-ú]/g, "");

  //Quitámos signos de puntuación como tildes:
  const normalized = cleanText.normalize("NFD").replace(/[\u0300-\u036f]/g, "")


  //Comprobando cada caracter con el de su posición inversa: -1, -2, -3...
  //En caso de no coincidencia retornamos "false"
  for(let i = 0; i < normalized.length / 2; i++){
    if(normalized.at(i) !== normalized.at(-i - 1)){
      return false
    }
  }

  return true;
};

const checkIfTextIsPalindrom = () => {
  const text = textBox.value;
  const result = isPalindrom(text) ? "es palíndromo" : "no es palíndromo";
  
  palindromResult.style.color = isPalindrom(text) ? "#5AFA27" : "red";
  palindromResult.innerHTML = `El texto ${result}`;
};
