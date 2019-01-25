<?php
include 'conexion.php';

session_start();

$id_totxper=$_GET['id_totxper'];
$stado=$_GET['stado'];
$rfc=$_GET['rfc'];

$nombre=$_SESSION['nombre'];
$depto=$_SESSION['depto'];
$id_usuario=$_SESSION['id_usuario'];

if ($nombre==NULL) {
    header('Location:index.php');
}

    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //dentro del echo -> <script language="javascript">alert("Sesion iniciada");</script>
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else
    header('Location:index.php');    

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Nómina</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />

<link rel="stylesheet" href="css/responsive-tables.css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
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
            
            <div class="pageicon"><span class="iconfa-file"></span></div>
            <div class="pagetitle">
                <h5>SSM SERVICIOS DE SALUD MORELOS</h5>
                <h1>Cancelacion de Nómina</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            
            <div class="maincontentinner">

                <h2>Resultado:</h2>    

                            <h4><b>RFC:        </b><?php echo $rfc;?></h4><br>
                            

                            <h3>Cancelación</h3>
                            <form  name="form_evento" method="GET" action="cancelar_pago.php">

                                <script type="text/javascript">

                                    // funcion que se ejecuta cada vez que se selecciona una opción

                                    function cambioOpciones()
                                    {
                                        var combo = document.getElementById("cvemot");
                                        document.getElementById('motivo').value=combo.options[combo.selectedIndex].text;
                                    }

                                </script>

                                <h4>Motivo:</h4>
                                <select name="cvemot" id="cvemot" required onchange='cambioOpciones();'>
                                    <option value="">Seleccione</option>
                                    <option value="C01">(C01) BAJA POR DEFUNCION</option> 
                                    <option value="C02">(C02) BAJA POR RENUNCIA</option> 
                                    <option value="C03">(C03) BAJA POR JUBILACION</option> 
                                    <option value="C04">(C04) BAJA POR ABANDONO DE EMPLEO</option> 
                                    <option value="C05">(C05) LICENCIA SIN SUELDO MAYOR A 15 DIAS</option> 
                                    <option value="C06">(C06) CAMBIO DE ADSCRIPCION</option> 
                                    <option value="C07">(C07) CAMBIO DE RADICACION</option> 
                                    <option value="C08">(C08) TERMINO DE INTERINATO</option> 
                                    <option value="C09">(C09) PAGO INDEBIDO</option> 
                                    <option value="C10">(C10) POR ORDEN SUPERIOR</option> 
                                    <option value="C11">(C11) NO RECLAMADO</option>
                                    <option value="C12">(C12) BAJA POR INCUMPLIMIENTO A LA NORMA TÉCNICA DE ENSEÑANZA</option> 
                                    <option value="C13">(C13) LICENCIA POR OCUPAR PUESTO DE CONFIANZA</option> 
                                    <option value="C14">(C14) LICENCIA POR ASUNTOS PARTICULARES</option> 
                                    <option value="C15">(C15) SUSPENSION PREVENTIVA</option> 
                                    <option value="C16">(C16) LICENCIA SIN SUELDO POR CARGO DE ELECCIÓN POPULAR</option> 
                                    <option value="C17">(C17) BAJA DE PENSION ALIMENTICIA</option> 
                                    <option value="C18">(C18) ALTA DE PENSION ALIMENTICIA</option> 
                                    <option value="C19">(C19) BAJA POR TERMINO DE NOMBRAMIENTO</option> 
                                    <option value="C20">(C20) BAJA POR RESPONSABILIDAD ADMINISTRATIVA</option> 
                                    <option value="C21">(C21) BAJA POR INCAPACIDAD</option> 
                                    <option value="C18">(C22) MODIFICACIÓN DE PENSION ALIMENTICIA</option>

                                </select>
                                <h4>Descripcion - Motivo (Modificar si se requiere):</h4><input name="motivo" id="motivo" type="text" maxlength="50" style="height: 20px; width: 522px;" required/></input>
                                <h4>Vigencia:</h4><input name="vigencia" type="date" maxlength="20" required/></input>
                                <h4>Checador o ISSSTE:</h4>
                                <select name="box" id="box" required>
                                    <option value="">Seleccione</option>
                                    <option value="Checador">Checador</option> 
                                    <option value="ISSSTE">ISSSTE</option>
                                    <option value="Ambos">Ambos</option>
                                    <option value="Ninguno">Ninguno</option>
                                </select>
                                <input name="rfc" type="hidden" value="<?php echo $rfc;?>" /></input>
                                <input name="id_totxper" type="hidden" value="<?php echo $id_totxper;?>" /></input>
                                <input name="stado" type="hidden" value="<?php echo $stado;?>" /></input>
                                <input name="id_usuario" type="hidden" value="<?php echo $id_usuario;?>" /></input>
                            <br>
                            <br>
                                <input type="submit" name="boton" value="Cancelar Pago" style=" width: 96px; position: relative; left: 124px;">
                            </form>
                    
                     <?php
                       
                    mssql_close($link); 

                ?>    

            </div>
        </div>

                        
                               
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2018. <a href="http://www.ssm.gob.mx/portal/" target="_blank">SSM</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        
      // simple chart
        var flash = [[0, 11], [1, 9], [2,12], [3, 8], [4, 7], [5, 3], [6, 1]];
        var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
      var css3 = [[0, 6], [1, 1], [2,9], [3, 12], [4, 10], [5, 12], [6, 11]];
            
        function showTooltip(x, y, contents) {
            jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5
            }).appendTo("body").fadeIn(200);
        }
    
            
        var plot = jQuery.plot(jQuery("#chartplace"),
               [ { data: flash, label: "Flash(x)", color: "#6fad04"},
              { data: html5, label: "HTML5(x)", color: "#06c"},
              { data: css3, label: "CSS3", color: "#666"} ], {
                   series: {
                       lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
                       points: { show: true }
                   },
                   legend: { position: 'nw'},
                   grid: { hoverable: true, clickable: true, borderColor: '#666', borderWidth: 2, labelMargin: 10 },
                   yaxis: { min: 0, max: 15 }
                 });
        
        var previousPoint = null;
        jQuery("#chartplace").bind("plothover", function (event, pos, item) {
            jQuery("#x").text(pos.x.toFixed(2));
            jQuery("#y").text(pos.y.toFixed(2));
            
            if(item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                        
                    jQuery("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);
                        
                    showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + x + " = " + y);
                }
            
            } else {
               jQuery("#tooltip").remove();
               previousPoint = null;            
            }
        
        });
        
        jQuery("#chartplace").bind("plotclick", function (event, pos, item) {
            if (item) {
                jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });
    
        
        //datepicker
        jQuery('#datepicker').datepicker();
        
        // tabbed widget
        jQuery('.tabbedwidget').tabs();
        
        
    
    });
</script>
</body>
</html>




 