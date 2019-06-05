<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
    <head>
        <script>
            if ( document.getElementById("text").value=='')
            {
                setInterval(nuevoChat, 1000);
            }
            function nuevoChat() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var newchat = JSON.parse(xmlhttp.responseText);
                        document.getElementById("contMensajesChat").innerHTML = newchat['chat'];
                    }
                }
                var texto = document.getElementById("text").value;
                var from = <?php echo $codUsuario ?>;
                var to = <?php echo $_GET['d'] ?>;

                xmlhttp.open("GET", "insertreload.php?texto=" + texto + "&from=" + from + "&to=" + to, true);
                xmlhttp.send();
            }
        </script>
        <title>
            Chat META
        </title>
    </head>
<body>
<?php
require 'header.php';
?>
<div id="container">
    <div id="allUsuarios">
        Todos los destinatarios <br>
        <?php
        $destinatarios = allUsuarios($codUsuario);
        while ($destinatario = $destinatarios->fetch_assoc()) { ?>
            <a href="chat.php?d=<?php echo $destinatario['codigo'] ?>#lastmsg"><?php
                if ((isset($_GET['d'])) && ($destinatario['codigo'] == $_GET['d'])) {
                    echo "<strong>" . $destinatario['nombre'] . ' ' . $destinatario['apellido1'] . "</strong>";
                } else {
                    echo $destinatario['nombre'] . ' ' . $destinatario['apellido1'];
                }
                ?></a>
            <br>
        <?php } ?>
    </div>
    <div id="contMensajesChat">
        <?php if (!isset($_GET['d'])) {
            echo "<h1>Selecciona un destinatario para empezar a chatear</h1>";
        } else {
            $destinatario = $_GET['d'];
            $mensajes = recuperarMensajesChat($codUsuario, $destinatario);
            echo "<ul>";
            while ($mensaje = $mensajes->fetch_assoc()) {
                $texto = $mensaje['texto'];
                $from = $mensaje['codUsuarioFrom'];
                $to = $mensaje['codUsuarioTo'];
                $fecha = $mensaje['fecha'];
                $fechaprint = substr($fecha, 11, 5);
                if ($from == $codUsuario) {
                    $id = "id='foru' style=margin-left:8px; background-color: lightgreen; margin-right:1%'";
                } else {
                    $id = "id='forme' style=margin-right:8px; background-color: lightgreen; margin-left:1%'";
                }
                ?>
                <li<?php echo " $id" ?>><?php echo $texto ?><br><span id='span'><?php echo $fechaprint; ?></span></li>
            <?php } echo "<a id='lastmsg'></a>";
                    echo "</ul>"; ?>
            <div id="textbox">
                <form name="msg" onsubmit="return false">
                    <input type="text" id="text" name="text">
                    <input type="submit" value="Enviar" onclick="nuevoChat()">
                </form>
            </div>


        <?php } ?>


    </div>
<?php require 'footer.php';
