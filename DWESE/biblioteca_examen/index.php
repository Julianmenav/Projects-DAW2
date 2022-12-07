<?php
require_once("./lib/Database.php");
require_once("./models/Lector.php");
require_once("./models/Prestamo.php");
require_once("./models/Libro.php");


$db = Database::getDataBase();
$db->query("SELECT * FROM lector")

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
  <div class="flex gap-12">
    <a href="index.php" class="<?= isset($_GET["libros"]) ? "bg-lime-500 text-white" : "bg-lime-900 text-white"  ?> w-fit px-4 rounded-md shadow-md font-bold">
      Lectores
    </a>
    <a href="index.php?libros" class="<?= isset($_GET["libros"]) ? "bg-lime-900 text-white" : "bg-lime-500 text-white"  ?> w-fit px-4 rounded-md shadow-md font-bold">
      Libros
    </a>
  </div>
  <p class="text-2xl">Biblioteca CPIFP Málaga Tech</p>
  <p class="text-md">Listado de <?= isset($_GET["libros"]) ? "LIBROS" : "LECTORES" ?></p>
  <?php
  if (isset($_GET["libros"])) :
  ?>
    <!-- TABLA LIBROS -->
    <table class="w-[1200px]">
      <tr class="bg-neutral-500 p-3 text-white text-lg text-center">
        <td>
          ISBN
        </td>
        <td>
          Titulo
        </td>
        <td>
          Autor
        </td>
        <td>
          Fecha prestamo
        </td>
        <td></td>
        <td></td>
      </tr>
      <?php
      $libros = Libro::getAllLibros();
      foreach ($libros as $libro) :
      ?>
        <tr class="border border-black">
          <td>
            <a href="prestamos.php?isbn=<?= $libro->isbn ?>" class="text-blue-600">
              <?= $libro->isbn ?>
            </a>
          </td>
          <td>
            <?= $libro ?>
          </td>
          <td>
            <?= $libro->autor ?>
          </td>
          <td>
            <?= $libro->getLastPrestamo()->prestamo ?? ""; ?>
          </td>
          <td>
            <?php if (!$libro->getLastPrestamo()) : ?>
              <a href="prestar.php?isbn=<?= $libro->isbn ?>" class="text-blue-600">
                Prestar
              </a>
            <?php else : ?>
              Prestar
            <?php endif; ?>
          </td>
          <td>
            <?php if ($libro->getLastPrestamo()) : ?>
              <a href="devolver.php?isbn=<?= $libro->isbn ?>" class="text-blue-600">
                Devolver
              </a>
            <?php else : ?>
              Devolver
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php
  else :
  ?>
    <!-- TABLA LECTORES -->
    <table class="w-[700px]">
      <?php
      $lectores = $db->getAll("lector");
      foreach ($lectores as $lector) :
      ?>
        <tr class="border border-black text-center">
          <td>
            <?= $lector->dni ?>
          </td>
          <td>
            <?= $lector ?>
          </td>
          <td>
            <a href="prestamos.php?dni=<?= $lector->dni ?>" class="text-blue-600">
              préstamos
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php
  endif;
  ?>
</body>

</html>