<?php
/**
 * Autor: Julián Mena Viñas 12/12/22 
 * 
 */
session_start();
require_once("./models/Etiqueta.php");
require_once("./libs/Database.php");
require_once("./libs/CSRF.php");

if (isset($_POST["_token"])) {
  if (!Csrf::check($_POST["_token"])) exit(header("location: create.php"));

  $data = Database::getDataBase()->escape($_POST);

  $newTag = new Etiqueta();
  $newTag->nombre = $data["nombre"];
  $newTag->color = $data["color"];
  $newTag->create();

  exit(header("location: index.php"));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Crear Etiqueta</title>
</head>

<body class="bg-neutral-200">
  <p class="text-5xl font-bold ml-6 pb-2">MetDoList</p>
  <p class="text-xl ml-6 pb-2">Crear Nueva Etiqueta</p>

  <form action="create.php" method="post" class="bg-white flex items-end gap-2 p-3 border border-black w-fit shadow-lg rounded-lg ml-6">
    <input type="hidden" name="_token" value="<?= new Csrf() ?>">
    <input type="color" name="color" value="#00d5ff">
    <div class="inline-flex flex-col">
      <label for="nombre" class="text-sm">Nombre de la etiqueta</label>
      <input id="nombre" type="text" name="nombre" class="px-4 py-0.5 rounded-md border border-black">
    </div>
    <button type="submit" class="px-2 py-1 rounded-md bg-black text-white font-bold  w-fit h-fit">Guardar</button>
    <a href="index.php" class="px-2 py-1 rounded-md bg-red-200 text-red-600 font-bold w-fit h-fit">Volver</a>
  </form>


</body>

</html>