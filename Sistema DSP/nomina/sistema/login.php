<?php
session_start();
ob_start(); 
//Recibimos los valores que intrujo el usuario desde el formulario.
$USUARIO= $_GET["usuario"];
$CLAVE = $_GET["clave"];
//$curp = $_POST["password"];
//Creamos la conexión a la BD


include("conexion.php");
//Escribimos la sentencia SQL que ejecutaremos.
$sql = "SELECT * FROM SSMNOM.DBO.USUARIOS WHERE SSMNOM.DBO.USUARIOS.usuario='".$USUARIO."' AND SSMNOM.DBO.USUARIOS.clave = '".$CLAVE."'";
//$sql = "SELECT * FROM USUARIOS WHERE usuario='".$USUARIO."' AND clave = '".$CLAVE."'";

//Ejecutamos la sentencia SQL
$stmt = mssql_query($sql,$link);
if( !mssql_num_rows($stmt)) {
   echo "<script type=\"text/javascript\">alert('Usuario Desconocido'); window.location='index.php';</script>";
}


while (($row = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
    $id_usuario=$row['id_usuario'];
    $nombre=utf8_encode($row['nombre']);
    $nivel=$row['nivel'];
    $depto=utf8_encode($row['departamento']);
}
    //Contamos el numero de filas que arroja la sentencia SQL
    //Solo arrojará el "id_usuario" en caso de que los datos introducidos por el usuario sean correctos
    //Por tanto arrojará mas de -0- filas y eso nos indicará que los datos son correctos

if (empty($nivel)){ 
    echo "<script type=\"text/javascript\">alert('Usuario Desconocido'); window.location='index.php';</script>";
    }
else{
    
    //Asignamos a una variable lo que llevará por -valor- la cookie
    $id_usuario = $id_usuario;
    $_SESSION["k_username"]= $id_usuario;
    $_SESSION['nombre']= $nombre;
    $_SESSION['id_usuario']= $id_usuario;
    $_SESSION['nivel']= $nivel;
    $_SESSION['depto']= $depto;
    //Establecemos la cookie para matener la sesión abierta.
    setcookie("misitio_userid","$id_usuario",time() + 365 * 24 * 60 * 60);
    //hacemos la redirección al archivo que evalua si se inicio sesión o no.
if ($nivel==1 || $nivel==2)
{
    header("Location:dashboard.php");
}
else{
header("Location:noticias.php");
}
    
}


mssql_close($link); 

?>