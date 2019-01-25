<?php
include 'conexion.php';
mssql_select_db('SSMNOM', $link);
session_start();
$nivel=$_SESSION['nivel'];
$rfc=$_GET['rfc'];
$nombre=$_SESSION['nombre'];
$depto=$_SESSION['depto'];
$numrfc=strlen($rfc);

if ($nombre==NULL) {
    header('Location:index.php');
}



if ($numrfc!=13) {
echo "<script type=\"text/javascript\">alert('RFC INCOMPLETO');window.location='cancelaciones.php';</script>";
}
    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else{
   header('Location: ../');
}

//$sql = "SELECT * FROM TOTXPER WHERE EMPLEADO LIKE '".$rfc."' AND STADO LIKE 'A'";//a.ano=2018
$sql = "SELECT TOTXPER.*, Nomina.nomina FROM TOTXPER,Nomina WHERE EMPLEADO LIKE '".$rfc."' and nomina.siglas=TOTXPER.ref_nom and TOTXPER.TIPAG<>0 ORDER BY ANO DESC , QUINCENA DESC";

$stmt = mssql_query($sql,$link);
if(mssql_num_rows($stmt)<1) {
   echo "<script type=\"text/javascript\">alert('DATOS NO ENCONTRADOS DE: $rfc'); window.location='nomina.php';</script>";
}


$stmt2 = mssql_query($sql,$link);
if( !mssql_num_rows($stmt2)) {
    die( print_r( mssql_errors(), true) );
}

    
    

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Nómina</title>
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
#t01 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#t01 td, #t01 th {
    border: 1px solid #ddd;
    padding: 8px;
}

#t01 tr:nth-child(even){background-color: #E7E7E8;}

#t01 tr:hover {background-color: #D6F4FF;}

#t01 th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #0866c6;
    color: white;
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
                <h1>Cancelaciones de Nómina</h1>
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

                            <?php
                            
                            while (($datos = mssql_fetch_array($stmt, MSSQL_BOTH))) {
                                        
                                        $nombre=utf8_encode($datos['NOMBRES']);
                                        $ap_pat=utf8_encode($datos['AP_PATERNO']);
                                        $ap_mat=utf8_encode($datos['AP_MATERNO']);
                                        $nombre_emp=$nombre." ".$ap_pat." ".$ap_mat;
                                        $puesto=$datos['PUESTO'];
                                        $curp=$datos['CURP'];
                                        $cve_centro=$datos['CENTRO'];
                                        $centro=$datos['CRESPDES'];
                                        $nomina=$datos['nomina'];
                                        $cuenta=$datos['CUENTA'];


                                    ?>
                                <h4><b>Nombre(s):               </b><?php echo $nombre_emp;?></h4>
                                <h4><b>CURP:                    </b><?php echo $curp;?></h4>
                                <h4><b>PUESTO:                  </b><?php echo $puesto;?></h4>
                                <h4><b>CLAVE CTRO TRABAJO:      </b><?php echo $cve_centro;?></h4>
                                <h4><b>CENTRO DE TRABAJO:       </b><?php echo $centro;?></h4>
                                <h4><b>NOMINA:                  </b><?php echo $nomina;?></h4>
                                <h4><b>CUENTA:                  </b><?php echo $cuenta;?></h4><br/><br/>


                             <?php
                             break;
                                }
                            ?>
                            

                            <h3>Datos Plazas</h3>
                            <TABLE id="t01">
                          
                            <TR> 
                                <TH align="center">REF. PAGO</TH>
                                <TH align="center">NÓMINA</TH>
                                <TH align="center">UR</TH>
                                <TH align="center">PLAZA</TH>
                                <TH align="center">PERCEPCIONES</TH>
                                <TH align="center">DEDUCCIONES</TH>
                                <TH align="center">NETO</TH>
                                <TH align="center">NO. CHEQUE</TH>
                                <TH align="center">TIPO DE PAGO</TH>
                                <TH align="center">AÑO</TH>
                                <TH align="center">QUINCENA</TH>
                                <TH align="center">ESTADO</TH>
                                <TH align="center">EDITAR</TH>
                            </TR>
                <?php



                    while (($row = mssql_fetch_array($stmt2, MSSQL_BOTH))) {
                          $id_totxper=$row['ID'];
                          $GRUPO=$row['GRUPO'];
                            $GRUPO=str_replace(' ', '', $GRUPO);
                            $plaza=$row['UNIDAD'].$row['ACTIVIDAD'].$row['PROYECTO'].substr($row['PARTIDA'],0,4).$row['PUESTO'].'0'.$row['NUMPUES'].$GRUPO.$row['FUNCION'].$row['SUBFUNCION'];
                          //$plaza=$row['ACTIVIDAD'].$row['PROGRAMA'].$row['PROYECTO'].$row['PARTIDA'].$row['PUESTO'].$row['NUMPUES'].$row['GRUPO'].$row['FUNCION'].$row['SUBFUNCION'];
                          $referecia=$row['REFERENCIA'];
                          $nomina=$row['nomina'];
                          $ur=$row['UNIDAD'];
                          $percepciones=$row['PERCEPCIONES'];
                          $deducciones=$row['DEDUCCIONES'];
                          $neto=$percepciones-$deducciones;
                          $cheque=$row['CHEQUE'];
                          $tipo_pagp=$row['NOMPROD'];
                          $ano=$row['ANO'];
                          $quincena=$row['QUINCENA'];
                          $stado=$row['STADO'];

                          if($stado=='A   '){
                            $stat='PAGADO';
                          }
                          if($stado=='C   '){
                            $stat='CANCELADO';
                          }
                          if($stado=='P   '){
                            $stat='PENSION';
                          }
                          if($stado=='NA  '){
                            $stat='PENDIENTE';
                          }
                          if($stado=='NP  '){
                            $stat='PENDIENTE PENSION';
                          }
                          if(substr($stado, 0,1)=='C'){
                            $stat='CANCELADO';
                          }


                          //if($stado=='NC01' or $stado=='NC02' or $stado=='NC03' or $stado=='NC04' or $stado=='NC05' or $stado=='NC06' or $stado=='NC07' or $stado=='NC08' or $stado=='NC09' or $stado=='NC10' or $stado=='NC11' or $stado=='NC12' or $stado=='NC13' or $stado=='NC14' or $stado=='NC15' or $stado=='NC16' or $stado=='NC17' or $stado=='NC18' or $stado=='NC19' or $stado=='NC20' or $stado=='NC21'){
                          if(substr($stado, 0,2)=='NC'){
                            $stat='CANCELADO';
                          }


                          if(empty($plaza)){
                          }
                            else{
                          

                ?>
                            <TR>
                            <td><?php echo $referecia;?></td>
                            <td><?php echo $nomina;?></td>
                            <td><?php echo $ur;?></td>
                            <td><?php echo $plaza;?></td>
                            <td><?php echo '$ '.$percepciones;?></td>
                            <td><?php echo '$ '.$deducciones;?></td>
                            <td><?php echo '$ '.$neto;?></td>
                            <td><?php echo $cheque;?></td>
                            <td><?php echo $tipo_pagp;?></td>
                            <td><?php echo $ano;?></td>
                            <td><?php echo $quincena;?></td>
                            <td><?php echo $stat;?></td>
                             <?php
                             if ($nivel==3 || $nivel==6 || $nivel==9)
                            { 
                             if($stado=='NA  '){
                            ?>
                            
                             <td> <a href="cancelaciones3.php?id_totxper=<?php echo $id_totxper;?>&stado=<?php echo $stado;?>&rfc=<?php echo $rfc;?>&ano=<?php echo $ano;?>&qna=<?php echo $quincena;?>"> <img src="images/edit.png" style="width:20px;height:20px;border:0;"></a></td>
                             <?php
                             }
                              if($stado=='NP  '){
                            ?>
                            
                             <td> <a href="cancelaciones3.php?id_totxper=<?php echo $id_totxper;?>&stado=<?php echo $stado;?>&rfc=<?php echo $rfc;?>&ano=<?php echo $ano;?>&qna=<?php echo $quincena;?>"> <img src="images/edit.png" style="width:20px;height:20px;border:0;"></a></td>
                             <?php
                             }
                              if($stado=='A   ' OR $stado=='P   ' OR $stado=='C   ' OR substr($stado, 0,2)=='NC' OR substr($stado, 0,1)=='C'){                             
                              ?>
                             <td><img src="images/edit2.png" style="width:20px;height:20px;border:0;"></a></td>
                             <?php
                             }
                             ?>
                            </TR>  
                            <?php
                            }
                            if ($nivel==1 || $nivel==2)
                            { 
                            ?>
                             <td> <a href="cancelaciones3.php?id_totxper=<?php echo $id_totxper;?>&stado=<?php echo $stado;?>&rfc=<?php echo $rfc;?>&ano=<?php echo $ano;?>&qna=<?php echo $quincena;?>"> <img src="images/edit.png" style="width:20px;height:20px;border:0;"></a></td>
                             <?php
                             }
                            
                            }
                            }
                            ?>                          
                        </TABLE>  
                        <br>
                        <br>
                   
                    
                     <?php
                       
                }
                    mssql_free_result($stmt);
                    mssql_free_result($stmt2);
                    mssql_close($link); 

                ?>    

            

                        
                               
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2018. <a href="http://www.ssm.gob.mx/portal/" target="_blank">SSM</a> - Desarrollado por L.I. Daniel Sánchez Valle</span>
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