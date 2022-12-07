<?php
require_once("./lib/Database.php");
require_once("./models/Lector.php");
require_once("./models/Prestamo.php");
require_once("./models/Libro.php");

if(empty($_GET)){
  exit(header("location: index.php"));
}

if(isset($_GET["dni"])):
  $prestamos = Prestamo::getAllByIdUser($_GET["dni"]);
  //Si no tiene libros prestados, vuelta a la página principal.

  function devuelto($prestamo)
  {
    return ($prestamo->devolucion);
  };
  function noDevuelto($prestamo)
  {
    return !($prestamo->devolucion);
  };
  $noDevueltos = array_filter($prestamos, "noDevuelto");
  $devueltos = array_filter($prestamos, "devuelto");
endif;
if(isset($_GET["isbn"])):
  $prestamos = Prestamo::getAllByISBN($_GET["isbn"]);
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>

<body class="p-4">
<div class="flex gap-12 ">
    <a href="index.php" class="w-fit px-4 rounded-md shadow-md font-bold bg-lime-900 text-white">
      Lectores
    </a>
    <a href="index.php?libros" class="w-fit px-4 rounded-md shadow-md font-bold bg-lime-900 text-white">
      Libros
    </a>
  </div>
  <?php if(empty($prestamos)):?>
  <div class="m-auto mt-12 px-4 py-2 w-fit rounded-md bg-red-200 text-red-800"> No hay resultados</div>
  <?php else:?>
    <?php if(isset($_GET["dni"])):?>
    <div class="m-3 shadow-xl w-fit m-auto mt-12 rounded-md overflow-hidden">
      <p class="p-3 font-bold text-white text-xl bg-neutral-600 w-[800px]">Libros no devueltos</p>
      <table class="w-[800px] m-auto ">
        <tr class="border border-black">
          <td>ISBN</td>
          <td>Titulo libro</td>
          <td>Fecha Prestamo</td>
          <td>Fecha Devuelto</td>
        </tr>
        <?php
        foreach ($noDevueltos as $prestamo) :
        ?>
          <tr class="border border-black">
            <td class="p-3">
              <?= $prestamo->isbn ?>
            </td>
            <td class="p-3">
              <?= Libro::getLibroByISBN($prestamo->isbn) ?>
            </td>
            <td class="p-3">
              <?= $prestamo->prestamo ?>
            </td>
            <td class="p-3">
              <?= $prestamo->devolucion ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div class="m-3 shadow-xl w-fit m-auto mt-12 rounded-md overflow-hidden">
      <p class="p-3 font-bold text-white text-xl bg-neutral-600 w-[800px]">Libros devueltos</p>
      <table class="w-[800px] m-auto">
        <tr class="border border-black">
          <td>ISBN</td>
          <td>Titulo libro</td>
          <td>Fecha Prestamo</td>
          <td>Fecha Devuelto</td>
        </tr>
        <?php
        foreach ($devueltos as $prestamo) :
        ?>
          <tr class="border border-black">
            <td class="p-3">
              <?= $prestamo->isbn ?>
            </td>
            <td class="p-3">
              <?= Libro::getLibroByISBN($prestamo->isbn) ?>
            </td>
            <td class="p-3">
              <?= $prestamo->prestamo ?>
            </td>
            <td class="p-3">
              <?= $prestamo->devolucion ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php elseif (isset($_GET["isbn"])):?>
      <div class="m-3 shadow-xl w-fit m-auto mt-12 rounded-md overflow-hidden">
      <p class="p-3 font-bold text-white text-xl bg-neutral-600 w-[800px]">Prestamos realizados para:  <?=Libro::getLibroByISBN($_GET["isbn"]) ?></p>
      <table class="w-[800px] m-auto ">
        <tr class="border border-black">
          <td>ISBN</td>
          <td>Titulo libro</td>
          <td>Fecha Prestamo</td>
          <td>Fecha Devuelto</td>
        </tr>
        <?php
        foreach ($prestamos as $prestamo) :
        ?>
          <tr class="border border-black">
            <td class="p-3">
              <?= $prestamo->isbn ?>
            </td>
            <td class="p-3">
              <?= Libro::getLibroByISBN($prestamo->isbn) ?>
            </td>
            <td class="p-3">
              <?= $prestamo->prestamo ?>
            </td>
            <td class="p-3">
              <?= $prestamo->devolucion ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php endif;?>
  <?php endif;?>
</body>

</html>