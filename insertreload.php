<?php
//https://www.youtube.com/watch?v=wMlLgYyz_ws
//https://www.youtube.com/watch?v=oIVI1qYx87E
require 'sesion.php';
if ((!isset($_GET['texto'])) || (!isset($_GET['f'])) || (!isset($_GET['to']))) {
    header('Location:cerrarSesion.php');
    die ("No deberías ver nunca esto");
}
require 'conexion.php';
require 'functions.php';
$texto = strip_tags($con->real_escape_string($_GET['texto']));
$fecha = strip_tags($con->real_escape_string($_GET['f']));
$to = strip_tags($con->real_escape_string($_GET['to']));
if (strlen($texto)!=0) {
    insertarMensajeChat($texto, $codUsuario, $to);
}
$mensajes = recuperarUltimosChats($codUsuario, $to, $fecha);
$response='';
while ($mensaje = $mensajes->fetch_assoc()) {
    $texto = $mensaje['texto'];
    $from = $mensaje['remitente'];
    $to = $mensaje['codUsuarioTo'];
    $fecha = $mensaje['fecha'];
    $fechaprint = substr($fecha, 11, 5);
    $fechaUnix= $mensaje['fechaUnix'];
    if ($from == $codUsuario) {
        $id = "id='foru' style= 'text-align:right; margin-bottom:5%; background-color:lightgreen; border-radius: 25px; padding:10px;'";
    } else {
        $id = "id='forme' style='text-align:left; margin-bottom:5%;background-color:white; border-radius: 25px;padding:10px;'";
    }
    $response .= "<div class='row' style='margin-right:20%;'>";
    $response .= "<div class='col-md-12' style='word-wrap:break-word;'>";
    $response .= "<li  $id > $texto <br> <span id='span'> $fechaprint </span> </li></div></div>";
}
$json['fechaUnix']=$fechaUnix;
//$response .= "<a id='lastmsg'></a>";
$json['chat'] = $response;
echo json_encode($json);