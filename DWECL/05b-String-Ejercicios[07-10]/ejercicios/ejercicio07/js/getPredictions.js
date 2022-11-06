const getPrediction = () => {
  const paragraph = document.createElement("p");
  paragraph.classList.add("prediction");
  ["1", "X", "2"].forEach((el) => {
    const span = document.createElement("span");
    span.innerText = el;
    paragraph.appendChild(span);
  });

  const random = Math.floor(Math.random() * 3);

  paragraph.children[random].style.color = "red"
  paragraph.children[random].style["font-weight"] = "bold"


  return paragraph
};