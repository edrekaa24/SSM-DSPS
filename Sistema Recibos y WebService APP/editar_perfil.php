<?php
include 'conexion.php';
session_start();
$rfc=$_SESSION['rfc'];
$nombre=$_SESSION['nombre'];
    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //dentro del echo -> <script language="javascript">alert("Sesion iniciada");</script>
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else
    header('Location: ../index.php');

$sql="SELECT * FROM EMPLEADOS WHERE AFILIACION = '".$rfc."'";
$stmt = mssql_query( $sql, $link);
if( !mssql_num_rows($stmt)) {
    die( print_r( mssql_errors(), true) );
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Editar Perfil</title>
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

	
	jQuery('.taglist .close').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
	
});
</script>
</head>

<body>

<div class="mainwrapper">
    
   <?php
    include 'header.php';
    include 'left_panel.php';

    ?>
    
    
    
    <div class="rightpanel">
        <?php
        include 'breadcrumbs.php';
        ?>
        
       
        <div class="pageheader">
            
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>SSM - SERVICIOS DE SALUD MORELOS</h5>
                <h1>Perfil</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            <div class="maincontentinner">

                <?php



                    while( $row = mssql_fetch_array( $stmt, MSSQL_BOTH) ) {
                          
                          $curp=$row['CURP'];
                          $email=str_replace(' ', '',$row['correo']);
                          $name=$row['NOMBRES'];
                          $ap_pat=$row['AP_PATERNO'];
                          $ap_mat=$row['AP_MATERNO'];
                          $calle=str_replace(' ', '',$row['CALLE']);
                          $num=str_replace(' ', '',$row['num']);
                          $colonia=str_replace(' ', '',$row['COLONIA']);
                          $deleg=str_replace(' ', '',$row['DELEGACION']);
                          $stado=str_replace(' ', '',$row['ESTADO']);
                          $cp=str_replace(' ', '',$row['CODPOS']);
                          $tel=str_replace(' ', '',$row['telefono']);
                      }

                ?>




                <div class="row-fluid">
                    	<div class="span4 profile-left">
                        <div class="widgetbox profile-photo">
                            <div class="headtitle">

                                <!--
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn dropdown-toggle">Accion <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Cambiar Foto</a></li>
                                      <li><a href="#">Borrar Foto</a></li>
                                    </ul>
                                </div>
                                -->
                                
                                <h4 class="widgettitle">Foto de Perfil</h4>
                            </div>
                            <div class="widgetcontent">
                                <div class="profilethumb">
                                    <img src="images/perfil.png" alt="" class="img-polaroid" />
                                </div><!--profilethumb-->
                            </div>
                        </div>
                        </div><!--span4-->
                        <div class="span8">
                            <form action="actualizar.php" class="editprofileform" method="get" name="f1">
                                
                                <div class="widgetbox login-information">
                                    <h4 class="widgettitle">Información de Usuario</h4>
                                    <div class="widgetcontent">
                                        <p>
                                            <label>RFC:</label>
                                            <input type="text" name="rfc" class="input-xlarge" value="<?php echo $rfc; ?>" readonly/>
                                        </p>
                                        <p>
                                            <label>CURP:</label>
                                            <input type="text" name="curp" class="input-xlarge" value="<?php echo $curp; ?>" readonly />
                                        </p>
                                        <p>
                                            <label>Correo Electrónico:</label>
                                            <input type="email" name="email" class="input-xlarge" value="<?php echo $email; ?>" />
                                        </p>
                                        <p>
                                            <label>Nueva Contraseña:</label>
                                            <input type="password" name="nva_psw" class="input-xlarge"/>
                                        </p>
                                        <p>
                                            <label>Confirmar Contraseña:</label>
                                            <input type="password" name="nva_psw2" class="input-xlarge" onblur="comprobarClave();"/>
                                        </p>
                                    </div>
                                </div>
                                
                                
                                <div class="widgetbox personal-information">
                                    <h4 class="widgettitle">Información Personal</h4>
                                    <div class="widgetcontent">
                                        <p>
                                            <label>Nombre(s):</label>
                                            <input type="text" name="nombre" class="input-xlarge" value="<?php echo $name; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" />
                                        </p>
                                        <p>
                                            <label>Apellido Paterno:</label>
                                            <input type="text" name="ap_pat" class="input-xlarge" value="<?php echo $ap_pat; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Apellido Paterno ..."/>
                                        </p>
                                        <p>
                                            <label>Apellido Materno:</label>
                                            <input type="text" name="ap_mat" class="input-xlarge" value="<?php echo $ap_mat; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        </p>
                                        <p>
                                            <label>Calle:</label>
                                            <input type="text" name="calle" class="input-xlarge" value="<?php echo $calle; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        </p>
                                         <p>
                                            <label>Número:</label>
                                            <input type="text" name="num" class="input-xlarge" value="<?php echo $num; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        </p>
                                        <p>
                                            <label>Colonia:</label>
                                            <input type="text" name="colonia" class="input-xlarge" value="<?php echo $colonia; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        </p>
                                        <p>
                                            <label>Delegación o Municipio:</label>
                                            <input type="text" name="deleg" class="input-xlarge" value="<?php echo $deleg; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        </p>
                                        <p>
                                            <label>Estado:</label>
                                            <input type="text" name="stado" class="input-xlarge" value="<?php echo $stado; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly/>
                                        </p>
                                        <p>
                                            <label>Código Postal:</label>
                                            <input type="text" name="codpost" class="input-xlarge" value="<?php echo $cp; ?>" />
                                        </p>
                                        <p>
                                            <label>Teléfono:</label>
                                            <input type="text" name="tel" class="input-xlarge" value="<?php echo $tel; ?>" />
                                        </p>
                                    </div>
                                </div>
                                
                               <!--<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Notificaciones</h4>
                                    <div class="widgetcontent">
                                        <p>
                                            <input type="checkbox" /> Recibir noticias de la dependencia... <br />
                                            <input type="checkbox" /> Recibir Recibos de nómina...
                                        </p>
                                    </div>
                                </div>
                                -->
                                <p>
                                	<button type="submit" class="btn btn-primary" onclick="return confirm('Está a punto de actualizar su Información ¿Desea continuar?');">Actualizar Perfil</button> &nbsp; <a href="mailto:daniel.sanchez@ssm.gob.mx">Reportar un problema</a>
                                </p>
                                
                            </form>
                            <P>¨Tus datos personales serán protegidos de acuerdo a la Ley de Información Publica,
Estadística y Protección de datos personales del Estado de Morelos¨</P>
                        </div><!--span8-->
                    </div><!--row-fluid-->
                    
                    <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2018. <a href="http://www.ssm.gob.mx/portal/" target="_blank">SSM</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->

</body>
<script> 
function comprobarClave(){ 
    clave1 = document.f1.nva_psw.value 
    clave2 = document.f1.nva_psw2.value 

    if (clave1 != clave2) 
        
        alert("Las contraseñas no son iguales") 
} 
</script>
</html>
