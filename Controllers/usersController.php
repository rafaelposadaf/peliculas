<?php

if(!$_POST || !isset($_SESSION['myusername']))
    die();

include_once '../config/conexion.php';

if($_POST['Action']=="guardarUsuario")
{
    //validacion backend de los datos
    if(!isset($_POST['nombre']) && !isset($_POST['nickname']) && !isset($_POST['password'])) {
        echo "";
        die();
    }
    $nombre =  $_POST['nombre'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    $sql = 'INSERT INTO users (nombre,nickname,password) VALUES (?,?,?)';
    $sentencia_sql = $pdo->prepare($sql);
    $sentencia_sql->execute(array($nombre,$nickname,$password));

    //cerramos conexión base de datos y sentencia
    $sentencia_sql = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo "OK";
    die();
}

if($_POST['Action']=="validarNickName")
{
    $nickname = $_POST['nickname'];
    $id = $_POST['id'];

    $condicionUsuarioExistente="";
    if($id!="")
        $condicionUsuarioExistente=" AND id<>$id";
    $sql = "SELECT id FROM users WHERE nickname='$nickname' $condicionUsuarioExistente";

    $sentencia_sql = $pdo->prepare($sql);
    $sentencia_sql->execute();
    $resultado = $sentencia_sql->fetchColumn();

    //cerramos conexión base de datos y sentencia
    $sentencia_agregar = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo $resultado;
    die();
}