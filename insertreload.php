<?php
//https://www.youtube.com/watch?v=wMlLgYyz_ws
//https://www.youtube.com/watch?v=oIVI1qYx87E
require 'sesion.php';
if ((!isset($_GET['texto'])) || (!isset($_GET['from'])) || (!isset($_GET['to']))){
    header ('Location:cerrarSesion.php');
    die ("No deberías ver nunca esto");
}
require 'conexion.php';
require 'functions.php';
$texto=strip_tags($con -> real_escape_string($_GET['texto']));
$from=strip_tags($con -> real_escape_string($_GET['from']));
$to=strip_tags($con -> real_escape_string($_GET['to']));
insertarMensajeChat($texto,$from,$to);

$response = "<?php if (!isset(\$_GET\[\'d\'\])) {
    echo \"<h1>Selecciona un destinatario para empezar a chatear</h1>\";
} else {
    \$destinatario = \$_GET\[\'d\'\];
    \$mensajes = recuperarMensajesChat(\$codUsuario, \$destinatario);
    while (\$mensaje = \$mensajes->fetch_assoc()) {
        \$texto = \$mensaje\[\'texto\'\];
        \$from = \$mensaje\[\'codUsuarioFrom\'\];
        \$to = \$mensaje\[\'codUsuarioTo\'\];
        \$fecha = \$mensaje\[\'fecha\'\];
        \$fechaprint = substr(\$fecha, 11, 5);
        if (\$from == \$codUsuario) {
            \$id = \"id=\'foru\'\";
        } else {
            \$id = \"id=\'forme\'\";
        }
        ?>
        <div id=\"msg\"><p<?php echo \" \$id\" ?>><?php echo \$texto ?><br><?php echo \$fechaprint; ?></p></div>


    <?php } ?>
    <div id=\"textbox\">
        <form name=\"msg\" onsubmit=\"return false\">
            <input type=\"text\" id=\"text\" name=\"text\">
            <input type=\"submit\" value=\"Enviar\" onclick=\"nuevoChat()\">
        </form>
    </div>


<?php } ?>";
$json['chat']=$response;
echo json_encode($json);