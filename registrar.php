<?php
$error='';
require('conexion.php');
$usuario='';
if (isset ($_POST['usuario'],$_POST ['pwd'],$_POST ['pwd2'],$_POST['grupo'])){
	$usuario=$_POST['usuario'];
	$pwd=$_POST ['pwd'];
	$pwd2=$_POST ['pwd2'];
	$grupo=$_POST ['grupo'];
	$fila=$con->query("SELECT usuario FROM usuarios WHERE usuario='$usuario'");
	if ($fila->num_rows==0){
		if ($pwd==$pwd2){
			$usuario=$con->real_escape_string($usuario);
			$pwd=$con->real_escape_string($pwd);
			$pwd= hash( "sha512", $pwd);
			$sql="INSERT INTO usuarios(usuario,password,codGrupo) VALUES ('$usuario','$pwd','$grupo')";
			$filas=$con->query($sql);
			session_name('chat');
			session_start();
			$_SESSION['usuario']=$usuario;
			$_SESSION['grupo']=$grupo;
			header ('Location:chatOriginal.php');
		}
		
		else $error="Las contraseñas no coinciden.";
	}
	else $error='Ese usuario ya existe';
}
else $error="Deben rellenarse todos los campos";
	?>
	
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script> 
	function existeUsuario(usuario) { 
       var xmlhttp = new XMLHttpRequest();
	   xmlhttp.onreadystatechange = function() {
		   if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			   var json = JSON.parse(xmlhttp.responseText)
			   var mensaje = (json['existe']==1)?"Existe":"No existe"
			   // var mensaje= (xmlhttp.responseText==1)?"Existe":"No existe"
			   document.getElementById("idUsuario").innerHTML = mensaje;
			   } 
			   } 
			   xmlhttp.open("GET", "comprobarUsuario.php?parametro=" + usuario, true);
			   xmlhttp.send();
			   }
	function FormOK(F){
		if(F.pwd.value!=F.pwd2.value){
			document.getElementById("idContraseña").innerHTML = "Las contraseñas no coinciden";
			return false;
		}
		return true;
	}
</script>
<title> Registrar </title>
</head>
 
	<body>
	<div class="border border-primary m-5 p-5">
	<form action="registrar.php" METHOD="POST" class="form" onSubmit='return FormOK(this)'>
	Nombre de usuario<input type="text" placeholder="<?=$usuario?>" name="usuario" onkeyup="existeUsuario(this.value)" class="form-control"/>
	<span id="idUsuario"></span> </br>
	Contraseña<input type="password" name="pwd" class="form-control"/></br>
	Repita la contraseña<input type="password" name="pwd2" class="form-control"/>
	<span id="idContraseña"></span>
	</br>
	Inserte el grupo
	<select type="text" name="grupo" class="form-control">
				<?php 			
				$sql1="select distinct nombre, codGrupo from grupos";
				$fila=$con->query($sql1);
					while ($grupos=$fila->fetch_assoc()):
					$codGrupo=$grupos['codGrupo'];
					$grupo=$grupos['nombre'];
				?>
				 <option value="<?=$codGrupo?>"> <?=$grupo?></option>
				<?php 
				endwhile;
				?>
				</select>
	</br>
	<input type="submit" value="Registrarse" class="form-control"/>
	</form>
		 <div class='d-flex justify-content-between'>
		<p1> <?=$error?> </p1>
		<a href="index.php?cod">Iniciar Sesión</a></td>
	</div>
	</div>
	</body>
</html>	





























