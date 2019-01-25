<?php  
session_start();
ob_start(); 
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

</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img style="width:250px; height:auto;" src="images/logo.png" alt="SSM" /></div>
        
        <form id="login" action="login.php" method="get">

            <div class="inputwrapper login-alert">
                <div class="alert alert-error">RFC</div>
            </div>

            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="usuario" id="usuario" placeholder="USUARIO" maxlength="15" required/>
            </div>
            
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="clave" id="clave" placeholder="CLAVE" maxlength="15" required/>
            </div>
            
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Entrar</button>
            </div>
            
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2019 - Desarrollado por L.I. Daniel Sánchez Valle</p>

</div>

</body>
</html>
