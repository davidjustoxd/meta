<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
    <head>
        <script>
            function refreshChat() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var newchat = JSON.parse(xmlhttp.responseText);
                        document.getElementById("ul").innerHTML += newchat['chat'];
                    }
                    var from = <?php echo $codUsuario ?>;
                    var to =<?php if (isset($_GET['d'])) {
                        echo $_GET['d'];
                    } else {
                        echo '';
                    } ?> ;
                    var lastFecha = document.getElementById("fechaCompleta").lastElementChild.innerHTML;
                    xmlhttp.open("GET", "refreshChat.php?from=" + from + "&to=" + to + "&l" + lastFecha, true);
                    xmlhttp.send();
                }
                set setTimeout(refreshChat, 1000);
            }
            function insertReload() {

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var insertchat = JSON.parse(xmlhttp.responseText);
                        document.getElementById("ul").innerHTML += insertchat['chat'];
                        document.getElementById("text").value = '';
                    }
                }
                var texto = document.getElementById("text").value;
                var from = <?php echo $codUsuario ?>;
                var to = <?php if (isset($_GET['d'])) {
                    echo $_GET['d'];
                } else {
                    echo '';
                } ?>

                    xmlhttp.open("GET", "insertreload.php?texto=" + texto + "&from=" + from + "&to=" + to, true);
                xmlhttp.send();
            }
            window.onLoad=refreshChat();
        </script>
        <title>
            Chat META
        </title>
    </head>
<?php
require 'header.php';
?>
<div class='container'
     style="background-color: lightgrey; padding-top: 70px; padding-bottom: 70px; height: 100%; max-width:100%; overflow:auto;">
    <div class="row">
        <div class="col-md-4" style="text-align:center;">
            Todos los destinatarios <br>
            <?php
            $destinatarios = allUsuarios($codUsuario);
            while ($destinatario = $destinatarios->fetch_assoc()) { ?>
                <a href="chat.php?d=<?php echo $destinatario['codigo'] ?>#lastmsg" ;><?php
                    if ((isset($_GET['d'])) && ($destinatario['codigo'] == $_GET['d'])) {
                        echo "<strong>" . $destinatario['nombre'] . ' ' . $destinatario['apellido1'] . "</strong>";
                    } else {
                        echo $destinatario['nombre'] . ' ' . $destinatario['apellido1'];
                    }
                    ?></a>
                <br>
            <?php } ?>
        </div>
        <div class="col-md-8">
            <?php if (!isset($_GET['d'])) {
                echo "<h1>Selecciona un destinatario para empezar a chatear</h1>";
            } else {
            $destinatario = $_GET['d'];
            $nMensajes = 0;
            $mensajes = recuperarMensajesChat($codUsuario, $destinatario);
            echo "<ul id='ul' style='list-style: none; height:700px; overflow:auto;' >";
            while ($mensaje = $mensajes->fetch_assoc()) {
                $nMensajes += 1;
                $texto = $mensaje['texto'];
                $from = $mensaje['codUsuarioFrom'];
                $to = $mensaje['codUsuarioTo'];
                $fecha = $mensaje['fecha'];
                $fechaprint = substr($fecha, 11, 5);
                if ($from == $codUsuario) {
                    $id = "id='foru' style= 'text-align:left; margin-bottom:5%; background-color:lightgreen; border-radius: 25px; padding:10px;'";
                } else {
                    $id = "id='forme' style='text-align:right; margin-bottom:5%;background-color:white; border-radius: 25px;padding:10px;'";
                }
                ?>
                <div class="row" style="margin-right:20%;">
                    <div class="col-md-12" style='word-wrap:break-word;'>
                        <li<?php echo " $id " ?>><?php echo $texto ?><br><span
                                    id='span'><?php echo $fechaprint; ?></span></li>
                    </div>
                </div>
            <?php }
            //            echo "<a id='lastmsg'></a>";
            echo "</ul>"; ?>

            <div id="textbox">
                <input type="hidden" id='fechaCompleta' value="<?php echo $fecha ?>">
                <form name="msg" onsubmit="return false">
                    <input type="text" id="text" name="text" style="width:80%;">
                    <input type="submit" value="Enviar" onclick="insertReload();">
                </form>
            </div>
        </div>


        <?php } ?>


    </div>
<?php require 'footer.php';
