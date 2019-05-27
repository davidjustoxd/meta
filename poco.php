<html>
<head> 
<script> 
	function existeUsuario(usuario) { 
       var xmlhttp = new XMLHttpRequest();
	   xmlhttp.onreadystatechange = function() {
		   if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			   document.getElementById("idUsuario").innerHTML = xmlhttp.responseText;
			   } 
			   } 
			   xmlhttp.open("GET", "comprobarUsuario.php?parametro=" + usuario, true);
			   xmlhttp.send();
			   } 
</script>
</head>
 
	<body>
	Nombre de usuario<input type="text" onkeyup="existeUsuario(this.value)"/>
	<span id="idUsuario"></span> 
	 </body>
</html>