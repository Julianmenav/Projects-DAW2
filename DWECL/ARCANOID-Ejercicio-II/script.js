"use strict";

var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
var ballRadius = 10;
var x = canvas.width / 2;
var y = canvas.height - 30;
var dx = 2;
var dy = -2;
var paddleHeight = 10;
var paddleWidth = 75;
var paddleX = (canvas.width - paddleWidth) / 2;
var rightPressed = false;
var leftPressed = false;
let paddleColor = "#240281"

document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);

function keyDownHandler(e) {
  // DETERMINAMOS QUE SE ESTÁ PULSANDO UNA TECLA (RECUERDA: e CONTIENE INFORMACIÓN SOBRE QUIÉN ORIGINA EL EVENTO)
  if (e.key == "ArrowRight") {
    // CURSOR DERECHO
    rightPressed = true;
  } else if (e.key == "ArrowLeft") {
    // CURSOR IZQUIERDO
    leftPressed = true;
  }
}

function keyUpHandler(e) {
  // DETERMINAMOS QUE SE HA DEJADO DE PULSAR UNA TECLA
  if (e.key == "ArrowRight") {
    rightPressed = false;
  } else if (e.key == "ArrowLeft") {
    leftPressed = false;
  }
}

function drawBall() {
  ctx.beginPath();
  ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
  ctx.fillStyle = "#0095DD";
  ctx.fill();
  ctx.closePath();
}

function drawPaddle() {
  ctx.beginPath();
  ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
  ctx.fillStyle = paddleColor;
  ctx.fill();
  ctx.closePath();
}

function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  drawPaddle();
  drawBall();

  // CHOCA CON EL LATERAL DERECHO          CHOCA CON EL LATERAL IZQUIERDO
  if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {
    // RECUERDA: EL CANVAS ESTÁ PEGANDO AL LATERAL IZQUIERDO
    dx = -dx; // CAMBIO LA DIRECCIÓN
  } // CHOCA CON EL TECHO
  if (y + dy < ballRadius) {
    // RECUERDA: EL CANVAS ESTÁ PEGANDO A LA PARTE SUPERIOR
    dy = -dy; // CAMBIO LA DIRECCIÓN
  } else if (y + dy > canvas.height - ballRadius - paddleHeight  + 10) {
    // CHOCA CON LA BASE
    if (x > paddleX - 10 && x < paddleX + paddleWidth + 10) {
      // HA CHOCADO CON LA PARTE DE LA BASE DÓNDE ESTÁ LA PALETA
      dy = -dy; // CAMBIO LA DIRECCIÓN
      //CAMBIO COLOR PALETA
      changePaddleColor();
      //AUMENTAR VELOCIDAD (IF CHECKED)
      if(nivel.checked){ levelUp()}
    } else {
      clearInterval(interval);
      location.reload();
      alert("GAME OVER"); // HA CHOCADO CON LA BASE
    }
  }

  x += dx; // ACTUALIZAMOS LA POSICIÓN DE LA PELOTA SIEMPRE
  y += dy;

  if (rightPressed && paddleX < canvas.width - paddleWidth) {
    paddleX += 7;
  } else if (leftPressed && paddleX > 0) {
    paddleX -= 7;
  }
}

function changePaddleColor() {
  let randomR = Math.floor(Math.random() * 255)
  let randomG = Math.floor(Math.random() * 255)
  let randomB = Math.floor(Math.random() * 255)

  paddleColor = "rgb("+ randomR + "," + randomG + "," + randomB+ ")"
}

function levelUp() {
  dx*=1.2;
  dy*=1.2;
  console.log("Subiendo velocidad...")
}

let interval;

startGame.onclick = () => {
  startGame.style.display = "none";
  interval = setInterval(draw, 10);
}
