<?php
$servidorBD = 'localhost';
$usuarioBD = 'meta';
$paswordBD = 'abc123.';
$bd = 'meta';
$con = new mysqli($servidorBD, $usuarioBD, $paswordBD, $bd);
if ($con->connect_error)
die('Problemas conectando con la BD<br>' . $con->connect_error);
$con->set_charset('utf8');
