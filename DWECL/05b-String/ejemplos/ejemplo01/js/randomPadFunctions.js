let speedMS = 1000;
let running = false;
let interval;
const btns = document.querySelectorAll(".rand");

// Utils
const highlightButton = (btn) => {
  btn.style.backgroundColor = "#242424";
  btn.style.color = "#fff";
  const timelapse = 150
  setTimeout(() => {
    btn.style.backgroundColor = "#fff";
    btn.style.color = "#000";
  }, timelapse);
};

const triggerRandomButton = () => {
  const randomBtn = btns[Math.floor(Math.random() * btns.length)];
  randomBtn.dispatchEvent(new Event("click"));
  highlightButton(randomBtn);
};

//Functions to Export
const doRandomStuff = () => {
  if (!textBox.value) return;
  if (running) return;
  interval = setInterval(triggerRandomButton, speedMS);
  running = true;
  currentSpeed.innerHTML = 1;
};

const stop = () => {
  clearInterval(interval);
  speedMS = 1000;
  running = false;
  currentSpeed.innerHTML = 0;
};

const faster = () => {
  if (!running) return;
  if (speedMS <= 20) return;
  clearInterval(interval);
  speedMS *= 0.5;
  interval = setInterval(triggerRandomButton, speedMS);
  currentSpeed.innerHTML *= 2;
};

const slower = () => {
  if (!running) return;
  if (speedMS >= 16000) return;
  clearInterval(interval);
  speedMS *= 2;
  interval = setInterval(triggerRandomButton, speedMS);
  currentSpeed.innerHTML *= 0.5;
};

const clearInputs = () => {
  stop();
  textBox.value = "";
};