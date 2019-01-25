<?php
include 'conexion.php';
session_start();
$rfc=$_SESSION['rfc'];
$nombre=$_SESSION['nombre'];

    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else
   header('Location: ../');

$stado=$_SESSION['stado'];
if ($stado==1) {

$sql = "SELECT a.QUINCENA,a.ANO,a.PERCEPCIONES,a.DEDUCCIONES,a.fecha_pago,a.archivo_pdf,B.ARCHIVO_XML FROM TOTXPER A inner JOIN TIMBRES B 
ON A.ANO=B.ANO AND A.QUINCENA=B.QUINCENA and a.nomprod=b.nomprod and a.REFERENCIA=b.REFERENCIA and A.EMPLEADO=B.EMPLEADO AND A.CHEQUE=B.CHEQUE
WHERE A.STADO='A' AND a.EMPLEADO = '".$rfc."'  ORDER BY ANO DESC , QUINCENA DESC";//a.ano=2018
$stmt = mssql_query( $sql, $link);
if( !mssql_num_rows($stmt)) {
    die( print_r( mssql_errors(), true) );
}
    
    

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Recíbos</title>
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
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
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
</style>
<script> 
window.defaultStatus="Descargar"; 
function ini() { 
anclas=document.getElementsByTagName("a"); 
for (i=0;i<anclas.length;i++) 
    anclas.item(i).onmouseover=new Function("window.status='Descargar';return true");  
} 
</script> 
</head>

<body onLoad="ini()">

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
                <h1>Historial de Recibos de Nómina</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            
            <div class="maincontentinner">

                <h2>Resultado:</h2>
                <?php
                if(empty($rfc))
                {
                    echo "Error en el Sistema";
                    ?>
                           <h4><b>RFC:</b><?php echo $rfc;?></h4>

                       <?php

                          echo "<h4>No se encontrarón datos del trabajador.</h4>";
                }
                 else{


                 ?>    

                            <h4><b>RFC:        </b><?php echo $rfc;?></h4>
                            <h4><b>Nombre(s):        </b><?php echo $nombre;?></h4><br/><br/> 

                            <h3>Lista de recibos</h3>
                            <div style="overflow-x:auto;">
                            <TABLE id="t01">
                          
                            <TR>
                                <TH align="center">QUINCENA</TH> 
                                <TH align="center">FECHA DE PAGO</TH> 
                                <TH align="center">Percepciones</TH> 
                                <TH align="center">Deducciones</TH> 
                                <TH align="center">Total</TH> 
                                <TH align="center">Descargar</TH> 
                            </TR>
                <?php



                    while( $row = mssql_fetch_array( $stmt, MSSQL_BOTH) ) {
                          
                          $quincena=$row['QUINCENA'];
                          $ano=$row['ANO'];
                          $percepciones=$row['PERCEPCIONES'];
                          $deducciones=$row['DEDUCCIONES'];
                          $total=$percepciones-$deducciones;
                          $pdf=$row['archivo_pdf'];
                          $xml=$row['ARCHIVO_XML'];
                          $a=substr($pdf,16, 1);
                          
                          
                          $pdf2=substr($pdf, 23, -1);
                          $xml2=substr($xml, 21, -1);
                          $pdf3 = str_replace("\\", "/", $pdf2);
                          $xml3 = str_replace("\\", "/", $xml2);

                          $pdf4 = "G:/XML_DSP_CFDI/CFDI/$pdf3";
                          $xml4 = "G:/Respaldos/XML Y PDF/xml/$xml3";
                      
                          if(empty($pdf)){
                          	// Pendiente.. no se encontró recibo
                          }
                            else{
                          

                ?>
                            <TR>
                            <td><?php echo $quincena." - ".$ano;?></td>
                            <td><?php echo $row['fecha_pago']?></td>
                            <td><?php echo $percepciones;?></td>
                            <td><?php echo $deducciones;?></td>
                            <td><?php echo $total;?></td>
                            <td> <a href="download-recibo.php?activo=2&pdf=<?php echo $pdf4;?>&xml=<?php echo $xml4;?>&qna=<?php echo $quincena;?>&ano=<?php echo $ano;?>" > <img src="images/zip.png" style="width:52px;height:42px;border:0;"></a></td>
                            <!--<a href="<?php//echo $xml;?>"> <img src="images/xml.png" style="width:42px;height:42px;border:0;"></a>-->
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

<?php
}
else
   header('Location: editar_perfil.php');
?>
