<?php
session_start();
require_once("./models/Usuario.php");
require_once("./lib/Database.php");
require_once("./lib/Token.php");

if (isset($_SESSION["user"])) exit(header("location: main.php"));

if (!empty($_POST)) :

  if (Token::check($_POST["_token"])) :
    $db = Database::getDataBase();
    $datos = $db->escape($_POST);

    if (isset($_GET["signin"])) :
      //REGISTER
      $pass = md5($datos["password"]);
      $sql = "INSERT INTO usuario VALUES (null, '{$datos["email"]}', '{$pass}', '{$datos["name"]}') ; ";
      $db->query($sql);

      exit(header("location: index.php"));
    else :
      //LOGIN
      $pass = md5($datos["password"]);
      $sql = "SELECT * FROM usuario WHERE email='{$datos["email"]}' AND password = '{$pass}';";
      $db->query($sql);
      $user = $db->getData("Usuario");
      if ($user != null) {
        //Transformamos el objeto en string.
        $_SESSION["user"] = serialize($user);
        exit(header("location: main.php"));
      } else {
        $error = "Usuario o contraseña incorrectos";
      }
    endif;
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
  <title>Login</title>
</head>

<body class="bg-[#242424]">
  <?php
  if (isset($error)) :
  ?>
    <div class="bg-red-400 text-red-50 text-center px-3 py-1 w-fit rounded-md m-auto mt-2"><?= $error ?></div>
  <?php
  endif;
  if (isset($_GET["signin"])) :
  ?>
    <form method="post" action="index.php?signin" class="flex flex-col m-auto mt-12 w-[300px] h-[500px] items-center justify-center gap-4">
      <input type="hidden" name="_token" value="<?= new Token ?>">
      <div class="flex flex-col">
        <label class="text-white font-bold text-xs m-1" for="email">Email</label>
        <input class="text-lg px-2 py-1 rounded-md bg-white/[0.1] text-white" id="email" type="email" name="email">
      </div>
      <div class="flex flex-col">
        <label class="text-white font-bold text-xs m-1" for="password">Password</label>
        <input class="text-lg px-2 py-1 rounded-md bg-white/[0.1] text-white " id="password" type="password" name="password">
      </div>
      <div class="flex flex-col">
        <label class="text-white font-bold text-xs m-1" for="name">Nombre de usario</label>
        <input class="text-lg px-2 py-1 rounded-md bg-white/[0.1] text-white " id="name" type="text" name="name">
      </div>
      <div class="flex flex-col items-center">
        <button type="submit" class="border border-black  bg-[#4f29] text-white px-3 py-1 rounded-md shadow-md text-xl">Registrarse</button>
      </div>
    </form>
  <?php else : ?>
    <form method="post" action="index.php" class="flex flex-col m-auto mt-12 w-[300px] h-[500px] items-center justify-center gap-4">
      <input type="hidden" name="_token" value="<?= new Token ?>">
      <div class="flex flex-col">
        <label class="text-white font-bold text-xs m-1" for="email">Email</label>
        <input class="text-lg px-2 py-1 rounded-md bg-white/[0.1] text-white" id="email" type="email" name="email">
      </div>
      <div class="flex flex-col">
        <label class="text-white font-bold text-xs m-1" for="password">Password</label>
        <input class="text-lg px-2 py-1 rounded-md bg-white/[0.1] text-white " id="password" type="password" name="password">
      </div>
      <div class="flex flex-col items-center">
        <button type="submit" class="border border-black  bg-[#4f29f9] text-white px-3 py-1 rounded-md shadow-md text-xl">Entrar</button>
        <p class="text-white mt-4">
          No tienes cuenta?
          <span class="text-red-500">
            <a href="index.php?signin" class="">
              Registrate
            </a>
          </span>
        </p>
      </div>
    </form>
  <?php endif; ?>
</body>

</html>