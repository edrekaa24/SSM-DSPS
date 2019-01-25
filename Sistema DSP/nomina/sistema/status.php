<?php
include 'conexion.php';
$sql_activo="SELECT app FROM USUARIOS WHERE id_usuario like 2";
$stmt5=mssql_query($sql_activo,$link);
while (($act = mssql_fetch_array($stmt5, MSSQL_BOTH))) {
    $activo=$act['app'];
}
mssql_free_result($stmt5);

?>


