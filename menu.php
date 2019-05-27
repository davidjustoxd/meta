<?php
include 'sesion.php';
include 'conexion.php';
include 'functions.php'
?>
    <html>
    <head>
        <title>
            Gestión empresarial META
        </title>
    </head>
<body>
<?php
include 'header.php';
?>
    <h1>Fichajes</h1>
    <div id="left">
        <table>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Estado</th>
            <th>Fecha</th>
            <?php
            $filas = datosFichajesAll();
            while ($fila = $filas->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['nombre'] ?></td>
                    <td><?php echo $fila['apellido'] ?></td>
                    <td><?php echo $fila['accion'] ?></td>
                    <td><?php echo $fila['fechaAccion'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>


</body><?php include 'footer.php';