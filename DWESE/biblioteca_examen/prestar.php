<?php 
  require_once("./models/Lector.php");
  require_once("./lib/Database.php");

  if(isset($_POST["prestamo"])):
    $db = Database::getDataBase();
    $datos = $db->escape($_POST);

    $sql = "INSERT INTO prestamo (dni, isbn, prestamo, devolucion) VALUES ('{$datos["dni"]}', '{$datos["isbn"]}', '{$datos["prestamo"]}', NULL);";
    $db->query($sql);

    exit(header("location: index.php?libros"));
  endif;

  if(!isset($_GET["isbn"])){
    exit(header("location: index.php"));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="post" action="prestar.php">
    <select name="dni" id="dni">
      <?php foreach(Lector::getAll() as $lector): ?>
      <option value="<?= $lector->dni ?>"><?= $lector->dni ?></option>
      <?php endforeach; ?>
    </select>
    <input type="hidden" value="<?= $_GET["isbn"]?>">
    <input type="date" name="prestamo">
    <input type="hidden" name="isbn" value="<?= $_GET["isbn"]?>">
    <button type="submit">Enviar</button>
  </form>
</body>
</html>