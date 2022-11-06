"use strict";

const reset = () => {
  result.style.visibility = "hidden";
  userChoice.innerHTML = "";
  machineChoice.innerHTML = "";
};

const jugar = (event) => {
  reset();

  //Choices
  const choice = event.target.id;
  const cpuChoice = getCpuChoice();

  //output: -1, 0, 1
  const winner = getWinner(choice, cpuChoice);

  showChoices(choice, cpuChoice);
  setTimeout(() => showWinner(winner), 500);
};

//Button asignment.
piedra.onclick = jugar;
papel.onclick = jugar;
tijera.onclick = jugar;
