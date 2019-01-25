
<?php
session_start();
//Vaciamos la sesión
$_SESSION = array();
//Borramos cada cookie que tengamos
setcookie("misitio_userid",time() + 365 * 24 * 60 * 60);
//Destruimos la sesión
session_destroy();
//Redirigimos hacia la pagina index.php
header ("Location: index.php"); 

?>
