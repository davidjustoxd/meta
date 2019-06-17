<?php
session_name('meta');
session_start();
if (isset($_SESSION['codigo'], $_SESSION['codPermiso'])) {
    $codUsuario = $_SESSION['codigo'];
    $nombreUsuario = $_SESSION['nombre'];
    $apellido1Usuario = $_SESSION['apellido1'];
    $esAdmin = $_SESSION['codPermiso']==1 ? 0 : 1;
} else
    header("Location:.");

?>