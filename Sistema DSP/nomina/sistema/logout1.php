
<?php
session_start();
//Vaciamos la sesi�n
$_SESSION = array();
//Borramos cada cookie que tengamos
setcookie("misitio_userid",time() + 365 * 24 * 60 * 60);
//Destruimos la sesi�n
session_destroy();
//Redirigimos hacia la pagina index.php
header ("Location: index.php"); 

?>
