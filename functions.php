<?php

function datosFichajesAll($exclude=0)
{
    global $con;
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


function getEstadoFichaje($codUsuario)
{
    global $con;
    $sql = "SELECT codAccion
            FROM fichajes f1 
            WHERE f1.fechaAccion = (SELECT MAX(f2.fechaAccion)
                                        FROM fichajes f2
                                        WHERE f1.codUsuario = f2.codUsuario)
            AND codUsuario=$codUsuario";

    $filas = $con->query($sql);
    return $filas;
}


function actualizarEstadoFichaje($codUsuario,$codAccion)
{
    global $con;
    $sql = "INSERT INTO fichajes (codUsuario,codAccion)
            VALUES ($codUsuario,$codAccion)";
    $con->query($sql);
}

function allFichajesUsuario($codUsuario)
{
    global $con;
    $sql = "SELECT a.accion AS 'accion', f.fechaAccion AS 'fechaAccion'
FROM fichajes f
	INNER JOIN acciones a 
	ON f.codAccion=a.codAccion
WHERE codUsuario=$codUsuario ORDER BY fechaAccion DESC ";
    $filas = $con->query($sql);
    return $filas;
}

function allUsuarios($codUsuario)
{
    global $con;
    $sql = "SELECT *
            FROM usuarios
            WHERE codigo !=$codUsuario 
            ORDER BY nombre DESC ";
    $filas = $con->query($sql);
    return $filas;
}

function recuperarMensajesChat($codFrom,$codTo){
    global $con;
    $sql = "SELECT *
            FROM chat
            WHERE (codUsuarioFrom=$codFrom
            AND codUsuarioTo=$codTo)
            OR (codUsuarioFrom=$codTo
            AND codUsuarioTo=$codFrom)
            ORDER BY fecha ASC ";
    $filas = $con->query($sql);
    return $filas;

}