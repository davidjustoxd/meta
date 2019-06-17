<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
<head>
    <title>
        ADMIN
    </title>
</head>
<?php
require 'header.php'; ?>
<div  class='container' style="background-color: lightgrey; padding-top: 70px; padding-bottom: 70px; height: 100%; max-width:100% !important;">
    <h1>
        Administración de Usuarios
    </h1>
    <?php if (file_exists("img/users/$nombreUsuario$codUsuario.png")) {
        echo "<img src='img/users/$nombreUsuario$codUsuario.png'with=100 height=100>";
    } else {
        echo "<img src='img/users/noimg.jpg' with=100 height=100>";
    }
    ?><br>
    Sube una imagen!</br>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" class="form-control" id="fileToUpload"></br>
        <input type="submit" value="Subir" class="form-control" name="submit">
    </form>
</div>
<?php require 'footer.php';




