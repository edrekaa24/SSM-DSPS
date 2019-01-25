<!DOCTYPE html>
<html>
<head>
  <title>Productos</title>
</head>
<body>

<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$server = '192.168.42.25\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, 'Daniel', 'daniel2018');
mssql_select_db('SSMNOM', $link);

if (!$link) {
    die('Algo fue mal mientras se conectaba a MSSQL');
}



$query="SELECT DISTINCT UNIDAD from TOTXPER WHERE  QUINCENA='5' AND ANO='2018' order by UNIDAD";
$run = mssql_query($query,$link);
while (($result = mssql_fetch_array($run, MSSQL_BOTH))) {
                          
                        
                        $unidad=$result['UNIDAD'];?>
                        <table>
                        <TR>
                        
                        <td><?php echo $unidad;?></td>
                        <td> <a href="prod.php?unidad=<?php echo $unidad;?>">Ver</a></td>
                        </TR>
                        </table>
 <?php

     }

?>
</body>
</html>