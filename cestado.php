<?php
require 'sesion.php';
require 'conexion.php';
if ((isset($_GET['n'])) && (is_numeric($_GET['n']))){
    require 'functions.php';
    $codEstado=$_GET['n'];
    actualizarEstadoFichaje($codUsuario,$codEstado);
}
header ('Location:menu.php');