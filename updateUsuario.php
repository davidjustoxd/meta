<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';

if (isset($_POST['newpwd'], $_POST['newpwd2'], $_POST['oldpwd'])) {
    $newpwd = $con->real_escape_string(strip_tags(hash("sha512", ($_POST['newpwd']))));
    $newpwd2 = $con->real_escape_string(strip_tags(hash("sha512", ($_POST['newpwd2']))));
    $oldpwd = $con->real_escape_string(strip_tags(hash("sha512", ($_POST['oldpwd']))));
    if ($newpwd != $newpwd2) {
        header('Location:perfil.php?pm=0');
    } else {
        if (!empty($oldpwd) && !empty($newpwd)) {
            updatePasswd($codUsuario, $oldpwd, $newpwd);
            header('Location:perfil.php?pm=1');

        } else {
            header('Location:cerrarSesion.php');
        }
    }
}
elseif (isset($_POST['usuario'], $_POST['pwd'])) {
    $usuario = $con->real_escape_string(strip_tags($_POST['usuario']));
    $pwd = $con->real_escape_string(strip_tags(hash("sha512", ($_POST['pwd']))));
    if (!empty($usuario) && !empty ($pwd)) {
        updateUserName($usuario, $codUsuario,  $pwd);
        header('Location:perfil.php?nu=1');
    } else {
        header('Location:cerrarSesion.php');


    }
}
