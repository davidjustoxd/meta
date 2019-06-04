<?php
//https://www.youtube.com/watch?v=wMlLgYyz_ws
//https://www.youtube.com/watch?v=oIVI1qYx87E
require 'sesion.php';
if ((!isset($_GET['texto'])) || (!isset($_GET['from'])) || (!isset($_GET['to']))){
    header ('Location:cerrarSesion.php');
    die ("No deberías ver nunca esto");
}
require 'conexion.php';
require 'functions.php';
$texto=strip_tags($con -> real_escape_string($_GET['texto']));
$from=strip_tags($con -> real_escape_string($_GET['from']));
$to=strip_tags($con -> real_escape_string($_GET['to']));
if ($texto !=''){
insertarMensajeChat($texto,$from,$to);}
    $response='<ul>';
    $mensajes = recuperarMensajesChat($from, $to);
    while ($mensaje = $mensajes->fetch_assoc()) {
        $texto = $mensaje['texto'];
        $from = $mensaje['codUsuarioFrom'];
        $to = $mensaje['codUsuarioTo'];
        $fecha = $mensaje['fecha'];
        $fechaprint = substr($fecha, 11, 5);
        if ($from == $from) {
            $id = "id='foru'  style='float:right; margin-left:8px; background-color: lightgreen; margin-right:1%'";
        } else {
            $id = "id='forme'  style='float:left; margin-right:8px; background-color: lightgreen; margin-left:1%'";
        }

       $response.="<li  $id > $texto <br> $fechaprint </li>";


 }
    $response.= "<a id='lastmsg'></a>";
    $response.="</ul>";
    $response.="<div id='textbox'>";
        $response.="<form name='msg' onsubmit='return false'>";
            $response.="<input type='text' id='text' name='text'>";
            $response.="<input type='submit' value='Enviar' onclick='nuevoChat()'>";
        $response.="</form>";

$json['chat']=$response;
echo json_encode($json);