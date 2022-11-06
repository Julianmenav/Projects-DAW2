const showChoices = (user, cpu) => {
  const userImg = document.createElement("img");
  const cpuImg = document.createElement("img");

  userImg.src = `../../img/${user}.svg`;
  cpuImg.src = `../../img/${cpu}.svg`;

  userImg.classList.add("resultImage");
  cpuImg.classList.add("resultImage");

  userChoice.appendChild(userImg);
  machineChoice.appendChild(cpuImg);
};
