<?php
session_start();

if(!isset($_SESSION['myusername']))
    header("location: login.php");
//else
    //header("location: ./views/movies.php");


//include_once 'config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once './layouts/header.php'; ?>
    <title>Home</title>
</head>
<body>
    <?php include_once './layouts/nav.php'; ?>
    <h3>Home</h3>
    <?php include_once './layouts/footer.php'; ?>
</body>
</html>