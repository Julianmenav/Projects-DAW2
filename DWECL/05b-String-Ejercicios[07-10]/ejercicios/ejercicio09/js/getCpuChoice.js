const getCpuChoice = () => {
  const choices = ["papel", "piedra", "tijera"];
  const random = choices[Math.floor(Math.random() * choices.length)];

  return random;
};