<?php
header("Content-type: text/html; charset=utf8"); 

$psw=substr( md5(microtime()), 1, 8);
ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $from = "sist_del_pago@ssm.gob.mx";
            $to = "daniel.sanchez@ssm.gob.mx";
            $subject = "Usuario y contraseña SSM - CFDI";
            $message = "Usuario y contraseña de acceso al sistema SSM - CFDI"."\n"."Usuario: RFC"."\n"."Contraseña: $psw"."\n"."\n"."Recuerda que al ingresar por primera vez al sistema deberás cambiar tu contraseña y rellenar o actualizar tus datos."."\n"."\n"."Departamento de Sistematización del Pago"."\n"."";
            $headers = "From:" . $from;
			$subject= utf8_decode($subject);
			$message= utf8_decode($message);

            mail($to,$subject,$message, $headers);
             echo "<script type=\"text/javascript\">alert('Se ha enviado tu contraseña por correo electrónico, gracias.');</script>";
?>