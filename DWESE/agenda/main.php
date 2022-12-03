<?php
session_start();

//Para que funcione la deserializacion.
require_once "./model/usuario.php";
require_once "./model/contacto.php";


if(!isset($_SESSION["user"])){
  exit(header("location: login.php"));
}

if (isset($_GET["logout"])) {
  $_SESSION = [];
  session_destroy();

  //Redigirimos al login otra vez
  exit(header("location: login.php"));
}
if (isset($_GET["borrar"])) {
  $idContact = $_GET["borrar"] ?? "";

  $contact = Contacto::getById($idContact);

  if ($contact) $contact->delete();

  header("location: main.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Logeado</title>
</head>

<body class="bg-neutral-800">
  <!-- Mensaje de bienvenida y logout -->
  <div class="p-3 ml-12 m-6 bg-gray-200 text-gray-500 w-fit rounded-xl shadow-md">
    Bienvenido <?= unserialize($_SESSION["user"])->nombre ?>
    <div>
      <a href="main.php?logout" class="text-red-500">Desconectar</a>
    </div>
  </div>
  <!-- Mensaje para cuando agregamos un contacto satisfactoriamente -->
  <?php if(isset($_GET["success"])):?>
  <div class="bg-lime-700 text-lime-200 absolute top-5 left-1/2 -translate-x-1/2 rounded-xl px-4 py-2">
    El contacto se ha guardado satisfactoriamente
  </div>
  <?php endif; ?>
  <div id="content" class="text-white px-24">
      <div class="overflow-x-auto relative shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                Nombre
              </th>
              <th scope="col" class="py-3 px-6">
                Telefono
              </th>
              <th scope="col" class="py-3 px-6">
                Observaciones
              </th>
              <th scope="col" class="py-3 px-6">
                Action
              </th>
              <th scope="col" class="py-3 px-6">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $idUsu = unserialize($_SESSION["user"])->id;
            $contactos = Contacto::getAllByUser($idUsu);
            // echo "<pre>".print_r($contactos, true)."</pre>";
            foreach ($contactos as $item) :
            ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                  <img class="w-10 h-10 rounded-full" src="<?= $item->foto ?>" alt="ProfilePic">
                  <div class="pl-3">
                    <div class="text-base font-semibold"><?= $item ?></div>
                    <div class="font-normal text-gray-500"><?= $item->email ?></div>
                  </div>
                </th>
                <td class="py-4 px-6">
                  <?= $item->telefono ?>
                </td>
                <td class="py-4 px-6">
                  <div class="flex items-center">
                    <?= $item->observaciones ?>
                  </div>
                </td>
                <td class="py-4 px-6">
                  <a href="editarContacto.php?id=<?= $item->id ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                </td>
                <td class="py-4 px-6">
                  <a href="main.php?borrar=<?= $item->id ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete user</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- Boton nuevo contacto -->
      <a href="./guardarContacto.php">
        <div class="w-fit bg-lime-300 text-lime-800 rounded-xl m-auto p-4 font-bold mt-4">
          Crear nuevo contacto
        </div>
      </a>
  </div>
</body>

</html>