<?php

include("status.php"); // Activar o desactivar las cancelaciones en Cancelacones.php
session_start();
$nivel=$_SESSION['nivel'];
//$activo=1;
?>
<div class="leftpanel">
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Menú</li>
<?php 
if ($nivel==1 || $nivel==2 || $nivel==9 || $nivel==10 || $nivel==11)
{
?>
                <li><a href="dashboard.php"><span class="iconfa-home"></span> Inicio</a></li>  
<?php
}
?>             
                <li><a href="noticias.php"><span class="iconfa-home"></span> Noticias</a></li>

				<!--<li><a href="#"><span class="iconfa-laptop"></span> Captura de FUMP</a></li>-->
<?php
if ($nivel<=4 || $nivel==9 || $nivel==6 || $nivel==8  || $nivel==10 || $nivel==11)
{
?>

                <li><a href="nomina.php"><span class="iconfa-laptop"></span> Historial de Nómina</a></li>
 <?php 
}

if ($activo==1){

    if ($nivel==3 || $nivel==6)
    {
?>
                <li><a href="cancelaciones.php"><span class="iconfa-laptop"></span> Cancelaciones</a></li>
<?php
    }

}

if ($nivel==1 || $nivel==2 || $nivel==9)
{
?>
                <li><a href="cancelaciones.php"><span class="iconfa-laptop"></span> Cancelaciones</a></li>
                <!--<li><a href="cancelaciones_ex.php"><span class="iconfa-laptop"></span> Cancelaciones (terceros)</a></li>-->
<?php
}
if ($nivel==1 || $nivel==2 || $nivel==4 || $nivel==5 || $nivel==9 || $nivel==6 || $nivel==7  || $nivel==10  || $nivel==11)
{
?>
               <!-- <li><a href="produ_nom.php"><span class="iconfa-laptop"></span> Poductos de Nómina</a></li>-->
                <li><a href="reportes.php"><span class="iconfa-laptop"></span> Reportes Quincenales</a></li>
<?php
}
if ($nivel==1 || $nivel==2 || $nivel==7  || $nivel==10)
{
?>
                <li><a href="terceros.php"><span class="iconfa-laptop"></span> Generar TERCEROS</a></li>
<?php
}
if ($nivel==1 || $nivel==2)
{
?>
                <li><a href="dsps.php"><span class="iconfa-laptop"></span> Control de DSP</a></li>
<?php
}
?>         
                <li><a href="logout1.php"><span class="iconfa-eject"></span> Salir del Sistema</a></li>   
          </ul>                   
        </div>
    </div>