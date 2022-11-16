<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Biblioteca</title>
</head>
<?php
require_once("./modelos/libro.php");
require_once("database.php");

$sql = "SELECT * FROM libro ;";
$resultado = $con->query($sql);
if ($resultado->num_rows < 1) :
?>
  <div class="text-red-700 bg-red-200 w-fit px-2 py-4 rounded-md m-auto mt-12">No se encontraron resultados</div>
<?php else : ?>

  <body class="bg-neutral-200">
    <div class="flex flex-wrap gap-6 justify-center mt-6">
      <?php while ($libro = $resultado->fetch_object("Libro")) : ?>
        <div class="bg-white max-w-xl shadow-md bg-white text-neutral-800 mb-12 rounded-lg ">
          <div class="flex flex-row">
            <img class="w-32 max-h-42 p-1 rounded-xl brightness-90" src="<?= $libro->imagen  ?>">
            <div>
              <header>
                <p id="title" class="text-xl p-2 font-bold text-teal-600">
                  <?= $libro->titulo  ?>
                </p>
                <p class="text-sm ml-2 -mt-3 text-blue-400">
                  <?= $libro->autor  ?>
                </p>
              </header>
              <section class="p-3">
                <p class="flex">Puntuación: <?= $libro->estrellas()  ?></p>
                <p>Editorial: <?= $libro->editorial  ?></p>
                <p>Paginas: <?= $libro->paginas  ?></p>
                <p>ISBN: <?= $libro->isbn  ?></p>
              </section>
            </div>
          </div>
          <div class="p-4">
            <p class="text-lg font-bold text-zinc-800">Argumento:</p>
            <p class="text-justify truncate"><?= $libro->argumento  ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </body>

</html>
<?php endif; ?>