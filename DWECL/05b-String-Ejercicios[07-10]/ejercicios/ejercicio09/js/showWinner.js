const showWinner = (winner) => {
  console.log(winner);
  if (winner == 0) {
    result.innerText = "Empate";
    result.style["background-color"] = "gray";
  } else if (winner > 0) {
    result.innerText = "Has Ganado";
    result.style["background-color"] = "green";
  } else {
    result.innerText = "Has Perdido";
    result.style["background-color"] = "red";
  }

  result.style.visibility = "visible";
};
