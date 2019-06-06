<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
    <head>
        <title>
            Gestión empresarial META
        </title>
    </head>
<body>
<?php
require 'header.php';
?>
    <div id="body">
        <div id="left">
            <h1>Fichajes</h1>
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
                        <td <?php if ($fila['accion'] == 'Trabajando') {
                            echo "style='color:green'";
                        } elseif ($fila['accion'] == 'Fuera') {
                            echo "style='color:red'";
                        } elseif ($fila['accion'] == 'Pausa') {
                            echo "style='color:yellow'";
                        } ?>
                        >
                            <?php echo $fila['accion'] ?></td>
                        <td><?php echo $fila['fechaAccion'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div id="right">
            <h1> Tu estado:
                <?php $estadofichaje = getEstadoFichaje($codUsuario);
                if ($fila = $estadofichaje->fetch_assoc()) {
                    $estadofichaje = $fila['codAccion'];
                    switch ($estadofichaje) {
                        case 1:
                            echo " Trabajando</h1>";
                            echo $e1;
                            break;
                        case 2:
                            echo " En el descanso</h1>";
                            echo $e2;
                            break;
                        case 3:
                            echo " Fuera</h1>";
                            echo $e3;
                            break;
                    }
                }

                ?>

        </div>
    </div>
<?php include 'footer.php';