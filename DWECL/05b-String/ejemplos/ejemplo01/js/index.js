"use strict";


// Imports ES6 - ES6 modules solo funcionan si el programa es ejecutado usando un servidor como Live Server de vscode o Nodejs
// De momento lo dejamos como scripts importados desde el index.html

//FETCH async/await
const generateRandomText = async () => {
  const random = Math.floor(Math.random() * 100);
  const response = await fetch(
    `https://pokeapi.co/api/v2/ability/${random}/`
  );
  const json = await response.json();
  textBox.value = json["effect_entries"][1]["effect"];
};

//Button asignment.
randomText.onclick = generateRandomText;

upper.onclick = changeAllToUpper;
lower.onclick = changeAllToLower;
firstUpper.onclick = changeFirstLetterToUpper;
firstLower.onclick = changeFirstLetterToLower;
lastUpper.onclick = changeLastLetterToUpper;
lastLower.onclick = changeLastLetterToLower;
vowelsUpper.onclick = changeVowelsToUpper;
vowelsLower.onclick = changeVowelsToLower;
consonantsUpper.onclick = changeConsonantsToUpper;
consonantsLower.onclick = changeConsonantsToLower;

pickRandomBtn.onclick = doRandomStuff;
stopBtn.onclick = stop;
fastBtn.onclick = faster;
slowBtn.onclick = slower;
clear.onclick = clearInputs;