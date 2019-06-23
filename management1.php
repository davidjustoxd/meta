<?php
require 'sesion.php';
require 'conexion.php';
require 'functions.php';
require 'data.php';
?>
    <html>
<head>
    <title>
        ADMIN
    </title>
</head>
<?php
require 'header.php'; ?>
<div class='container'
     style="background-color: lightgrey; padding-top: 150px; padding-bottom: 70px; height: 100%; max-width:100% !important;">
    <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-6" style="text-align: center; position:absolute; top:15%; left:22%;">
            <h1>
                Promocionar a Jefe de Personal
            </h1>
            <select class="form-control" style="width:40% !important; position:absolute; left:30%;">
                <option value="volvo">--</option>
                <option value="saab">Diego Faria</option>
            </select>
                <input type="submit" value="Promocionar" name="submit" style=" position:absolute; left:59.5%; top:180%;">
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <div class="usuario" style="background-color: lightgrey; width:40% !important; position:absolute; left:33%; top:40%;">

        <h1> Añadir usuario</h1>
        <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
            Nombre de usuario <input type="text" size="30" name="newpwd"></br>
             <br>
            Contraseña(jose.souto.2106)<input type="password" size="22" name="newpwd2"></br>
            <input type="submit" value="Crear" name="submit">
        </form>
    </div>
    <div >
        <h1> Confirmar ajustes horarios</h1>
        <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
            Usuario: <select class="form-control" style="width:10% !important; ">
                <option value="volvo">--</option>
                <option value="David Justo">David Justo</option>
            </select><br>
            Concepto: <br> <strong>Me gustaría tomarme el día para asuntos propios; <br>necesito resolver problemas médicos con un familiar.</strong><br><br>
            Número de horas: <strong>8</strong><br><br>
            <input type="submit" value="Confirmar" name="submit">
            <input type="submit" value="Denegar" name="submit">
        </form>
    </div>
    <div style="position:absolute; right:5%; top:15%;">
        <h1> Aplicar descuento horario</h1>
        <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
            Aplicar a <select class="form-control" style="width:40% !important; ">
                <option value="volvo">--</option>
                <option value="David Justo">Todos</option>
                <option value="David Justo">Usuario específico</option>
            </select>
        </form>
        <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
            Usuario <select class="form-control" style="width:40% !important; ">
                <option value="volvo">--</option>
                <option value="David Justo">David Justo</option>
                <option value="David Justo">Usuario específico</option>
            </select> <br>
            Número de horas: <input type="number" style="width:8%;"><br><br>
            Fecha: <input id="date" type="date"><br><br>
            Motivo(opcional): <br> <strong>Haremos puente con el festivo del jueves para tener el viernes libre</strong><br><br>
            <input type="submit" value="Aplicar descuento" name="submit">
        </form>
    </div>
<?php require 'footer.php';




