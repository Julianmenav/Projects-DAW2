const getPrediction = () => {
  const paragraph = document.createElement("p");
  paragraph.classList.add("prediction");
  ["1", "X", "2"].forEach((el) => {
    const span = document.createElement("span");
    span.innerText = el;
    paragraph.appendChild(span);
  });


  const inputWeight = pesos.value;
  let weights = [0,1,2]

  switch(inputWeight){
    case "0":
      weights = [0];
      break;
    case "25":
      weights = [0,0,1,2];
      break;
    case "50": 
      weights = [0,1,2];
      break;
    case "75":
      weights = [0,1,2,2];
      break;
    case "100": 
      weights = [2];
      break;
  }

  //Can be 0, 1 or 2.
  const randomPrediction = weights[Math.floor(Math.random() * weights.length)]

  paragraph.children[randomPrediction].style.color = "red"
  paragraph.children[randomPrediction].style["font-weight"] = "bold"
  


  return paragraph
};