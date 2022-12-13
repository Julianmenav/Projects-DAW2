<?php
session_start();
require_once("./models/Usuario.php");
require_once("./lib/Database.php");
require_once("./models/Lista.php");
require_once("./lib/Token.php");

if (!isset($_SESSION["user"])) :
  exit(header("location: index.php"));
endif;

$idUsu = unserialize($_SESSION["user"])->idUsu;

//VIEW
if (isset($_GET["task"])) {
  $task = Lista::getTaskById($_GET["task"]);

  if($idUsu != $task->idUsu){
    exit(header("location: index.php"));
  }
}
//CREDIT
if (isset($_POST["description"])) :
  if (!Token::check($_POST["_token"])) exit(header("location: index.php"));
    $db = Database::getDataBase();
    $datos = $db->escape($_POST);

    if (isset($_POST["id"])) :
      //EDIT
      $task = Lista::getTaskById($_POST["id"]);
      $task->description = $datos["description"];
      $task->update();
    else :
      //CREATE
      $task = new Lista;
      $task->idUsu = $idUsu;
      $task->description = $datos["description"];
      $task->state = $datos["state"] ? 1 : 0;
      $task->create();
    endif;
    exit(header("location: main.php"));
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
<body class="bg-[#444444]">
  <!-- EDITAR -->
  <?php if (isset($_GET["task"])) : ?>
    <form method="post" action="credit.php" class="flex flex-col w-[500px] m-auto border border-black shadow-xl mt-12 py-1 px-6 bg-white">
      <input type="hidden" name="_token" value="<?= new Token ?>">
      <input type="hidden" name="id" value=" <?= $task->id; ?> ">
      <label for="description">Descripcion</label>
      <input value="<?= $task->description ?>" name="description" id="description" type="text" class="text-lg px-2 py-1 rounded-md bg-black/[0.05] font-bold shadow-xl m-3">
      <button type="submit" class="rounded-md border border-black bg-teal-600 font-bold text-white w-fit px-2 py-1">Editar</button>
    </form>
    <!-- CREAR -->
  <?php else : ?>
    <form method="post" action="credit.php" class="flex flex-col w-[500px] m-auto border border-black shadow-3xl mt-12 py-1 px-6 bg-white rounded-md">
      <input type="hidden" name="_token" value="<?= new Token ?>">
      <label for="description" class="font-bold text-xl">Escribe una descripcion</label>
      <input name="description" id="description" type="text" required class="text-lg px-2 py-1 rounded-md bg-black/[0.05] font-bold shadow-xl m-3">
      <div class="flex justify-between mt-2">
        <button type="submit" class="rounded-md border border-black bg-teal-600 font-bold text-white w-fit px-2 py-1">Guardar</button>
        <select name="state" class="w-fit border border-black h-fit">
          <option value="0">Sin completar</option>
          <option value="1">Completada</option>
        </select>
      </div>
    </form>
  <?php endif; ?>
</body>
</html>