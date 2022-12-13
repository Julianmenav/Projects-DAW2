<?php
/**
 * Autor: Julián Mena Viñas 12/12/22 
 * 
 */
require_once("./libs/Database.php");
require_once("./models/Tarea.php");
require_once("./models/Etiqueta.php");

if (isset($_GET["changeState"])) {
  $task = Tarea::getTaskById($_GET["changeState"]);
  $task->changeState();
  exit(header("location: index.php"));
}

if (isset($_GET["delete"])) {
  $task = Tarea::getTaskById($_GET["delete"]);
  $task->delete();
  exit(header("location: index.php"));
}

if (isset($_GET["filter"])) {
  $sql = "SELECT tarea.idTar, tarea.titulo, tarea.texto, tarea.inicio, tarea.fin 
          FROM tarea, tiene, etiqueta 
          WHERE tarea.idTar = tiene.idTar 
          AND tiene.idEtq = etiqueta.idEtq AND etiqueta.nombre = '{$_GET["filter"]}';";
} else {
  $sql = "SELECT * FROM tarea ;";
}

$tasks = Database::getDataBase()->query($sql)->getAll("Tarea");
$allTags = Etiqueta::getAllTags();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Todas las Tareas</title>
</head>

<body class="pl-2 pr-2 bg-neutral-200">
  <div class="mb-3">
    <p class="text-5xl font-bold ml-6 pb-2">MetDoList</p>
    <p class="text-xl ml-6 pb-2">Listado de Tareas</p>
  </div>
  <div>
    <a href="create.php" class="font-bold py-1 px-2 bg-black text-white rounded-md shadow-md ml-6">Nueva etiqueta</a>
    <a href="#" class="font-bold py-1 px-2 bg-black text-white rounded-md shadow-md ml-6">Nueva tarea</a>
  </div>
  <div id="container" class="flex justify-center gap-2">
    <div id="tareas" class="max-w-[900px] min-w-[750px]">
      <?php foreach ($tasks as $task) : ?>
        <div class="task border border-black rounded-md shadow-md mt-3 p-2 bg-white">
          <div class="taskHeader flex justify-between">
            <div class="flex flex-col">
              <p class="font-bold text-xl mb-3">
                <?= $task->titulo ?>
              </p>
              <p class="border border-black rounded-md w-fit px-2 py-0.5 bg-white font-bold">
                <?= $task->inicio ?>
              </p>
            </div>
            <div class="<?= $task->isCompleted() ? "bg-green-200" : "bg-red-200" ?> rounded-md py-1 px-2 h-fit">
              <a href="index.php?changeState=<?= $task->idTar ?>">
                <?= $task->isCompleted() ? "Completada" : "Pendiente" ?>
              </a>
            </div>
          </div>
          <div class="taskBody">
            <?= $task->texto ?>
          </div>
          <div class="taskFooter flex justify-between mt-4 mb-2">
            <div class="tags flex min-h-[40px] items-center">
              <?php $tags = $task->getTags();
              foreach ($tags as $tag) :
              ?>
                <div class="tag m-1">
                  <?= $tag ?>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="flex items-center gap-1">
              <?php if (!$task->isCompleted()) : ?>
                <a class="px-2 py-1 rounded-md bg-red-200 text-red-600" href="./index.php?delete=<?= $task->idTar ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                  </svg>
                </a>
                <a class="px-2 py-1 rounded-md bg-green-200 text-green-600" href="#">Editar</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div id="tagsCloud" class="flex flex-wrap grow content-start max-w-[350px] gap-1">
      <div class="tag m-1 h-fit w-fit">
        <a href="index.php" class='bg-black text-white rounded-md px-3 py-1.5 text-center w-fit font-bold'>Todas</a>
      </div>
      <?php foreach ($allTags as $tag) : ?>
        <div class="tag m-1 h-fit w-fit">
          <?= $tag ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>