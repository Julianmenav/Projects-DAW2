"use strict";

const printMatches = () => {
  cleanBoard();
  const weekNumber = Math.floor(Math.random() * 38) + 1;
  diaJornada.innerText = weekNumber;

  let games = getMatches(weekNumber);
  appendGamesToDOM(games);
};

const showResultsFn = () => {
  document.querySelectorAll(".results").forEach((el) => {
    el.style.visibility = "visible";
  });
};

//Button asignment.
randomText.onclick = printMatches;
showResults.onclick = showResultsFn;
