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
    <div class='container' style="background-color: lightgrey; padding-top: 150px; padding-bottom: 70px; height: 100%; max-width:100% !important;">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Promocionar a Jefe de Personal
                </h1>
                <select class="form-control" style="width:40% !important;">
                    <option value="volvo">--</option>
                    <option value="saab">Diego Faria</option>
                </select><br>
                <input type="submit" value="Promocionar" name="submit"">
            </div>
            <div class="col-md-6" style="background-color: lightgrey;">
            <h1> Añadir usuario</h1>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                Nombre de usuario <br><input type="text" size="30" name="newpwd" class="form-control" style="width: 20% !important;"></br>
                <br>
                Contraseña(jose.souto.2106)<br><input type="password" size="22" name="newpwd2" class="form-control" style="width: 20% !important;"></br>
                <br><input type="submit" value="Crear" name="submit"><br>
            </form>
        </div>
        </div>
        <div class="row" style="background-color: lightgrey;">
        <div class="col-md-6">
            <h1> Confirmar ajustes horarios</h1>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                Usuario: <select class="form-control" style="width:25% !important; " class="form-control">
                    <option value="volvo">--</option>
                    <option value="David Justo">David Justo</option>
                </select><br>
                Concepto: <br> <strong>Me gustaría tomarme el día para asuntos propios; <br>necesito resolver problemas médicos con un familiar.</strong><br><br>
                Número de horas: <strong>8</strong><br><br>
                <input type="submit" value="Confirmar" name="submit">
                <input type="submit" value="Denegar" name="submit">
            </form>
        </div>
            <div class="col-md-6" >
            <h1> Aplicar descuento horario</h1>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                Aplicar a <select class="form-control" style="width: 30% !important;">
                    <option value="volvo">--</option>
                    <option value="David Justo">Todos</option>
                    <option value="David Justo">Usuario específico</option>
                </select>
            </form>
            <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                Usuario <select class="form-control" style="width: 30% !important;">
                    <option value="volvo">--</option>
                    <option value="David Justo">David Justo</option>
                    <option value="David Justo">Usuario específico</option>
                </select> <br>
                Número de horas:<br> <input type="number" style="width: 8% !important;"><br><br>
                Fecha: <br><br><input id="date" type="date"><br><br>
                Motivo(opcional): <br> <strong>Haremos puente con el festivo del jueves para tener el viernes libre</strong><br><br>
                <input type="submit" value="Aplicar descuento" name="submit">
            </form>
        </div>
        </div>
        <div class="row" style="background-color: lightgrey; margin-bottom:20% !important;">
            <div class="col-md-6">
                <h1> Confirmar vacaciones</h1>
                <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
                    Usuario: <select class="form-control" style="width:20% !important; " class="form-control">
                        <option value="volvo">--</option>
                        <option value="David Justo">David Justo</option>
                    </select><br>
                    Fecha de inicio: <br> <strong>01/07/2019</strong><br><br>
                    Fecha de fin: <br> <strong>14/07/2019</strong><br><br>
                    Número de días <br> <strong>15</strong><br><br>
                    <input type="submit" value="Aceptar" name="submit">
                    <input type="submit" value="Rechazar" name="submit">
                </form>
            </div>
<?php require 'footer.php';





