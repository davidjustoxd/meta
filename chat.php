<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
    <head>
        <script>
            window.onload = function () {
                setInterval(function () {
                    refreshChat();
                }, 5000);
            };

            function refreshChat() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var newchat = JSON.parse(xmlhttp.responseText);
                        if (newchat['chat'] != '') {
                            var elem = document.getElementById('ul');
                            elem.scrollTop = elem.scrollHeight;
                            document.getElementById("ul").innerHTML += newchat['chat'];
                        }
                    }
                    var from = <?php echo $codUsuario ?>;
                    var to =<?php if (isset($_GET['d'])) {
                        echo $_GET['d'];
                    } else {
                        echo '';
                    } ?>;
                    var fechaUnix = document.getElementById("fechaUnix").value;
                    xmlhttp.open("GET", "refreshChat.php?from=" + from + "&to=" + to + "&f" + fechaUnix, true);
                    xmlhttp.send();
                }
            }

            function insertReload() {

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("text").value = '';
                        var insertchat = JSON.parse(xmlhttp.responseText);
                        document.getElementById("ul").innerHTML += insertchat['chat'];
                        document.getElementById("fechaUnix").value = insertchat['fechaUnix'];
                        var elem = document.getElementById('ul');
                        elem.scrollTop = elem.scrollHeight;
                    }
                }
                var texto = document.getElementById("text").value;
                var from = <?php echo $codUsuario ?>;
                var to = <?php if (isset($_GET['d'])) {
                    echo $_GET['d'];
                } else {
                    echo '';
                } ?> ;
                var fechaUnix = document.getElementById("fechaUnix").value;

                xmlhttp.open("GET", "insertreload.php?texto=" + texto + "&from=" + from + "&to=" + to + "&f=" + fechaUnix, true);
                xmlhttp.send();
            }
        </script>
        <title>
            Chat META
        </title>
        <style>
            /* width */
            ::-webkit-scrollbar {
                width: 20px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px grey;
                border-radius: 10px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #0000EE;
                border-radius: 10px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: black;
            }
        </style>
    </head>

<?php
require 'header.php';
?>
<div class='container'
     style="background-color: lightgrey; padding-top: 70px; padding-bottom: 70px; height: 100%; max-width:100%; overflow:auto;">
    <div class="row">
        <div class="col-md-4" style="text-align:center;">
            <br><br><br><br><br><br><br><br><br><br><br>
            Todos los destinatarios <br>
            <?php
            $destinatarios = allUsuarios($codUsuario);
            while ($destinatario = $destinatarios->fetch_assoc()) { ?>
                <a href="chat.php?d=<?php echo $destinatario['codigo']; ?> "><?php
                    if ((isset($_GET['d'])) && ($destinatario['codigo'] == $_GET['d'])) {
                        echo "<strong>" . $destinatario['nombre'] . ' ' . $destinatario['apellido1'] . "</strong>";
                    } else {
                        echo $destinatario['nombre'] . ' ' . $destinatario['apellido1'];
                    }
                    ?></a>
                <br>
            <?php } ?>
        </div>
        <div class="col-md-8" style="max-height=10%;">
            <?php if ((!isset($_GET['d'])) || (!is_numeric($_GET['d']))){
                echo "<h1>Selecciona un destinatario para empezar a chatear</h1>";
            } else {
            $destinatario = $_GET['d'];
            echo "<ul id='ul' style='list-style: none; height:700px; width: 90%; overflow:auto;' >";
            $mensajes = recuperarMensajesChat($codUsuario, $destinatario);
            $fechaUnix = '';
            while ($mensaje = $mensajes->fetch_assoc()) {
                $texto = $mensaje['texto'];
                $from = $mensaje['remitente'];
                $to = $mensaje['codUsuarioTo'];
                $fecha = $mensaje['fecha'];
                $fechaprint = substr($fecha, 11, 5);
                $fechaUnix = $mensaje['fechaUnix'];
                if ($from == $codUsuario) {
                    $id = "id='foru' style= 'text-align:right; margin-bottom:5%; background-color:lightgreen; border-radius: 25px; padding:10px;'";
                } else {
                    $id = "id='forme' style='text-align:left; margin-bottom:5%;background-color:white; border-radius: 25px;padding:10px;'";
                }
                ?>
                <div class="row" style="margin-right:20%;">
                    <div class="col-md-12 overflow_auto" style='word-wrap:break-word;'>
                        <li<?php echo " $id " ?>><?php echo $texto ?><br><span
                                    id='span'><?php echo $fechaprint; ?></span></li>
                    </div>
                </div>
            <?php }
            echo "</ul>"; ?>

            <div id="textbox">
                <input type="hidden" id='fechaUnix' value="<?php echo $fechaUnix ?>">
                <form name="msg" onsubmit="return false">
                    <input type="text" id="text" name="text" style="width:80%;">
                    <input type="submit" value="Enviar" onclick="insertReload();">
                </form>
            </div>
        </div>


        <?php } ?>


    </div>
<?php require 'footer.php';
