<?php
session_name('meta');
session_start();
if (isset($_SESSION['codigo'], $_SESSION['codPermiso'])) {
    $codUsuario = $_SESSION['codigo'];
    $nombreUsuario = $_SESSION['nombre'];
    $apellido1Usuario = $_SESSION['apellido1'];
    $permiso = $_SESSION['codPermiso'];
//	$imagen=$_SESSION['img'];
} else
    header("Location:.");

?>