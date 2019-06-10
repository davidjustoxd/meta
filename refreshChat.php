<?php

require 'sesion.php';
if ((!isset($_GET['lastFecha'])) || (!isset($_GET['from'])) || (!isset($_GET['to']))) {
    header('Location:cerrarSesion.php');
    die ("No deberías ver nunca esto");
}
require 'conexion.php';
require 'functions.php';
$nMensajes = strip_tags($con->real_escape_string($_GET['nMensajes']));
$from = strip_tags($con->real_escape_string($_GET['from']));
$to = strip_tags($con->real_escape_string($_GET['to']));
$fecha = contarChats($from, $to);
while ($mensaje = $mensajes->fetch_assoc()) {
    $nMensajesBD = $mensaje['nMensajes'];
    if ($nMensajesBD != $nMensajes) {
        $mensajes = recuperarUltimosChats($from, $to, $fecha);
        while ($mensaje = $mensajes->fetch_assoc()) {
            $texto = $mensaje['texto'];
            $from = $mensaje['codUsuarioFrom'];
            $to = $mensaje['codUsuarioTo'];
            $fecha = $mensaje['fecha'];
            $fechaprint = substr($fecha, 11, 5);
            if ($from == $codUsuario) {
                $id = "id='foru'  style=' margin-left:8px; background-color: lightgreen; margin-right:1% float:right; clear:both;'";
            } else {
                $id = "id='forme'  style=' margin-right:8px; background-color: lightgreen; margin-left:1% float:left; clear:both;'";
            }

            $response = "<li  $id > $texto <br> <span id='span'> $fechaprint </span> </li>";


        }
    }
    else $response='';
}
//$response .= "<a id='lastmsg'></a>";
        $json['chat'] = $response;
        echo json_encode($json);