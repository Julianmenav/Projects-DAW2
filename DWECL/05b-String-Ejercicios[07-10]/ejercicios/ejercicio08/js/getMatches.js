const getMatches = (weekNumber) => {
  const games = partidos[weekNumber];

  const gameElements = games.map((obj) => {
    const homeBadge = document.createElement("img");
    homeBadge.src = escudos[obj.casa];

    const visitBadge = document.createElement("img");
    visitBadge.src = escudos[obj.visitante];

    const paragraph = document.createElement("p");
    paragraph.appendChild(homeBadge);
    paragraph.appendChild(
      document.createTextNode(`${obj.casa} vs ${obj.visitante}`)
    );
    paragraph.appendChild(visitBadge);
    paragraph.classList.add("teams");

    const result = document.createElement("p");
    result.innerText = `${obj.resultado}`;
    result.classList.add("results");

    const predictionElement = getPrediction();

    const div = document.createElement("div");
    div.appendChild(result);
    div.appendChild(paragraph);
    div.appendChild(predictionElement);

    return div;
  });

  return gameElements;
};