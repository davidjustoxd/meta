<?php
require('sesion.php');
require 'conexion.php';
	$codMensaje=$_GET['codMensaje'];
	$sql="DELETE FROM mensajes WHERE codMensaje=$codMensaje AND usuario=$usuario";
	$con->query($sql);
	$con->close();
	if ($administracion==1)
		header ("Location:chatOriginal.php?grupos=$grupo");
	else
		header ("Location:chatOriginal.php");
?>