<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
    <head>
        <title>
            Perfil
        </title>
    </head>
<?php
require 'header.php';
if (isset($_GET['pm'])) {
    if ($_GET['pm'] == 0) {
        $errpwm = "ERROR: Las contraseñas no coinciden.";
    } elseif ($_GET['pm'] == 1) {
        $errpwm = 'Contraseña actualizada correctamente';
    }
}
    else {
    $errpwm =' ';
}


if (isset($_GET['nu'])) {
    if ($_GET['nu'] == 0) {
        $errnu = "ERROR: La contraseña no coincide.";
    } elseif ($_GET['nu'] == 1) {
        $errnu = 'Nombre de usuario actualizado correctamente';
    }
} else {
    $errnu = '';
}
; ?>
<div class='container'
     style="background-color: lightgrey; padding-top: 70px; padding-bottom: 70px; height: 100%; max-width:100% !important;">
    <div class="row">
        <div class="col-md-6">
            <h1>
                Perfil de <?php echo $nombreUsuario . " " . $apellido1Usuario; ?>
            </h1>
            <?php if (file_exists("img/users/$nombreUsuario$codUsuario.png")) {
                echo "<img src='img/users/$nombreUsuario$codUsuario.png'with=100 height=100>";
            } else {
                echo "<img src='img/users/noimg.jpg' with=100 height=100>";
            } ?>
            <h2>Sube una imagen!</h2></br>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload"></br>
                <input type="submit" value="Subir" name="submit">
            </form>
        </div>
        <div class="col-md-6">
            <h1> Cambiar nombre de usuario</h1>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                Nuevo nombre de usuario <br><input type="text" name="usuario" size="30"></br>
                Contraseña <br><input type="password" name="pwd" size="30"></br>
                <input type="submit" value="Cambiar" name="submit">
            </form>
            <?php echo $errnu ; ?>
        </div>
    </div>
            <div class="row" style="background-color: lightgrey;">
        <div class="col-md-6">
            <h1> Cambiar contraseña</h1>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                Nuevo contraseña <br><input type="password" size="30" name="newpwd"></br>
                Repite nueva contraseña <br><input type="password" size="30" name="newpwd2"></br>
                Contraseña antigua <br><input type="password" size="30" name="oldpwd"></br>
                <input type="submit" value="Cambiar" name="submit">
            </form>
            <?php echo $errpwm; ?>
        </div>
                <div class="col-md-6">
                    <h1> Solicitar ajuste horario</h1>
                    <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                        Número de horas <br><input type="number" name="usuario" size="30"></br>
                        Concepto <br><textarea name="Text1" cols="60" rows="3"></textarea></br>
                        <input type="submit" value="Solicitar" name="submit">
                    </form>
    </div>
            </div>
    <div class="row" style="background-color: lightgrey;">
        <div class="col-md-6" >
            <h1> Solicitar vacaciones</h1>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data" style="margin-bottom:30%;">
                Día inicio <br><input type="date" name="usuario" size="30"></br>
                Número de días <br><input type="number" style="width:8%;" name="usuario" size="30"></br>
                <input type="submit" value="Solicitar" name="submit">
            </form>
        </div>
    </div>
<?php require 'footer.php';



