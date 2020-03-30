<?php

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
    $titulo = $_POST['titulo'];
    $id = $_POST['id'];

    $condicionPeliculaExistente="";
    if($id!="")
        $condicionPeliculaExistente=" AND id<>$id";
    $sql = "SELECT id FROM movies WHERE titulo='$titulo' $condicionPeliculaExistente";

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