<?php
include("conexion.php");
mssql_select_db('SSMNOM', $link);
session_start();
$cvemot=$_GET['cvemot'];
$motivo=$_GET['motivo'];
$box=$_GET['box'];
$vigencia=$_GET['vigencia'];
$id_totxper=$_GET['id_totxper'];
$qna_canc=$_GET['qna_canc'];
$rfc=$_GET['rfc'];
$nombre=$_SESSION['nombre'];
$id_usuario=$_SESSION['id_usuario'];
$fecha = date("Y-m-d"); 

$stado='N'.$cvemot;


$sql="UPDATE TOTXPER SET STADO='$stado', QNA_CANC='$qna_canc' WHERE ID LIKE '".$id_totxper."'";

$sql2 = "INSERT INTO Cancelaciones(id_totxper,motivo,vigencia,box,fecha,usuario)
VALUES ('$id_totxper','$motivo','$vigencia','$box','$fecha','$id_usuario')";

$result = mssql_query($sql,$link)or die('Error querying MSSQL TOTXPER');
if ($result!=NULL) {


$result2 = mssql_query($sql2,$link)or die('Error querying MSSQL Cancelaciones');

if ($result2!=NULL) {
echo "<script type=\"text/javascript\">alert('Guardado');window.location='cancelaciones.php';</script>";
}
}

else {
    echo "Error: en el sistema";
}

mssql_close($link); 

?>


