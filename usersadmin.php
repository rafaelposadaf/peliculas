<?php
session_start();

if(!isset($_SESSION['myusername']))
    header("location: login.php");

    $nombre="";
    $nickname="";
    $password_fake="";
    $user_id="";
    if($_GET && $_GET['id']!="") {

        include_once 'config/conexion.php';
        $sql = "SELECT id,nombre,nickname FROM users where id=".$_GET['id'];
        $gsent = $pdo->prepare($sql);
        $gsent->execute();
        $user = $gsent->fetch();
        $nombre=$user['nombre'];
        $nickname=$user['nickname'];
        $password_fake="*****";//contraseña falsa
        $user_id=$user['id'];

        $titulo_pagina="Editar usuario";
        $nombre_boton="Actualizar";
        $color_boton="warning";
    }
    else {

        $titulo_pagina="Agregar usuario";
        $nombre_boton="Guardar";
        $color_boton="success";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './layouts/header.php'; ?>
    <title>Usuarios</title>
    <?php include_once './layouts/nav.php'; ?>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
    <div class="col-md-11">
        <h1><?php echo $titulo_pagina; ?></h1>
    </div>
    <div class="col-md-11">
        <form>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre completo" required>
            </div>
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" value="<?php echo $nickname; ?>" placeholder="nombre de usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" value="<?php echo $password_fake; ?>" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <label for="repeat_password">Repeat password</label>
                <input type="password" class="form-control" id="repeat_password" value="<?php echo $password_fake; ?>" placeholder="Vuelva a digitar contraseña" required>
            </div>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
            <button type="button" onclick="validarUsuario()" class="btn btn-<?php echo $color_boton; ?>"><?php echo $nombre_boton; ?> </button>
        </form>
    </div>

<?php include_once './layouts/footer.php'; ?>
</body>
</html>

<script>
    function validarUsuario()
    {
        //Validacion reglas dde negocio
        if(!validarReglasNegocio())
            return;

        //validar usuario ajax
        /*hola=validarNickname();
        alert(hola);
        if(!validarNickname()) //en caso de ser falso no continua
            return;*/
        //validar contraseña
        if($('#password').val() != $('#repeat_password').val()) {
            alert('Las constraseñas ingresadas no coinciden');
            return;
        }
        if($('#user_id').val()=='')
            guardarDatos();
        else
            actualizarDatos();
    }

    function validarNickname()
    {
        url= './Controllers/usersController.php';
        let formData = new FormData();
        formData.append('Action', 'validarNickName');
        formData.append('nickname', $('#nickname').val());
        formData.append('id', $('#user_id').val());

        let xhr = new XMLHttpRequest();

        xhr.open('POST', url, false);

        try {
            xhr.send(formData);
        if (xhr.status != 200) {
            alert(`Error ${xhr.status}: ${xhr.statusText}`);
        } else {
            if(xhr.response==0);
                return true;
        }
        } catch(err) {
            alert("Request failed");
        }
        return false;
    }

    function guardarDatos()
    {
        url='./Controllers/usersController.php';
        Action='guardarUsuario';
        respuesta=enviarDatosAjax(url,Action);
        if(respuesta=='OK') {

            alert("Usuario guardado exitosamente");
            //vaciar campos
            limpiarCampos();
        }
        else
            alert("Hubo un error al intentar guardar el usuario");
    }

    function actualizarDatos()
    {
        url='./Controllers/usersController.php';
        Action='actualizarUsuario';
        respuesta=enviarDatosAjax(url,Action);
        if(respuesta=='OK') {

            alert("Usuario actualizado exitosamente");
            //limpiarCampos();
        }
        else
            alert("Hubo un error al intentar actualizar el usuario");
    }

    function enviarDatosAjax(url,Action)
    {
        let formData = new FormData();
        formData.append('Action', Action);
        formData.append('nombre', $('#nombre').val());
        formData.append('nickname', $('#nickname').val());
        formData.append('password', $('#password').val());
        formData.append('id', $('#user_id').val());

        let xhr = new XMLHttpRequest();

        xhr.open('POST', url, false);

        try {
            xhr.send(formData);
        if (xhr.status != 200) {
            alert(`Error ${xhr.status}: ${xhr.statusText}`);
        } else {
            //alert(xhr.response);
            return xhr.response;
        }
        } catch(err) {
            alert("Request failed");
        }
        return "";
    }

    function validarReglasNegocio()
    {
        //el usuario debe tener al menos 5 caracteres
        if($('#nombre').val().trim().length < 5) {
            alert('El nombre de usuario debe contener minimo 5 caracteres válidos');
            return false
        }
        //validamos que no tenga un caracter diferente a los permitidos
        var letters = /^[0-9a-zA-Z_]+$/i;
        if(!$('#nickname').val().match(letters)) {
            alert('El nickname del usuario solo debe contener letras, números y/o guiones');
            return false;
        }
        //Validamos que tenga al menos una letra mayuscula
        if(!$('#password').val().match(/[A-Z]/i)) {
            alert('La contraseña del usuario debe contener al menos una letra mayuscula');
            return false;
        }
        //Validamos que tenga al menos un número
        if(!$('#password').val().match(/[0-9]/i)) {
            alert('La contraseña del usuario debe contener al menos un número');
            return false;
        }
        return true;
    }

    function limpiarCampos()
    {
        $('#nombre').val('');
        $('#nickname').val('');
        $('#password').val('');
        $('#repeat_password').val('');
        $('#user_id').val('');
    }
</script>