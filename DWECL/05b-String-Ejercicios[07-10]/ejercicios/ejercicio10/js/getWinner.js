
const getWinner = (user, cpu) => {
  //Empate
  if (user === cpu) return 0

  //Posibles derrotas
  if (user == "piedra"){
    if (cpu == "papel") return -1 
    if (cpu == "spock") return -1 
  }

  if(user == "papel"){
    if (cpu == "tijera") return -1
    if (cpu == "lagarto") return -1
  }

  if(user == "tijera"){
    if (cpu == "piedra") return -1 
    if (cpu == "spock") return -1 
  }

  if(user == "spock"){
    if (cpu == "lagarto") return -1
    if (cpu == "papel") return -1
  }

  if(user == "lagarto"){
    if (cpu == "tijera") return -1
    if (cpu == "piedra") return -1
  }

  //Victoria
  return 1
}
