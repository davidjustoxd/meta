<?php

function datosFichajesAll($exclude=0)
{
    require 'conexion.php';
    $sql = "SELECT u.nombre AS 'nombre',u.apellido1 AS 'apellido', a.accion AS 'accion', f1.fechaAccion AS 'fechaAccion' 
            FROM fichajes f1 
				INNER JOIN usuarios u 
            ON u.codigo=f1.codUsuario
            INNER JOIN acciones a
            ON a.codAccion=f1.codAccion
            WHERE f1.fechaAccion = (SELECT MAX(f2.fechaAccion)
                                        FROM fichajes f2
                                        WHERE f1.codUsuario = f2.codUsuario)
            AND codUsuario!=$exclude
            ORDER BY u.apellido1 ASC";
    $filas = $con->query($sql);
    return $filas;
}