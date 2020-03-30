<?php

$link = 'mysql:host=localhost;dbname=test';
$usuario = 'root';
$pass = '';

try{

    $pdo = new PDO($link,$usuario,$pass);

    //echo 'Conectado';

    // foreach($pdo->query('SELECT * FROM `colores`') as $fila) {
    //     print_r($fila);
    // }

}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}