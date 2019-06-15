<?php

function datosFichajesAll($exclude = 0)
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


function actualizarEstadoFichaje($codUsuario, $codAccion)
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

function recuperarMensajesChat($codFrom, $codTo)
{
    global $con;
    $sql = "SELECT CodUsuarioFrom AS 'remitente', texto, codUsuarioTo, fecha, UNIX_TIMESTAMP(fecha) AS 'fechaUnix'
            FROM chat
            WHERE (codUsuarioFrom=$codFrom
            AND codUsuarioTo=$codTo)
            OR (codUsuarioFrom=$codTo
            AND codUsuarioTo=$codFrom)
            ORDER BY fecha ASC ";
    $filas = $con->query($sql);
    return $filas;

}

function insertarMensajeChat($texto, $from, $to)
{
    global $con;
    $sql = "INSERT INTO chat (codUsuarioFrom,texto,codUsuarioTo)
            VALUES($from,'$texto',$to)";
    $filas = $con->query($sql);
}

function recuperarUltimosChats($codFrom, $codTo, $fecha)
{
    global $con;
    $sql = "SELECT CodUsuarioFrom AS 'remitente', texto, codUsuarioTo, fecha, UNIX_TIMESTAMP(fecha) AS 'fechaUnix'
            FROM chat 
            WHERE ((codUsuarioFrom=$codFrom
            AND codUsuarioTo=$codTo)
            OR (codUsuarioFrom=$codTo
            AND codUsuarioTo=$codFrom))
            AND UNIX_TIMESTAMP(fecha) > $fecha 
            ORDER BY fecha ASC";
    $filas = $con->query($sql);
    return $filas;

}

function contarChats($codFrom, $codTo)
{
    global $con;
    $sql = "SELECT COUNT(*) AS 'nMensajes'
            FROM chat 
            WHERE (codUsuarioFrom=$codFrom
            AND codUsuarioTo=$codTo)
            OR (codUsuarioFrom=$codTo
            AND codUsuarioTo=$codFrom)";
    $filas = $con->query($sql);
    return $filas;

}


function sumaTiempoSemana($usuario)
{
    global $con;
    $sql = "SET @email_list = 0;";
    $tiempo = $con->query($sql);
    $sql = "CALL lista_entradas_semana(@email_list, $usuario);";
    $tiempo = $con->query($sql);
    $sql = "SELECT @email_list AS 'tiempo_unix'";
    $tiempo = $con->query($sql);
    while ($a = $tiempo->fetch_assoc()) {
        $tiempo1 = $a['tiempo_unix'];
    }


    // SABER SI EL TRABAJADOR ESTÁ DENTRO
    $sql = "SELECT MAX(unix_timestamp(fechaAccion)) as 'last'
 FROM fichajes 
 WHERE codUsuario=$usuario
 AND codAccion !=1 
 AND fechaAccion > 
	(SELECT MAX(fechaAccion) 
	FROM fichajes 
	WHERE codUsuario=$usuario 
	AND codAccion=1)";
    $tiempoHastaNow = $con->query($sql);
    while ($ultimo = $tiempoHastaNow->fetch_assoc()) {
        // TESTEAR CON is_null
        if ($ultimo['last'] == null) {
            $estaDentro = 1;
        } else {
            $estaDentro = 0;
        }
    }

// SI NO ESTÁ DENTRO, SABER LA FECHA DE ULTIMO LOGIN
    $tiempoUltimoLogin = 0;
    if ($estaDentro == 1) {
        $sql = "SELECT MAX(unix_timestamp(fechaAccion)) as 'ultimoLogin'
 FROM fichajes 
 WHERE codUsuario=$usuario
 AND codAccion =1";
        $ultimoLogin = $con->query($sql);
        while ($ultimo = $ultimoLogin->fetch_assoc()) {
            $tiempoUltimoLogin = $ultimo['ultimoLogin'];
        }
    }

    $cut = time();
    if ($estaDentro == 1) {
        $tiempo2 = $cut - $tiempoUltimoLogin;
    } else {
        $tiempo2 = 0;
    }
    $tiempoTotal = $tiempo1 + $tiempo2;
    $horas = gmdate("H", $tiempoTotal);
    $minutos = gmdate("i", $tiempoTotal);
    $tiempoTotal = "Tiempo trabajado esta semana: <strong>" . $horas . "</strong>h" . " <strong>" . $minutos . "</strong>m" . " ";
    return $tiempoTotal;
}

function sumaTiempoDia($usuario){
    global $con;
    $sql="SET @email_list = 0;";
    $tiempo=$con->query($sql);
    $sql="CALL lista_entradas_dia(@email_list, $usuario);";
    $tiempo=$con->query($sql);
    $sql="SELECT @email_list AS 'tiempo_unix'";
    $tiempo=$con->query($sql);
    while ($a=$tiempo->fetch_assoc()){
        $tiempo1=$a['tiempo_unix'];
    }


    // SABER SI EL TRABAJADOR ESTÁ DENTRO
    $sql="SELECT MAX(unix_timestamp(fechaAccion)) as 'last'
 FROM fichajes 
 WHERE codUsuario=$usuario
 AND codAccion !=1 
 AND fechaAccion > 
	(SELECT MAX(fechaAccion) 
	FROM fichajes 
	WHERE codUsuario=$usuario 
	AND codAccion=1)";
    $tiempoHastaNow=$con->query($sql);
    while ($ultimo=$tiempoHastaNow->fetch_assoc()){
        // TESTEAR CON is_null
        if ($ultimo['last']==null){
            $estaDentro=1;
        }
        else{
            $estaDentro=0;
        }
    }

// SI ESTÁ DENTRO, SABER LA FECHA DE ULTIMO LOGIN
    $tiempoUltimoLogin=0;
    if ($estaDentro==1){
        $sql="SELECT MAX(unix_timestamp(fechaAccion)) as 'ultimoLogin'
 FROM fichajes 
 WHERE codUsuario=$usuario
 AND codAccion =1";
        $ultimoLogin=$con->query($sql);
        while ($ultimo=$ultimoLogin->fetch_assoc()){
            $tiempoUltimoLogin=$ultimo['ultimoLogin'];
        }
    }

    $cut=time();
    if ($estaDentro==1 ){
        $tiempo2=$cut - $tiempoUltimoLogin ; }
    else {
        $tiempo2=0 ;
    }
    $tiempoTotal=$tiempo1 + $tiempo2;
    $horas=gmdate("H", $tiempoTotal);
    $minutos=gmdate("i",$tiempoTotal);
    $tiempoTotal= "Tiempo trabajado hoy: <strong>". $horas ."</strong>h". " <strong>". $minutos . "</strong>m" ." ";
    return $tiempoTotal;
}
function CalcularTiempoRestanteSemana($usuario){
    $horasTotal=40;
    $str = sumaTiempoSemana($usuario);
    $str = preg_replace('/\D/', '', $str);
    $horas=substr($str, 0, 2);
    $minutos=substr($str,3,2);
    $segundosHoras=$horas * 60 * 60;
    $segundosMinutos=$minutos * 60 ;
    $segundosTrabajados=$segundosHoras + $segundosMinutos;
    $segundosTotales=$horasTotal*60*60;
    $segundosRestantes=$segundosTotales - $segundosTrabajados;
    $horas=gmdate("H", $segundosRestantes);
    $minutos=gmdate("i",$segundosRestantes);
    $tiempoRestante="Esta semana te quedan: <strong>" . $horas ."</strong> h". " <strong>". $minutos . "</strong>m";
    return $tiempoRestante;


}