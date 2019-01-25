<?php
include 'conexion.php';
session_start();

$rfc=$_GET['rfc'];
$tipo=$_GET['tipo'];
$quincena=$_GET['quincena'];
$ano=$_GET['ano'];
$nombre=$_SESSION['nombre'];

    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if ($nombre==NULL) {
    header('Location:index.php');
}

if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //dentro del echo -> <script language="javascript">alert("Sesion iniciada");</script>
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else
    header('Location:index.php');

$sql = "SELECT DISTINCT MOVXPER.*, CONCEPTOS.DESCRIPCIO FROM MOVXPER,CONCEPTOS WHERE MOVXPER.EMPLEADO='".$rfc."' AND MOVXPER.QUINCENA='".$quincena."' AND MOVXPER.ANO='".$ano."' AND MOVXPER.NOMPROD ='".$tipo."' AND MOVXPER.TIPO=1 AND MOVXPER.CONCEPTO=CONCEPTOS.CLAVE AND MOVXPER.ANTECEDENTE=CONCEPTOS.ANTECEDE;";

$stmt = mssql_query($sql,$link);



$sql2 = "SELECT DISTINCT MOVXPER.*, CONCEPTOS.DESCRIPCIO FROM MOVXPER,CONCEPTOS WHERE MOVXPER.EMPLEADO='".$rfc."' AND MOVXPER.QUINCENA='".$quincena."' AND MOVXPER.ANO='".$ano."' AND MOVXPER.NOMPROD ='".$tipo."' AND MOVXPER.TIPO!=1 AND MOVXPER.CONCEPTO=CONCEPTOS.CLAVE AND MOVXPER.ANTECEDENTE=CONCEPTOS.ANTECEDE;";
$stmt2 = mssql_query($sql2,$link);

    
    

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Historial de Nómina</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />

<link rel="stylesheet" href="css/responsive-tables.css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<style>
table {
    width:300px;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th{
    padding: 5px;
    text-align: center;
}
td {
    padding: 5px;
    text-align: right;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th    {
    background-color: #333333;
    color: white;
}
div#tabla_uno{
width:300px;
position:relative;
float: left;
height: auto;
margin-right: 10px;
}
div#tabla_dos{
width:300px;
position:relative;
float: left;
height: auto;
}
</style>
</head>

<body>

<div class="mainwrapper">
    
    <?php
    include 'header.php';
    include 'left_panel.php';

    ?>
    
    
    
    <div class="rightpanel">
        <?php
        include 'breadcrumbs.php';
        ?>
        
        <div class="pageheader">
            
            <div class="pageicon"><span class="iconfa-file"></span></div>
            <div class="pagetitle">
                <h5>SSM SERVICIOS DE SALUD MORELOS</h5>
                <h1>Historial de Nómina</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            
            <div class="maincontentinner">

                <h2>Resultado:</h2>
                <?php
               if( !mssql_num_rows($stmt2))
                {
                    echo "Error en el Sistema";
                    ?>
                           <h4><b>RFC:</b><?php echo $rfc;?></h4>

                       <?php

                          echo "<h4>Este pago no es de tipo ORDINARIO.</h4>";
                }
                 else{


                 ?>    

                            <h4><b>RFC:        </b><?php echo $rfc;?></h4>
                            

                            <h3>Datos Plazas</h3>

                            <div id="tabla_uno">
                            <TABLE id="t01">
                          
                            <TR> 
                                <TH colspan="3">PERCEPCIONES</TH>        
                            </TR>
                            <TR> 
                                <TH>CONCEPTO</TH>
                                <TH>DESCRIPCIÓN</TH>
                                <TH>IMPORTE</TH>          
                            </TR>
                <?php



                    while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {
                          
                          $concepto=$row['CONCEPTO'];
                          $descripcion=$row['DESCRIPCIO'];
                          $importe=$row['IMPORTE'];
                          

                          if(empty($concepto)){
                          }
                            else{
                          

                ?>
                            <TR>
                            <td><?php echo $concepto;?></td>
                            <td><?php echo $descripcion;?></td>
                            <td><?php echo $importe;?></td>
                            </TR>  
                            <?php
                            }
                            }
                            ?>                          
                        </TABLE>  
                        </div>
                        


                         <div id="tabla_dos">
                            <TABLE id="t01">
                          
                            <TR> 
                                <TH colspan="3">DEDUCCIONES</TH>           
                            </TR>
                            <TR> 
                                <TH>CONCEPTO</TH>
                                <TH>DESCRIPCIÓN</TH>
                                <TH>IMPORTE</TH>          
                            </TR>
                <?php



                    while (($row2 = mssql_fetch_array($stmt2, MSSQL_BOTH))) {
                          
                          $concepto=$row2['CONCEPTO'];
                          $descripcion=$row2['DESCRIPCIO'];
                          $importe=$row2['IMPORTE'];
                          

                          if(empty($concepto)){
                          }
                            else{
                          

                ?>
                            <TR>
                            <td><?php echo $concepto;?></td>
                            <td><?php echo $descripcion;?></td>
                            <td><?php echo $importe;?></td>
                            </TR>  
                            <?php
                            }
                            }
                            ?>                          
                        </TABLE>  
                        </div>
                        <br>
                        <br>
                   
                    
                     <?php
                       
                }
                    mssql_free_result($stmt);
                    mssql_close($link); 

                ?>    

            </div>
        </div>

                        
                               
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2018. <a href="http://www.ssm.gob.mx/portal/" target="_blank">SSM</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        
      // simple chart
        var flash = [[0, 11], [1, 9], [2,12], [3, 8], [4, 7], [5, 3], [6, 1]];
        var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
      var css3 = [[0, 6], [1, 1], [2,9], [3, 12], [4, 10], [5, 12], [6, 11]];
            
        function showTooltip(x, y, contents) {
            jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5
            }).appendTo("body").fadeIn(200);
        }
    
            
        var plot = jQuery.plot(jQuery("#chartplace"),
               [ { data: flash, label: "Flash(x)", color: "#6fad04"},
              { data: html5, label: "HTML5(x)", color: "#06c"},
              { data: css3, label: "CSS3", color: "#666"} ], {
                   series: {
                       lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
                       points: { show: true }
                   },
                   legend: { position: 'nw'},
                   grid: { hoverable: true, clickable: true, borderColor: '#666', borderWidth: 2, labelMargin: 10 },
                   yaxis: { min: 0, max: 15 }
                 });
        
        var previousPoint = null;
        jQuery("#chartplace").bind("plothover", function (event, pos, item) {
            jQuery("#x").text(pos.x.toFixed(2));
            jQuery("#y").text(pos.y.toFixed(2));
            
            if(item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                        
                    jQuery("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);
                        
                    showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + x + " = " + y);
                }
            
            } else {
               jQuery("#tooltip").remove();
               previousPoint = null;            
            }
        
        });
        
        jQuery("#chartplace").bind("plotclick", function (event, pos, item) {
            if (item) {
                jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });
    
        
        //datepicker
        jQuery('#datepicker').datepicker();
        
        // tabbed widget
        jQuery('.tabbedwidget').tabs();
        
        
    
    });
</script>
</body>
</html>




 