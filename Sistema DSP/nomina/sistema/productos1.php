<!DOCTYPE html>
<html>
<head>
  <title>Productos</title>
</head>
<body>

<?php
include 'conexion.php';


$query="SELECT DISTINCT UNIDAD from TOTXPER WHERE  QUINCENA='5' AND ANO='2018' order by UNIDAD";
$run = mssql_query($query,$link);
while (($result = mssql_fetch_array($run, MSSQL_BOTH))) {
                          
                        
                        $unidad=$result['UNIDAD'];?>
                        <table>
                        <TR>
                        
                        <td><?php echo $unidad;?></td>
                        </TR>
                        </table>
 <?php

      }
      ?>

</body>
</html>