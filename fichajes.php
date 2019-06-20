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
        </div>
            <div class="col-md-6" >
                <table width="100%" style="position:relative; top:30%;">
                    <tr >
                        <td align="center"><h4>L</h4></td>
                        <td align="center"><h4>M</h4></td>
                        <td align="center"><h4>X</h4></td>
                        <td align="center"><h4>J</h4></td>
                        <td align="center"><h4>V</h4></td>
                        <td align="center"><h4>S</h4></td>
                        <td align="center"><h4>D</h4></td>
                    </tr>
                </table>
                <table width="100%" style="position:relative; top:40%;">
                    <tr>
                        <td align="center"><h4>27</h4></td>
                        <td align="center"><h4>28</h4></td>
                        <td align="center"><h4>29</h4></td>
                        <td align="center"><h4>30</h4></td>
                        <td align="center"><h4>31</h4></td>
                        <td align="center"><a href=""><h4>1</h4></a></td>
                        <td align="center"><a href=""><h4>2</h4></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href=""><h4>3</h4></a></td>
                        <td align="center"><a href=""><h4>4</h4></a></td>
                        <td align="center"><a href=""><h4>5</h4></a></td>
                        <td align="center"><a href=""><h4>6</h4></a></td>
                        <td align="center"><a href=""><h4>7</h4></a></td>
                        <td align="center"><a href=""><h4>8</h4></a></td>
                        <td align="center"><a href=""><h4>9</h4></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href=""><h4>10</h4></a></td>
                        <td align="center"><a href=""><h4>11</h4></a></td>
                        <td align="center"><a href=""><h4>12</h4></a></td>
                        <td align="center"><a href=""><h4>13</h4></a></td>
                        <td align="center"><a href=""><h4>14</h4></a></td>
                        <td align="center"><a href=""><h4>15</h4></a></td>
                        <td align="center"><a href=""><h4>16</h4></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href=""><h4>17</h4></a></td>
                        <td align="center"><a href=""><h4>18</h4></a></td>
                        <td align="center"><a href=""><h4>19</h4></a></td>
                        <td align="center"><a href=""><h4>20</h4></a></td>
                        <td align="center"><a href=""><h4>21</h4></a></td>
                        <td align="center"><a href=""><h4>22</h4></a></td>
                        <td align="center"><a href=""><h4>23</h4></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href=""><h4>24</h4></a></td>
                        <td align="center"><a href=""><h4>25</h4></a></td>
                        <td align="center"><a href=""><h4>26</h4></a></td>
                        <td align="center"><a href=""><h4>27</h4></a></td>
                        <td align="center"><a href=""><h4>28</h4></a></td>
                        <td align="center"><a href=""><h4>29</h4></a></td>
                        <td align="center"><a href=""><h4>30</h4></a></td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
<?php include 'footer.php';?>
<?php
