<?php  
session_start();

if (isset($_SESSION["k_username"])) {

header("Location:dashboard.php"); // Aquí te pongo un header para redireccionar pero puedes usar javascript o cualquier otro.

}
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>SERVICIOS DE SALUD MORELOS</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#username').val();
            
            if(u == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
<script src="js/sweetalert.min.js"></script>


</head>

<body class="loginpage">
<script>swal("Bienvenido a SSM - Nómina","Aquí podras descargar tu CFDI");</script>
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="images/logo.png" alt="SSM" /></div>

        <form id="login" action="login.php" method="post">

            <div class="inputwrapper login-alert">
                <div class="alert alert-error">RFC INVÁLIDO</div>
            </div>

            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="rfc" id="rfc" placeholder="USUARIO" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="13" required/>
            </div>
            
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="CONTRASEÑA" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="16" required/>
            </div>
            
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Entrar</button>
            </div>

            <div class="inputwrapper animate4 bounceIn">
                <a href="registrarse.php"><label>REGISTRARSE</label></a>-----------<a href="recuperar.php"><label>¿OLVIDÓ SU CONTRASEÑA?</label></a>
            </div>
            
        </form>

    </div><!--loginpanelinner-->

</div><!--loginpanel-->

<div class="loginfooter">
   <P>¨Tus datos personales serán protegidos de acuerdo a la <a href="http://www.transparenciamorelos.mx/sites/default/files/Ley%20de%20Información%20Pública%2C%20Estadística%20y%20Protección%20de%20Datos%20Personales%20del%20Estado%20de%20Morelos_6.pdf">Ley de Información Publica, Estadística y Protección de datos personales del Estado de Morelos</a>¨</P> <p>&copy; 2018 - Sistematización del Pago</p>

</div>

</body>
</html>
