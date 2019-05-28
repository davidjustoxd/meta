<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
    <head>
        <title>
            Chat META
        </title>
    </head>
<body>
<?php
require 'header.php';
?>
    <div id="allUsuarios">
        Todos los destinatarios <br>
        <?php
        $destinatarios = allUsuarios($codUsuario);
        while ($destinatario = $destinatarios->fetch_assoc()) { ?>
            <a href="chat.php?d=<?php echo $destinatario['codigo'] ?>"><?php echo $destinatario['nombre'] . ' ' . $destinatario['apellido1'] ?></a>
            <br>
        <?php } ?>
    </div>
    <div id="contMensajesChat">
        <?php if (!isset($_GET['d'])) {
            echo "<h1>Selecciona un destinatario para empezar a chatear</h1>";
        } else {
            $destinatario = $_GET['d'];
            $mensajes = recuperarMensajesChat($codUsuario, $destinatario);
            while ($mensaje = $mensajes->fetch_assoc()) {
                $texto=$mensaje['texto'];
                $from=$mensaje['codUsuarioFrom'];
                $to=$mensaje['codUsuarioTo'];
                $fecha=$mensaje['fecha'];
                $fechaprint=substr($fecha, 11,5);
                if ($from==$codUsuario){
                    $id="id='foru'";
                }
                else {
                    $id="id='forme'";
                }
                ?>
                <div id="msg"><p<?php echo " $id"?>><?php echo $texto?><br><?php echo $fechaprint;?></p></div>


            <?php }
        } ?>


    </div>
<?php require 'footer.php';
