<?php
include 'conexion.php';
mssql_select_db('SSMNOM', $link);
 //get search term
    if(!empty($_POST["keyword"])) {
    $rfc=$_POST["keyword"];
    

    $sql = "SELECT DISTINCT TOP 5 AFILIACION,AP_PATERNO,AP_MATERNO,NOMBRES  FROM EMPLEADOS WHERE AFILIACION LIKE '" . $rfc . "%'  ";
    

			$stmt = mssql_query($sql,$link);
			if( !mssql_num_rows($stmt)) {
    			   ?>                       
                    <h3>Sin resultados</h3>                   
                    <?php 
			}
                                        ?>
                                        <ul id="rfc-list">
                                        <?php
									while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {
                                        
                                        $rfc_result=$row['AFILIACION'];
                                        $a_paterno=utf8_encode($row['AP_PATERNO']);
                                        $a_materno=utf8_encode($row['AP_MATERNO']);
                                        $nombres=utf8_encode($row['NOMBRES']);
                                        ?>
                                            
                                        <li onClick="selectrfc('<?php echo $rfc_result; ?>');"><?php echo $rfc_result; ?> -- <?php echo $a_paterno; ?><?php echo $a_materno; ?><?php echo $nombres; ?></li>
                                        
                                        
                                        <?php 
                                        }
                                        ?>
                                        </ul>
    <?php 
    }
    ?>

