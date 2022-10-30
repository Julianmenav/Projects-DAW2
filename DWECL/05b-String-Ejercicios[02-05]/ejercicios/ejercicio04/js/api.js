"use strict";

const generateRandomText = async () => {
  const response = await fetch(
    `https://gist.githubusercontent.com/camperbot/5a022b72e96c4c9585c32bf6a75f62d9/raw/e3c6895ce42069f0ee7e991229064f167fe8ccdc/quotes.json`
    );
  const json = await response.json();
  const quotes = json["quotes"];
    
  const random = Math.floor(Math.floor(Math.random() * quotes.length));
  const {quote, author} = quotes[random];

  const text = `${quote} \n\n - ${author}`;
  textBox.value = text;
  textBoxResult.innerHTML = "";
};
