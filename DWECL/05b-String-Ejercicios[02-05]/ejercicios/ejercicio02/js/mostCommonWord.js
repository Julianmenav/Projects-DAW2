const showMostCommonWord = (text) => {
  const lowercased = text.toLowerCase().trim();

  //Eliminamos signos de puntuación.
  const cleanText = lowercased.replace(/[\r\n,.:;-]/g, "");

  //PALABRAS
  //Dividimos por espacios
  const words = cleanText.split(/\s+/).filter(word => word !== "");

  //Creamos un objeto en el que aparezca el número de veces que aparece cada palabra.
  const ranking = words.reduce((agg, el) => {
    if (agg.hasOwnProperty(el)) {
      agg[el]++;
      return { ...agg };
    }
    return { ...agg, [el]: 1 };
  }, {});

  //Ordenamos teniendo en cuenta el segundo término de cada array (Su número de apariciones)
  const sortRanking = Object.entries(ranking).sort((a, b) =>  b[1] - a[1])
  console.log(sortRanking[0])

  const mostCommonPhrase = `La palabra más usada es '${sortRanking[0][0]}'. Numero de apariciones: ${sortRanking[0][1]}`

  mostCommonWord.innerHTML = mostCommonPhrase;
};
