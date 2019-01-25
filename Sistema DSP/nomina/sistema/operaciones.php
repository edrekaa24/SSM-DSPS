<?php
$sql = "SELECT * FROM TOTXPER WHERE EMPLEADO LIKE '".$rfc."' AND STADO LIKE 'A'";//a.ano=2018

$stmt = mssql_query($sql,$link);
if( !mssql_num_rows($stmt)) {
    die( print_r( mssql_errors(), true) );
}


$stmt2 = mssql_query($sql,$link);
if( !mssql_num_rows($stmt2)) {
    die( print_r( mssql_errors(), true) );
}



?>
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
                                        
                                        $nombre=$datos['NOMBRES'];
                                        $ap_pat=$datos['AP_PATERNO'];
                                        $ap_mat=$datos['AP_MATERNO'];
                                        $nombre=$nombre." ".$ap_pat." ".$ap_mat;
                                        $puesto=$datos['PUESTO'];
                                        $curp=$datos['CURP'];
                                        $cve_centro=$datos['CENTRO'];
                                        $centro=$datos['CRESPDES'];


                                    ?>
                                <h4><b>Nombre(s):        </b><?php echo $nombre;?></h4>
                                <h4><b>CURP:        </b><?php echo $curp;?></h4>
                                <h4><b>PUESTO:        </b><?php echo $puesto;?></h4>
                                <h4><b>CLAVE CTRO TRABAJO:        </b><?php echo $cve_centro;?></h4>
                                <h4><b>CENTRO DE TRABAJO:        </b><?php echo $centro;?></h4><br/><br/>


                             <?php
                             break;
                                }
                            ?>
                            

                            <h3>Datos Plazas</h3>
                            <TABLE id="t01">
                          
                            <TR> 
                                <TH align="center">NÓMINA</TH>
                                <TH align="center">UR</TH>
                                <TH align="center">PLAZA</TH>
                                <TH align="center">PERCEPCIONES</TH>
                                <TH align="center">DEDUCCIONES</TH>
                                <TH align="center">NETO</TH>
                                <TH align="center">TIPO DE PAGO</TH>
                                <TH align="center">AÑO</TH>
                                <TH align="center">QUINCENA</TH>
                                <TH align="center">VER</TH>
                            </TR>
                <?php



                    while (($row = mssql_fetch_array($stmt2, MSSQL_BOTH))) {
                          
                          $plaza=$row['ACTIVIDAD'].$row['PROGRAMA'].$row['PROYECTO'].$row['PARTIDA'].$row['PUESTO'].$row['NUMPUES'].$row['GRUPO'].$row['FUNCION'].$row['SUBFUNCION'];
                          $nomina=$row['REFERENCIA'];
                          $ur=$row['UNIDAD'];
                          $percepciones=$row['PERCEPCIONES'];
                          $deducciones=$row['DEDUCCIONES'];
                          $neto=$percepciones-$deducciones;
                          $tipo_pagp=$row['NOMPROD'];
                          $ano=$row['ANO'];
                          $quincena=$row['QUINCENA'];
                          
                          

                          if(empty($plaza)){
                          }
                            else{
                          

                ?>
                            <TR>
                            <td><?php echo $nomina;?></td>
                            <td><?php echo $ur;?></td>
                            <td><?php echo $plaza;?></td>
                            <td><?php echo $percepciones;?></td>
                            <td><?php echo $deducciones;?></td>
                            <td><?php echo $neto;?></td>
                            <td><?php echo $tipo_pagp;?></td>
                            <td><?php echo $ano;?></td>
                            <td><?php echo $quincena;?></td>
                             <td> <a href="nomina3.php?rfc=<?php echo $rfc;?>&quincena=<?php echo $quincena;?>&ano=<?php echo $ano;?>"> <img src="images/eye.png" style="width:22px;height:22px;border:0;"></a></td>
                            </TR>  
                            <?php
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
                        <span>&copy; 2018. <a href="http://www.ssm.gob.mx/portal/" target="_blank">SSM</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->