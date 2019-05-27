<?php
require('sesion.php');
require('conexion.php');
if (isset($_POST['mensaje'])) {
	$mensaje=$_POST['mensaje'];
	$mensaje=$con->real_escape_string($mensaje);
	$mensaje=(strip_tags($mensaje));
	if ($mensaje==''){
		header ("Location:chatOriginal.php");
		exit;
	}
	if (isset($_POST['todos']))
		$grupo='NULL';	
	
	$sql="INSERT INTO mensajes(mensaje,usuario,codGrupo,fecha) VALUES ('$mensaje','$usuario',$grupo,CURRENT_TIMESTAMP)";
	$con->query($sql);
	if ($administracion==1)
		header ("Location:chatOriginal.php?grupos=$grupo");
	else
		header ("Location:chatOriginal.php");
	}
else
	header ("Location:chatOriginal.php");
?>
