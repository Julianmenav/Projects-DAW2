<?php
session_start();
require_once "./model/usuario.php";
require_once "./lib/database.php";
require_once "./model/contacto.php";
require_once "./model/token.php";

//Recoger de $_POST todos los inputs.
if (isset($_POST["name"])) : //if(!empty($_POST)):

  //Validar token
  if (Token::check($_POST["_token"])) :

    $db = Database::getDatabase();
    // Antes usaba el escape antes de pasarle los datos a contacto.
    // Ahora escape está dentro del propio setter de Contacto.  
    // $escape_strings = $db->escape($_POST);

    $contacto = new Contacto;
    $contacto->nombre = $_POST["name"];
    $contacto->apellido = $_POST["surname"];
    $contacto->telefono = $_POST["tlf"];
    $contacto->email = $_POST["email"];
    $contacto->foto = $_POST["photo"];
    $contacto->observaciones = $_POST["obs"];

    //Recuperamos de la sesión el id del usuario que está agregando
    $idUsu = unserialize($_SESSION["user"])->id;
    $contacto->idUsu = $idUsu;

    $contacto->save(); // llama a la base de datos y se guarda a sí mismo en ella.

    exit(header("location: main.php?success"));
  endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Guardar nuevo Contacto</title>
</head>

<body class="flex flex-col bg-neutral-800">

  <div class="relative w-full max-w-2xl h-full md:h-auto m-auto mt-16">
    <!-- Modal content -->
    <form method="post" action="guardarContacto.php" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
          Guardar nuevo usuario
        </h3>
      </div>
      <!-- Modal body -->
      <div class="p-6 space-y-6">
        <div class="grid grid-cols-6 gap-6">
          <input type="hidden" name="_token" value="<?= new Token ?>">
          <div class="col-span-6 sm:col-span-3">
            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" name="name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Julian" required>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
            <input type="text" name="surname" id="last-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mena Viñas" required>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example@company.com" required>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Teléfono</label>
            <input type="number" name="tlf" id="phone-number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g. 665 194 125" required>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link a Foto</label>
            <input type="text" name="photo" id="department" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="URL" required>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones</label>
            <textarea type="text" name="obs" id="department" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Un máquina"></textarea>
          </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center justify-between p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Guardar contacto
        </button>
        <a href="main.php" class="">
          <div class="px-5 py-2 bg-red-600 text-red-200 rounded-xl shadow-md">
            Atras
          </div>
        </a>
      </div>
    </form>
  </div>
</body>

</html>