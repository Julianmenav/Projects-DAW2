<?php
session_start();
require_once "./lib/database.php";
require_once "./model/usuario.php";
require_once "./model/token.php";

if(isset($_POST["email"])):

  //El error del token aparece en el momento en el que hacemos start_session() 2 veces. Salta un aviso el cual nos lo mete en el toString().. por eso no se igualan los tokens.
  //Token validation
  if (Token::check($_POST["_token"])) :
    $db = Database::getDatabase();

    $datos = $db->escape($_POST);

    $email = $datos["email"];
    $password = md5($datos["password"]);

    $db->query("SELECT * FROM usuario WHERE email = '{$email}' AND password = '{$password}' ;");
    $usuario = $db->getData("Usuario");

    if($usuario == null){
      $error = "Nombre de usuario o contraseña incorrectos.";
    } else {
      $_SESSION["inicio"] = time();
      $_SESSION["user"] = serialize($usuario);

      exit(header("location: main.php"));
    }
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
  <title>Agenda</title>
</head>

<body class="bg-neutral-800 ">
  <div id="container" class="flex flex-col items-center ">
    <p class="text-center text-3xl font-bold mt-24 ">
      <span class="text-white">
        AGENDAWN
      </span>
      <span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="lime" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block -translate-y-1">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
        </svg>
      </span>
    </p>
    <form method="post" action="<?= isset($_GET["register"]) ? "./login.php?register" : "login.php" ?>" class="m-auto w-fit flex flex-col items-center border-2 border-black shadow-xl rounded-md px-6 pb-6 pt-8 bg-neutral-200">
      <!-- Aqui un input hidden con el token -->
      <input type="hidden" name="_token" value="<?= new Token() ?>">
      <label for="email" class="self-start">Email</label>
      <input id="email" type="email" name="email" class="border border-black[0.7] mb-6 px-4 py-1 rounded-md shadow-md" required>
      <label for="password" class="self-start">Password</label>
      <input id="password" type="password" name="password" class="border border-black[0.7] mb-6 px-4 py-1 rounded-md shadow-md" required>
      <div class="w-full">
        <?php
        if (isset($_GET["signup"])) :
        ?>
          <button class="bg-green-200 text-green-600 px-3 py-1 rounded-md shadow-md w-full">Registrarse</button>
        <?php
        else :
        ?>
          <button class="bg-blue-200 text-blue-600 px-3 py-1 rounded-md shadow-md w-full">Entrar</button>
        <?php endif; ?>
      </div>
      <div class="pt-3">
        <?php
        if (isset($_GET["signup"])) :
        ?>
          <p>Ya tienes una cuenta? <a href="login.php" class="text-teal-600">Login</a></p>
        <?php
        else :
        ?>
          <p>No tienes cuenta? <a href="login.php?signup" class="text-red-600">Registrate</a></p>
        <?php endif; ?>
      </div>
    </form>
    <?php
    if (isset($error)) :
    ?>
      <div class="text-red-600 bg-red-200 px-4 py-2 w-fit mt-2 rounded-md"><?= $error ?></div>
    <?php
    endif;
    ?>
  </div>
</body>

</html>