const getCpuChoice = () => {
  const choices = ["papel", "piedra", "tijera", "lagarto", "spock"];
  const random = choices[Math.floor(Math.random() * choices.length)];

  return random;
};