<?php
session_start();

if(!isset($_SESSION['myusername']))
    header("location: login.php");
//else
    //header("location: ./views/movies.php");


//include_once 'config/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './layouts/header.php'; ?>
    <title>Sistema</title>
</head>
<body>
    <?php include_once './layouts/nav.php'; ?>
    <?php include_once './layouts/footer.php'; ?>
</body>
</html>