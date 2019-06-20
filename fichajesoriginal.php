<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
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
    <div  style="background-color: lightgrey; padding-top: 5%; padding-bottom: 70px;">
        <div class="container" style="height:100% !important; overflow:auto;">
            <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3" style="text-align:center; font-weight: bold;">Fecha</div>
                    <div class="col-md-3" style="text-align:center; font-weight: bold;">Acción</div>

                </div>
            <?php $registros = allFichajesUsuario($codUsuario);
            while ($registro = $registros->fetch_assoc()) { ?>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3" style="text-align:center;"><?php echo $registro['fechaAccion'] ?></div>
                <div class="col-md-3" style="text-align:center;"><?php echo $registro['accion'] ?></div>
            </div>
            <?php } ?>

    </div>
<?php include 'footer.php';?>
