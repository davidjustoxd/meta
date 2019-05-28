<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require'data.php';
?>
<html>
<head>
    <title>
        Fichajes
    </title>
</head>
<body>
<?php
require 'header.php';
?>
<div id="fichajes">
    <table>
        <th>Fecha</th>
        <th></th>
        <th></th>
        <th>Acción</th>
        <?php $registros=allFichajesUsuario($codUsuario);
        while ($registro = $registros->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $registro['fechaAccion']?></td>
                <td></td>
                <td></td>
                <td><?php echo $registro['accion']?></td>
            </tr>
            <?php } ?>
    </table>







</div>
<?php include 'footer.php';