<?php
include 'conexion.php';

$rfc=$_GET['rfc'];
$email=$_GET['email'];
$psw=$_GET['nva_psw2'];
$nombre=$_GET['nombre'];
$ap_pat=$_GET['ap_pat'];
$ap_mat=$_GET['ap_mat'];
$calle=$_GET['calle'];
$num=$_GET['num'];
$colonia=$_GET['colonia'];
$deleg=$_GET['deleg'];
$stado=$_GET['stado'];
$cp=$_GET['codpost'];
$tel=$_GET['tel'];

if (empty($psw)) {
  $sql="UPDATE EMPLEADOS SET correo='$email', NOMBRES='$nombre', AP_PATERNO='$ap_pat', AP_MATERNO='$ap_mat', CALLE='$calle', num='$num', COLONIA='$colonia', DELEGACION='$deleg', CODPOS='$cp', telefono='$tel', stado_sis='1' WHERE AFILIACION='$rfc'";
$stmt = mssql_query( $sql, $link);

header( 'Location: dashboard.php' ) ;

}

else{

$sql="UPDATE EMPLEADOS SET correo='$email', password='$psw', NOMBRES='$nombre', AP_PATERNO='$ap_pat', AP_MATERNO='$ap_mat', CALLE='$calle', num='$num', COLONIA='$colonia', DELEGACION='$deleg', CODPOS='cp', telefono='$tel', stado_sis='1' WHERE AFILIACION='$rfc'";
$stmt = mssql_query( $sql, $link);

header( 'Location: dashboard.php' ) ;
}

?>