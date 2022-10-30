"use strict";

const generateRandomText = async () => {
  const options = {
    method: 'GET',
    headers: {
      'X-RapidAPI-Key': 'd4ffb0106bmshda86634df28d61fp1f6543jsn8ff0cafea6ec',
      'X-RapidAPI-Host': 'hargrimm-wikihow-v1.p.rapidapi.com'
    }
  };
  
  const response = await fetch('https://hargrimm-wikihow-v1.p.rapidapi.com/steps?count=3', options).catch(e => console.error(e))
  const json = await response.json()

  let text = ""
  for (const key in json){
    text += `- ${json[key]} \n`
  }

  
  textBox.value = text;
  showMostCommonWord(text);
};
