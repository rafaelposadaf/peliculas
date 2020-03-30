<?php
session_start();

if(!isset($_SESSION['myusername']))
    header("location: login.php");

    $titulo="";
    $sinopsis="";
    $anio_lanzada="";
    $pelicula_id="";
    if($_GET && $_GET['id']!="") {

        include_once 'config/conexion.php';
        $sql = "SELECT id,titulo,sinopsis,anio_lanzada FROM movies where id=".$_GET['id'];
        $sentencia_sql = $pdo->prepare($sql);
        $sentencia_sql->execute();
        $pelicula = $sentencia_sql->fetch();
        $titulo=$pelicula['titulo'];
        $sinopsis=$pelicula['sinopsis'];
        $pelicula_id=$pelicula['id'];

        $titulo_pagina="Editar película";
        $nombre_boton="Actualizar";
        $color_boton="warning";
    }
    else {

        $titulo_pagina="Agregar película";
        $nombre_boton="Guardar";
        $color_boton="success";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './layouts/header.php'; ?>
    <title>Películas</title>
    <?php include_once './layouts/nav.php'; ?>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
    <div class="col-md-11">
        <h1><?php echo $titulo_pagina; ?></h1>
    </div>
    <div class="col-md-11">
        <form>
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" value="<?php echo $titulo; ?>" placeholder="Nombre de la pelicula">
            </div>
            <div class="form-group">
                <label for="sinopsis">Sinopsis</label>
                <input type="text" class="form-control" id="sinopsis" value="<?php echo $sinopsis; ?>" placeholder="Resumen">
            </div>
            <div class="form-group">
                <label for="anio_lanzada">Año de lanzamiento</label>
                <input type="number" class="form-control" id="anio_lanzada" value="<?php echo $anio_lanzada; ?>" placeholder="Año">
            </div>
            <input type="hidden" id="movie_id" name="movie_id" value="<?php echo $movie_id; ?>">
            <button type="button" onclick="validarPelicula()" class="btn btn-success">Guardar</button>
        </form>
    </div>

<?php include_once './layouts/footer.php'; ?>
</body>
</html>

<script>
    function validarPelicula()
    {
        //Validacion reglas dde negocio
        if(!validarReglasNegocio())
            return;
        //AJAX
        enviarDatos();

        //recargar datos
    }

    function validarPelicula()
    {
        $.ajax({
            type: 'POST',
            url: './Controllers/peliculasController.php',
            data: {
                Action: 'validarPelicula',
                nickname: $('#titulo').val(),
                anio_lanzada: $('#anio_lanzada').val(),
                id: $('#pelicula_id').val(),
            },
            success: function(resultado)
            {
                if(resultado=='')
                    return true;
                else
                    alert("La pelicula y el año lanzado ya existen");
                return false;
            }
        });
    }

    function enviarDatos()
    {
        $.ajax({
            type: 'POST',
            url: './Controllers/PeliculasController.php',
            data: {
                Action: 'guardarPelicula',

                nickname: $('#titulo').val(),
                anio_lanzada: $('#anio_lanzada').val(),
                sinopsis: $('#sinopsis').val(),
                id: $('#movie_id').val(),
            },
            success: function(resultado)
            {
                if(resultado=='OK') {

                    alert("Película guardada exitosamente");
                    //vaciar campos
                    limpiarCampos();
                }
                else
                    alert("Hubo un error al intentar guardar la película");
            }
        });

    }

    function validarReglasNegocio()
    {
        if($('#titulo').val().trim=='') {
            alert('El título de la película es requerido');
            return false;
        }
        if($('#anio_lanzada').val().trim=='') {
            alert('El año de lanzamiento de la película es requerido');
            return false;
        }
        if(isNaN($('#anio_lanzada').val())) {
            alert('El año de lanzamiento debe ser un año válido');
            return false;
        }
        let today = new Date();
        let anio_actual=today.getFullYear()
        if($('#anio_lanzada').val()>anio_actual) {
            alert('El año de lanzamiento debe ser un menor o igual al año actual');
            return false;
        }
        return true;
    }

    function limpiarCampos()
    {
        $('#titulo').val('');
        $('#anio_lanzada').val('');
        $('#sinopsis').val('');
    }
</script>
