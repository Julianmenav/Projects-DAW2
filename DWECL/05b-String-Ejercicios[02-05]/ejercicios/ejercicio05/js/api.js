"use strict";



/**
 * Para esta ocasión no usaremos una api Web
 * He colocado un objeto con frases
 * Algunas son palíndromos y otras no.
 * 
 */

const generateRandomText = async () => {

  const phrases = [
    "¿Son robos o sobornos?",
    "A mamá, Roma le aviva el amor a papá, y a papá, Roma le aviva el amor a mamá.",
    "A ti no, bonita.",
    "Adán y raza; azar y nada.",
    "Este texto no es palíndromo",
    "El palíndromo más cutre : ertuc sam omordnilap le",
    "Javascript es un gran lenguaje",
    "Ama ama y ensancha el alma"
  ]


  const text = phrases[Math.floor(Math.random() * phrases.length)]  
  
  textBox.value = text;
}
