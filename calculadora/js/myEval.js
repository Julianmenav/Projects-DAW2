//Forma de calcular arrays siguiendo su orden en el array.
const operateInOrder = (arr) => {
  //Transformamos números de string a Number.
  const numbersArr = arr.map((el) => parseFloat(el) || el);

  //Recorre el array y va operando.
  const result = numbersArr.reduce((agg, el, i) => {
      //El primer elemento siempre será un numero el cual guardamos.
      if (i === 0) return { ...agg, value: el };

      //Si es numero operamos.
      if (typeof el === "number") {
        switch (agg.operand) {
          case "+":
            return { ...agg, value: agg.value + el };
          case "-":
            return { ...agg, value: agg.value - el };
          case "×":
            return { ...agg, value: agg.value * el };
          case "÷":
            return { ...agg, value: agg.value / el };
          default:
            return { ...agg };
        }
      }

      //Si no era número nos quedamos el operando.
      return { ...agg, operand: el };
    },
    { value: 0, operand: null }
  );

  return parseFloat((result.value.toFixed(6)));
};

const operateScientific = (arr) => {
  const stringArr = arr.map(el => el.toString());
  const parsedString = stringArr
    .join("")
    .replace(/×/g, "*")
    .replace(/÷/g, "/")
    .replace(/\^/g, "**")
    .replace(/--/g, "+")
    .replace(/π/, Math.PI)
    .replace(/e/g, Math.E);

  return parseFloat((eval(parsedString).toFixed(6)));
};
