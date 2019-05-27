<?php
// $usuario=(isset($_GET['parametro']))?$_GET['parametro']:'';
$usuario=$_GET['parametro'];
require('conexion.php');
$usuario=$con->real_escape_string($usuario);
$existe=$con->query("SELECT usuario FROM usuarios WHERE usuario='$usuario'");
 if ($existe->num_rows==1){
	$JSON['existe']=1;
	// echo '1';
}
else{
	// echo '0';
	$JSON['existe']=0;
}
echo json_encode($JSON);
?>