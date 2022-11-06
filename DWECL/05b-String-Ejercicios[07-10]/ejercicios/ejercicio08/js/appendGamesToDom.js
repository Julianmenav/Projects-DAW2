const appendGamesToDOM = (games) => {
  games.forEach((element) => {
    cardContent.appendChild(element);
  });
};