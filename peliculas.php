<?php
session_start();

if(!isset($_SESSION['myusername']))
    header("location: login.php");
//else
    //header("location: ./views/movies.php");

include_once 'config/conexion.php';
//LEER Usuarios
$sql = 'SELECT id,titulo,sinopsis,anio_lanzada FROM movies';
$gsent = $pdo->prepare($sql);
$gsent->execute();
//$resultado = $gsent->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once './layouts/header.php'; ?>
    <title>Usuario</title>
    <?php include_once './layouts/nav.php'; ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

</head>
<body>
    <div class="container">
    <BR>
        <div class="row">
            <div class="col-md-8">
                <h3>Películas registradas:</h3>
            </div>
            <div class="col-md-4">
                <a type="button" href="peliculasadmin.php" class="btn btn-success">Agregar película</a>
            </div>
        </div>

        <BR>
    <div class="col-md-11">
        <table id="table_id" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Año de lanzamiento</th>
                    <th>Sinopsis</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($pelicula = $gsent->fetch()) {
                ?>
                <tr>
                    <td><?php echo $pelicula['titulo']; ?></td>
                    <td><?php echo $pelicula['anio_lanzada']; ?></td>
                    <td><?php echo $pelicula['sinopsis']; ?></td>
                    <td>
                        <a type="button" href="peliculasadmin.php?id=<?php echo $pelicula['id']; ?>" class="btn btn-warning btn-sm">editar</a>
                        <a type="button" onclick="eliminarPelicula(<?php echo $pelicula['id']; ?>)" class="btn btn-danger btn-sm">eliminar</a>
                    </td>
                </tr>
                <?php
            }

                ?>
            </tbody>
        </table>
    </div>
    </div>
    <?php include_once './layouts/footer.php'; ?>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        function eliminarPelicula(peliculaId)
        {
            r=confirm("Esta seguro que desea eliminar esta pelicula?");
            if(!r)
                return;
            url= './Controllers/peliculasController.php';
            let formData = new FormData();
            formData.append('Action', 'eliminarPelicula');
            formData.append('id', peliculaId);

            let xhr = new XMLHttpRequest();

            xhr.open('POST', url, false);

            try {
                xhr.send(formData);
            if (xhr.status != 200) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                if(xhr.response=='OK') {
                    alert("Se ha eliminado la película");
                    setTimeout(function(){ window.location.href = "users.php"; }, 1000);
                }
                else
                    alert("Hubo un error eliminado el usuario");
            }
            } catch(err) {
                alert("Request failed");
            }
        }
    </script>

</body>
</html>