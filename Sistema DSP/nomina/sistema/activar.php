<?php
include("conexion.php");
mssql_select_db('SSMNOM', $link);
session_start();
$cve=$_POST['Activador'];
if ($cve=='') {
	$cve=0;
}

$sql="UPDATE USUARIOS SET app='$cve' WHERE id_usuario=2";


$result = mssql_query($sql,$link)or die('Error querying MSSQL TOTXPER');

if ($result!=NULL) {
if ($cve==1) {
echo "<script type=\"text/javascript\">alert('Cancelaciones Activas');window.location='cancelaciones.php';</script>";
}
if ($cve==0) {
echo "<script type=\"text/javascript\">alert('Cancelaciones Inactivas');window.location='cancelaciones.php';</script>";
}
}


else {
    echo "Error: en el sistema";
}

mssql_close($link); 

?>


