<?php

//Recibimos los valores que intrujo el usuario desde el formulario.
$usr= $_POST["rfc"];


//$curp = $_POST["password"];
//Creamos la conexión a la BD

include("conexion.php");
//Escribimos la sentencia SQL que ejecutaremos.
$sql = "select afiliacion, email from EMPLEADOS where afiliacion=='".$usr."'";

//Ejecutamos la sentencia SQL
$stmt = mssql_query($sql,$link);
if(mssql_num_rows($stmt)<1) {
   echo "<script type=\"text/javascript\">alert('RFC No Encontrado!') window.location='index.php';</script>";
}


while (($row = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
    $id_usuario=$row['afiliacion'];
}


if (empty($id_usuario)){ 
    echo "<script type=\"text/javascript\">alert('RFC no existe en la base de datos, acude a tu oficina de recursos humanos y reportalo'); window.location='index.php';</script>";
    }



else{

    $sql2 = "select afiliacion, stado_sis from empleados where afiliacion='".$id_usuario."'";

        //Ejecutamos la sentencia SQL
        $stmt2 = mssql_query($sql2,$link);
        if(mssql_num_rows($stmt2)<1) {
           echo "<script type=\"text/javascript\">alert('Empleado no encontrado') window.location='index.php';</script>";
        }

        while (($row = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
            $stado_sis=$row['stado_sis'];
        }

        if ($stado_sis=1) {
            
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $from = "sist_del_pago@ssm.gob.mx";
            $to = "$email";
            $subject = "Usuario y contraseña SSM - CFDI";
            $message = "Usuario y contraseña de acceso al sistema SSM - CFDI"."\n"."Usuario: Tu RFC (13 Dígitos)"."\n"."Contraseña: $psw"."\n"."\n"."Recuerda que al ingresar por primera vez al sistema deberás cambiar tu contraseña y rellenar o actualizar tus datos."."\n"."\n"."Departamento de Sistematización del Pago"."\n"."";
            $headers = "From:" . $from;
            $subject= utf8_decode($subject);
            $message= utf8_decode($message);

            mail($to,$subject,$message, $headers);
            

            $sql="UPDATE EMPLEADOS SET password='$psw' WHERE afiliacion LIKE '".$id_usuario."'";
            $result = mssql_query($sql,$link)or die('Error querying MSSQL EMPLEADOS');

            if ($result!=NULL) {
                echo "<script type=\"text/javascript\">alert('Recuperacion de acceso exitoso! Se ha enviado tu contraseña por correo electrónico, si no lo encuentras en tu buzón, revisa los correos no deseados.');window.location='index.php';</script>";
            }
            else {
                 echo "<script type=\"text/javascript\">alert('Ocurrió un error en tu registro, comunicate o acude al Departamento de Sistematización del Pago');</script>";
            }

        }

        else{
             echo "<script type=\"text/javascript\">alert('Aún no te has registrado, realiza tu registro por favor.');window.location='registrarse.php';</script>";
        }
    
mssql_close($link); 

?>