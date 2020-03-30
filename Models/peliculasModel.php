<?php

session_start();

if(!$_POST || !isset($_SESSION['myusername']))
    die();

include_once '../config/conexion.php';

if($_POST['Action']=="guardarPelicula")
{
    //validacion backend de los datos
    if(!isset($_POST['titulo']) && !isset($_POST['sinopsis']) && !isset($_POST['anio_lanzada'])) {
        echo "";
        die();
    }
    $titulo =  $_POST['titulo'];
    $sinopsis = $_POST['sinopsis'];
    $anio_lanzada = $_POST['anio_lanzada'];

    $sql = 'INSERT INTO movies (titulo,sinopsis,anio_lanzada) VALUES (?,?,?)';
    $sentencia_sql = $pdo->prepare($sql);
    $sentencia_sql->execute(array($titulo,$sinopsis,$anio_lanzada));

    //cerramos conexión base de datos y sentencia
    $sentencia_sql = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo "OK";
    die();
}

if($_POST['Action']=="validarTitulo")
{
    if(!isset($_POST['titulo'])) {
        echo "";
        die();
    }

    $titulo = $_POST['titulo'];
    $id = $_POST['id'];

    $condicionPeliculaExistente="";
    if($id!="")
        $condicionPeliculaExistente=" AND id<>$id";
    $sql = "SELECT COUNT(id) FROM movies WHERE titulo='$titulo' $condicionPeliculaExistente";

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

if($_POST['Action']=="actualizarPelicula")
{
    //validacion backend de los datos
    if(!isset($_POST['nombre']) && !isset($_POST['nickname']) && !isset($_POST['password']) && !isset($_POST['id'])) {
        echo "";
        die();
    }
    $titulo =  $_POST['titulo'];
    $sinopsis = $_POST['sinopsis'];
    $anio_lanzada = $_POST['anio_lanzada'];
    $id = $_POST['id'];

    $sql = "UPDATE movies SET titulo=?, sinopsis=?, anio_lanzada=? WHERE id=?";
    $pdo->prepare($sql)->execute([$titulo, $sinopsis, $anio_lanzada, $id]);

    //cerramos conexión base de datos y sentencia
    $sentencia_sql = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo "OK";
    die();
}

if($_POST['Action']=="eliminarPelicula")
{
    //validacion backend de los datos
    if(!isset($_POST['id'])) {
        echo "";
        die();
    }
    $id = $_POST['id'];

    $sql = "DELETE FROM movies WHERE id=?";
    $pdo->prepare($sql)->execute([$id]);

    //cerramos conexión base de datos y sentencia
    $sentencia_sql = null;
    $pdo = null;

    //Imprimimos respuesta operación
    echo "OK";
    die();
}

?>