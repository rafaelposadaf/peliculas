<?php
session_start();

if(!isset($_SESSION['myusername']))
    header("location: login.php");
else
    header("location: home.php");


?>

<!doctype html>
<html lang="es">
  <head>
    
  <?php include_once './layouts/header.php'; ?>
    <title>Hello, world!</title>
  </head>
  <body>
    <?php include_once './layouts/nav.php'; ?>

    <?php include_once './layouts/footer.php'; ?>
  </body>
</html>

<?php 

//cerramos conexión base de datos y sentencia
$pdo = null;
$gsent = null;

?>