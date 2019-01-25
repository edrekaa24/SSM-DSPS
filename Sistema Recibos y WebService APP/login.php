<?php

session_start();

//Recibimos los valores que intrujo el usuario desde el formulario.
$usr= $_POST["rfc"];
$pass=$_POST["password"];

//$curp = $_POST["password"];
//Creamos la conexión a la BD

include("conexion.php");
//Escribimos la sentencia SQL que ejecutaremos.
$sql = "SELECT * FROM EMPLEADOS WHERE AFILIACION='".$usr."' AND password = '".$pass."'";

//Ejecutamos la sentencia SQL
$stmt = mssql_query($sql,$link);
if(mssql_num_rows($stmt)<1) {
   echo "<script type=\"text/javascript\">alert('Usuario  o Contraseña Incorrectos $usr,$pass'); window.location='index.php';</script>";
}


while (($row = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
    $id_usuario=$row['AFILIACION'];
    $ap_pat=utf8_encode($row['AP_PATERNO']);
    $ap_mat=utf8_encode($row['AP_MATERNO']);
    $nombres=utf8_encode($row['NOMBRES']);
    $nombre=$ap_pat.' '.$ap_mat.' '.$nombres;
    $stado=$row['stado_sis'];
}
    //Contamos el numero de filas que arroja la sentencia SQL
    //Solo arrojará el "id_usuario" en caso de que los datos introducidos por el usuario sean correctos
    //Por tanto arrojará mas de -0- filas y eso nos indicará que los datos son correctos

if (empty($id_usuario)){ 
    echo "<script type=\"text/javascript\">alert('ESTADO=$stado'); window.location='index.php';</script>";
    }
else{
    
    //Asignamos a una variable lo que llevará por -valor- la cookie
    $id_usuario = $id_usuario;
    $_SESSION["k_username"]= $id_usuario;
    $_SESSION['nombre']= $nombre;
    $_SESSION['id_usuario']= $id_usuario;
    $_SESSION['stado']= $stado;
    $_SESSION['rfc']= $id_usuario;
    $_SESSION['iave']= $pass;
    //Establecemos la cookie para matener la sesión abierta.
     setcookie("misitio_userid","$id_usuario",time() + 365 * 24 * 60 * 60);

    //hacemos la redirección al archivo que evalua si se inicio sesión o no.
if ($stado==1)
{
    header("Location:dashboard.php");
}
else{
    echo "<script type=\"text/javascript\">alert('Es necesario actualizar tus datos para poder descargar los CFDI, gracias.');</script>";
header("Location:editar_perfil.php");
}
    
}


mssql_close($link); 

?>