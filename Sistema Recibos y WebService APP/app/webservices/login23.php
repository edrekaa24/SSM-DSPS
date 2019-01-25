<?php header('Access-Control-Allow-Origin: *'); ?>
<?php header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); ?>
<?php header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT'); ?>


<?php
header('Content-type: application/json');
$USUARIO= $_REQUEST["username"];
$CLAVE = $_REQUEST["password"];

if ($USUARIO=='a' && $CLAVE=='a') {
	/* Output header */
	
echo json_encode("success");
}
else
	/* Output header */
	
echo json_encode("fail");
?>
