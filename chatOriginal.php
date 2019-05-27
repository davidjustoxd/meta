<?php
require('sesion.php');
require('conexion.php');
if (isset($_GET['grupos']) && is_numeric($_GET['grupos'])){
	$codigoGrupo=$_GET['grupos'];
	$condicion="codGrupo=$codigoGrupo";
}
else { 
	if (isset($_GET['grupos'])) {
		$codigoGrupo=$_GET['grupos'];
		$condicion='codGrupo IS NULL';
	}
	else{
		$condicion="codGrupo in (SELECT codGrupo FROM usuarios where usuario='$usuario') or codGrupo IS NULL";
	}
}
$sql="SELECT codMensaje, mensaje, usuario, fecha, codGrupo 
			FROM mensajesChat WHERE $condicion
			ORDER BY codGrupo DESC";
$filas=$con->query($sql);
$selected='';
?>
<html> 
	<head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title> Chats
		</title>
		</head>
	<body>	
	<h2> Mensajes de <?php echo "$nombreUsuario $apellido1Usuario" ?> </h2> </br>
	<form action="insertar.php" method="post" class="form">
            <textarea name="mensaje" rows="3" cols="50"></textarea>
			A todos <input type="checkbox" name="todos"/>
            <input type="submit" value="Enviar"/>
    </form>
	<?php if ($administrador==1){ ?>
	<select type="text" name="selectGrupos" onChange="location.href='?grupos='+this.value" class="form-control">
				<option value='NULL' >General</option>
				<?php 	
				$sql1="select distinct nombre, codGrupo from grupos";
				$fila=$con->query($sql1);
					while ($grupos=$fila->fetch_assoc()):
					$codGrupo=$grupos['codGrupo'];
					$nombre=$grupos['nombre'];
					if (isset ($codigoGrupo)){
					if ($codigoGrupo==$codGrupo){
						$selected="SELECTED";
						$_SESSION['grupo']=$codGrupo;
					}
					else
						$selected="";
					}
					?>
				<option value="<?=$codGrupo?>" <?=$selected?>> <?=$nombre?></option>
				<?php endwhile; 
	}		
				?>
	</select> </br>
	<table border="1" class="table table-hover">
					<tr>
						<th> Fecha </th>
						<th> Usuario </th>
						<th> Mensaje </th>
						<th></th>
					</tr>
					<?php 
					while ($mensaje=$filas->fetch_assoc()){
						$fecha=$mensaje['fecha'];
						$textoMensaje=$mensaje['mensaje'];
						$codMensaje=$mensaje['codMensaje'];
						$usuarioMensaje=$mensaje['usuario'];
						$codGrupo=$mensaje['codGrupo'];
	
					?>
						<tr>
							<td><?=$fecha?></td>
							<td><?=$usuarioMensaje?></td>
							<td><?php if ($codGrupo=='')
										  echo '*';
									  else
										  echo ''; ?>
								<?=$textoMensaje?> 
							</td>
							<td>
								<?php if ($usuarioMensaje==$usuario){ ?>
										<a href='eliminar.php?codMensaje=<?=$codMensaje?>' 
										onclick="return confirm ('¿Desea eliminar e mensaje?')">Eliminar</a>
								<?php	}
									  else 
										  echo ''; ?>
							</td>
						</tr>
						
				<?php				
					}
				 $con->close();
				?>	
		</table>

	<div class='d-flex justify-content-between'>
		<h6>Sesión actual: <?=$usuario?></h6>
		<a href="cerrarSesion.php?cod">Cerrar sesion</a></td>
	</div>
	
	</body>
</html>