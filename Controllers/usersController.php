<?php

session_start();

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
    $sql = "SELECT COUNT(id) FROM users WHERE nickname='$nickname' $condicionUsuarioExistente";

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

if($_POST['Action']=="actualizarUsuario")
{
    //validacion backend de los datos
    if(!isset($_POST['nombre']) && !isset($_POST['nickname']) && !isset($_POST['password']) && !isset($_POST['id'])) {
        echo "";
        die();
    }
    $nombre =  $_POST['nombre'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    $sql = "UPDATE users SET nombre=?, nickname=?, password=? WHERE id=?";
    $pdo->prepare($sql)->execute([$nombre, $nickname, $password, $id]);

    //cerramos conexión base de datos y sentencia
    $sentencia_sql = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo "OK";
    die();
}

if($_POST['Action']=="eliminarUsuario")
{
    //validacion backend de los datos
    if(!isset($_POST['id'])) {
        echo "";
        die();
    }
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id=?";
    $pdo->prepare($sql)->execute([$id]);

    //cerramos conexión base de datos y sentencia
    $sentencia_sql = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo "OK";
    die();
}

?>