<?php
session_start();
require_once("./models/Usuario.php");
require_once("./lib/database.php");
require_once("./models/Lista.php");

if (!isset($_SESSION["user"])) :
  exit(header("location: index.php"));
endif;

if (isset($_GET["logout"])) {
  $_SESSION = [];
  session_destroy();
  exit(header("location: index.php"));
}

$idUsu = unserialize($_SESSION["user"])->idUsu;
if (isset($_GET["borrar"])) {
  $task = Lista::getTaskById($_GET["borrar"]);
  if ($task->idUsu == $idUsu) {
    $task->delete();
  }

  exit(header("location: main.php"));
}
if (isset($_GET["changeState"])) {
  $task = Lista::getTaskById($_GET["changeState"]);
  $task->changeState();

  exit(header("location: main.php"));
}
$db = Database::getDataBase();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#242424]">
  <div class=" text-white p-3 m-12  w-fit font-bold">
    Hola <?= unserialize($_SESSION['user']) ?> !
    <a class="text-red-400 block" href="main.php?logout">
      Salir
    </a>
  </div>
  <table class="w-[500px] shadow-xl rounded-md overflow-hidden m-auto">
    <p class="text-center text-white mb-4 text-lg font-bold">Estas son tus tareas:</p>
    <tr class="bg-[#3ff]/[0.7] text-white text-lg font-bold">
      <th>Descripción</th>
      <th class="w-[200px]"></th>
      <th>Completada</th>
      <th></th>
    </tr>
    <?php foreach (Lista::getAllByIdUser($idUsu) as $i => $task) : ?>
      <tr class="py-12 text-center bg-white<?= $i % 2 == 0 ? "" : "/[0.8]" ?> mt-2">
        <td><?= $task->description ?></td>
        <td>
          <a class="text-blue-600 " href="credit.php?task=<?= $task->id ?>">
            Editar
          </a>
        </td>
        <td>
          <a href="main.php?changeState=<?= $task->id ?>">
            <?= $task->state ? "🟢" : "🔴" ?>
          </a>
        </td>
        <td>
          <a href="main.php?borrar=<?= $task->id ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6 m-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <div>
    <a href="credit.php" class="p-3 border border-black rounded-md m-auto block w-fit mt-12 bg-[#3ff]/[0.6] text-white font-bold hover:bg-[#3ff]/[0.2] ">
      Añadir nueva tarea
    </a>
  </div>
</body>

</html>