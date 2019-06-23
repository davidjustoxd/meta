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
            <div class="col-md-6 form-group">
            <h3>Mes</h3>
                <select class="form-control" style="width:40% !important;">
                    <option value="volvo">--</option>
                    <option value="saab">Enero</option>
                    <option value="saab">Febrero</option>
                    <option value="saab">Marzo</option>
                    <option value="saab">Abril</option>
                    <option value="saab">Mayo</option>
                    <option value="saab">Junio</option>
                    <option value="saab">Julio</option>
                    <option value="saab">Agosto</option>
                    <option value="saab">Septiembre</option>
                    <option value="saab">Octubre</option>
                    <option value="saab">Noviembre</option>
                    <option value="saab">Diciembre</option>
                </select>
                <br>
                <h3>Día</h3>
                <input type="number" class="form-control" style="width:40% !important;">
        </div>
            <div class="col-md-6" >
                <table width="100%" style="position:relative; top:30%;">
                    <tr >
                        <td align="center"><h4>HORA</h4></td>
                        <td align="center"><h4>ACCION</h4></td>
                    </tr>
                </table>
                <br>
                <table width="100%" style="position:relative; top:40%; left:10%;">
                    <tr>
                        <td align="center"><h4>11:02</h4></td>
                        <td align="center"><h4>ENTRO A TRABAJAR</h4></td>
                    </tr>
                    <tr>
                        <td align="center"><h4>14:00</h4></td>
                    <td align="center"><h4>PAUSA</h4></td>
                    </tr>
                    <tr>
                        <td align="center"><h4>15:30</h4></td>
                        <td align="center"><h4>ENTRO A TRABAJAR</h4></td>
                    </tr>
                        <td align="center"><h4>20:30</h4></td>
                    <td align="center"><h4>ME VOY</h4></td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br><br><br><br><br><br>
        <h4 style="text-align: center;"> Tiempo trabajado hoy: 7 <strong>h</strong> 58 <strong>m</strong></h4>
        <h5 style="text-align:center;"><a href="">Exportar mes a PDF</a></h5>


    </div>
<?php include 'footer.php';?>
<?php
