<?php
require_once "../modelos/libro.php";
require_once "./database.php";

$search = $_GET["search"];
$amount = $_GET["amount"];

$sql = "SELECT * FROM libro WHERE titulo LIKE '%{$search}%' LIMIT 0, {$amount} ;";

$resultado = $con->query($sql);

while (($libro = $resultado->fetch_object("Libro"))) : ?>
    <div class="bg-white max-w-xl shadow-md bg-white text-neutral-800 mb-2 rounded-lg ">
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
