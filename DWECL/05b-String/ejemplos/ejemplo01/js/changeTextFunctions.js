//String Modify Functions
const changeAllToUpper = () => {
  const text = textBox.value;
  textBox.value = text.toUpperCase();
};

const changeAllToLower = () => {
  const text = textBox.value;
  textBox.value = text.toLowerCase();
};

const changeFirstLetterToUpper = () => {
  const text = textBox.value;
  const textArr = text.trim().split("");
  const capitalized = textArr.map((char, idx, arr) => {
    const previousChar = arr[idx - 1] ;
    if (/[A-zÀ-ú]/.test(previousChar) && typeof previousChar !== "undefined") return char;
    return char.toUpperCase();
  });
  textBox.value = capitalized.join("");
};

const changeFirstLetterToLower = () => {
  const text = textBox.value;
  const textArr = text.trim().split("");
  const capitalized = textArr.map((char, idx, arr) => {
    const previousChar = arr[idx - 1] ;
    if (/[A-zÀ-ú]/.test(previousChar) && typeof previousChar !== "undefined") return char;
    return char.toLowerCase();
  });
  textBox.value = capitalized.join("");
};

const changeLastLetterToUpper = () => {
  const text = textBox.value;
  const textArr = text.trim().split("");
  const capitalized = textArr.map((char, idx, arr) => {
    const nextChar = arr[idx + 1] ;
    if (/[A-zÀ-ú]/.test(nextChar) && typeof nextChar !== "undefined") return char;
    return char.toUpperCase();
  });
  textBox.value = capitalized.join("");
};

const changeLastLetterToLower = () => {
  const text = textBox.value;
  const textArr = text.trim().split("");
  const capitalized = textArr.map((char, idx, arr) => {
    const nextChar = arr[idx + 1] ;
    if (/[A-zÀ-ú]/.test(nextChar) && typeof nextChar !== "undefined") return char;
    return char.toLowerCase();
  });
  textBox.value = capitalized.join("");
};

const changeVowelsToUpper = () => {
  const text = textBox.value;
  const textArr = text.split("");
  const vowelsCapitalized = textArr.map((char) =>
    /[aeiou]/.test(char) ? char.toUpperCase() : char
  );
  textBox.value = vowelsCapitalized.join("");
};

const changeVowelsToLower = () => {
  const text = textBox.value;
  const textArr = text.split("");
  const vowelsCapitalized = textArr.map((char) =>
    /[AEIOU]/.test(char) ? char.toLowerCase() : char
  );
  textBox.value = vowelsCapitalized.join("");
};

const changeConsonantsToUpper = () => {
  const text = textBox.value;
  const textArr = text.split("");
  const vowelsCapitalized = textArr.map((char) =>
    /[^AEIOUaeiou]/.test(char) ? char.toUpperCase() : char
  );
  textBox.value = vowelsCapitalized.join("");
};

const changeConsonantsToLower = () => {
  const text = textBox.value;
  const textArr = text.split("");
  const vowelsCapitalized = textArr.map((char) =>
    /[^AEIOUaeiou]/.test(char) ? char.toLowerCase() : char
  );
  textBox.value = vowelsCapitalized.join("");
};
