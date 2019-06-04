<?php
$error='';
if (isset ($_POST['usuario'], $_POST ['pwd'])) {
	require __DIR__.'/conexion.php';
	$usuario=$_POST['usuario'];
	$pwd=$_POST ['pwd'];
	$usuario=$con->real_escape_string($usuario);
	$pwd=$con->real_escape_string($pwd);
	$pwd= hash( "sha512", $pwd);
	$sql="SELECT * FROM usuarios WHERE nombreUsuario='$usuario' AND pwd='$pwd'";
	$filas=$con->query($sql);
	if ( $fila=$filas->fetch_assoc()){
		$administrador=$fila['administrador'];
		session_name('meta');
		session_start();
		$_SESSION['codigo']=$fila['codigo'];
		$_SESSION['nombre']=$fila['nombre'];
		$_SESSION['apellido1']=$fila['apellido1'];
		$_SESSION['codPermiso']=$fila['codPermiso'];
//		$_SESSION['img']=$fila['img'];
		header ('Location:menu.php');
	}
	else $error="No existe la combinación introducida";
	}
	?>

<html>
	<head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title> Login </title>
	</head>
	<body>
	<div class="border border-primary m-5 p-5">
	<form action="index.php" METHOD="POST" class="form">
	Nombre de usuario<input type="text" name="usuario" class="form-control"/>
	Contraseña<input type="password" name="pwd" class="form-control"/>
	</br>
	 <input type="submit" value="Entrar" class="form-control"/>
	 </form>
	 <p1> <?=$error?> </p1>
	 <a href="registrar.php"> Registrate </a>
	 </body>
</html>
