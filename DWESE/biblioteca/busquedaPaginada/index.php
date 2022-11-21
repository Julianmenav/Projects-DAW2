<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <title>Biblioteca</title>
</head>
<?php
require_once("../modelos/libro.php");
require_once("database.php");

//Calculando número de libros por página y número de páginas necesarias.
define("REGISTROS", 4);
$pag = $_GET["pagina"] ?? 0;
$inicio = $pag * REGISTROS;
$cantidad = REGISTROS;

$resultado1 = $con->query("SELECT * FROM libro;");
$numBooks = $resultado1->num_rows;
$totalPages = floor($numBooks / REGISTROS);

//Seleccionando libros de la página actual.
$sql = "SELECT * FROM libro LIMIT {$inicio}, {$cantidad} ;";
$resultado = $con->query($sql);
?>

<body class="bg-neutral-100">
  <div class="text-3xl font-bold text-center text-black mt-4 ">BIBLIOTECA</div>
  <div class="w-1/2 m-auto mt-6 flex flex-row gap-1">
    <input id="inputSearch" type="text" class="w-full shadow-md px-4 py-2 bg-[#242424] text-white rounded-md">
    <button id="searchBtn" class="py-1 px-4 border border-black rounded-md bg-neutral-50 font-bold hover:bg-neutral-200 active:translate-y-0.5 shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </button>
  </div>
  <div id="content" class="flex flex-wrap gap-6 justify-center mt-6">

  </div>
  <div class="flex">
    <button id="searchMore" class="hidden m-auto mb-2 py-1 px-4 border border-black rounded-md bg-neutral-50 font-bold hover:bg-neutral-200 active:translate-y-0.5">Buscar 2 más...</button>
  </div>
</body>
<script>
  const initialAmount = 2
  let amountOfResults = initialAmount;

  const searchAndPrint = (amount = 2) => {
    let searchValue = $("#inputSearch").val();

    if (searchValue.length >= 4) {
      //PETICIONES AJAX DE JQUERY
      $.ajax({
          url: "./buscar.php",
          method: "GET",
          data: {
            search: searchValue,
            amount: amount
          }
        })
        .done((data) => {
          $("#content").html(data);
          $("#searchMore").removeClass("hidden")
        })
    }
  }

  // Acciones del DOM
  $("#searchBtn").click((e) => {
    searchAndPrint();
    amountOfResults = initialAmount;
  })

  $("#inputSearch").bind("keyup", (e) => {
    searchAndPrint();
    amountOfResults = initialAmount;
  })

  $("#searchMore").click(() => {
    amountOfResults += 2;
    searchAndPrint(amountOfResults);
  })
</script>

</html>