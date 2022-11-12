
const changeMode = () => {
  if(toggleBtn.checked){
    //Quitar hidden de todos los botones.
    document.querySelectorAll('.scientific').forEach((button) => {
      button.classList.remove("hidden");
    })
    //Cambiar width de md a 2xl
    // calculatorContainer.classList.remove('max-w-md')
    calculatorContainer.classList.add('max-w-2xl')
    //pasar de 4 a 6 cols.
    // buttonsGrid.classList.remove('grid-cols-4');
    buttonsGrid.classList.add('grid-cols-6');
    //Cambiar nombre modo.
    modeText.innerText = "CIENTIFICA"
    scientificMode = true;
  } else {
    document.querySelectorAll('.scientific').forEach((button) => {
      button.classList.add("hidden");
    })
    
    calculatorContainer.classList.remove('max-w-2xl')
    buttonsGrid.classList.remove('grid-cols-6');
    
    modeText.innerText = "BASICA"
    scientificMode = false;
  }



}
