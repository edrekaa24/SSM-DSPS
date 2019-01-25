<?php

session_start();
$nombre=$_SESSION['nombre'];
$depto=$_SESSION['depto'];
    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if ($nombre==NULL) {
    header('Location:index.php');
}


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
<title>Escritorio</title>
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
                <h1>Productos de Nómina</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">

            


            <div class="maincontentinner">

                <form  name="form1" method="get" action="prod.php" >
                <h4>Unidad:</h4>
                <select id="unidad" name="unidad">
                    <option value="416">416 "FEDERAL"</option>
                    <option value="610">610 "PASANTES"</option>
                    <option value="414">414 "REPSS"</option>
                    <option value="429">429 "HOSPITAL DE TEMIXCO"</option>
                    <option value="423">423 "TRANSFERIDO"</option>
                    <option value="X00">X00 "UNEME"</option>
                    <option value="U00">U00 "REGULARIZADOS - REPSS"</option>
                    <option value="U01">U01 "REGULARIZADOS - FASSA"</option>
                    <option value="416">"EXCOMISIONADOS"</option>
                    <option value="416">"JUBILADOS"</option>
                    <option value="415">415 "HOMOLOGADOS"</option>
                    <option value="417">417 "BENEFICENCIA PUBLICA" </option>
                    <option value="420">420 "RESIDENTES ESTATALES"</option>
                    <option value="417">423 "PARTIDA COMPLEMENTARIA ESTATAL"</option>
                    <option value="424">424 "HOSPITAL DE LA MUJER"</option>
                    <option value="425">425 FORTALECIMIENTO A LA ATENCION MEDICA</option>
                    <option value="431">431 "PREVENCION Y CONTROL DEL DENGUE"</option>
                    <option value="434">434 "CANCER DE LA MUJER"</option>
                    <option value="439">439 "CANCER DE LA MUJER"</option>
                    <option value="441">441 "ELEVAR LA CALIDAD DE VIDA DEL ADULTO MAYOR (DIABETES)"</option>
                    <option value="442">INFANCIA Y ADOLESCENCIA</option>
                    <option value="443">4423 "PREVENCION Y CONTROL DEL DENGUE"</option>
                    <option value="444">444 "PROGRAMA DE RIESGO CARDIOVASCULAR"</option>
                    <option value="445">445 "PEF"</option>
                    <option value="446">446 "PROGRAMA TRANSPLANTE RENAL"</option>
                    <option value="448">448 "PEF"</option>
                    <option value="455">455 "CARAVANAS COPAC"</option>
                    <option value="456">CEEC "PROGRAMAS VARIOS"</option>
                    <option value="457">457 "ENFERMEDADES TRANSMITIDAS POR VECTOR"</option>
                    <option value="460">460 "PROGRAMA ADULTO Y ANCIANO"</option>
                    <option value="461">461 "PROGRAMA CAMPER/CRUM"</option>
                    <option value="462">462 "PROGRAMA SALUD MENTAL"</option>
                    <option value="463">463 "PROGRAMA PASIA (PROGRAMA DE ASISTENCIA DE SALUD AL INFANTE Y ADOLESCENTE)"</option>
                    <option value="464">464 "PROGRAMA SALUD BUCAL"</option>
                    <option value="465">465 "SALUD MATERNA Y PERINATAL"</option>
                    <option value="466">466 "VIOLENCIA"</option>
                    <option value="467">467 "ATENCION EN PRIMER NIVEL"</option>
                    <option value="490">490 "FORMALIZACION LABORAL I FASSA-ESTATAL"</option>
                    <option value="500">500 "FORMALIZACION LABORAL I FASSA-PEF"</option>
                    <option value="501">501 "FORMALIZACION LABORAL I FASSA-REPSS"</option>
                    <option value="502">502 "FORMALIZACION LABORAL I  FASSA-CEEC"</option>
                    <option value="511">511 "FORMALIZACION LABORAL I FASSA-REPSS"</option>
                    <option value="512">512 "FORMALIZACION LABORAL I FASSA-ESTATAL"</option>
                    <option value="513">513 "FORMALIZACION LABORAL I FASSA-CEEC"</option>
                    <option value="490">490 "FORMALIZACION LABORAL II FASSA-ESTATAL"</option>
                    <option value="500">500 "FORMALIZACION LABORAL II FASSA-PEF"</option>
                    <option value="501">501 "FORMALIZACION LABORAL II FASSA-REPSS"</option>
                    <option value="511">511 "FORMALIZACION LABORAL II FASSA-REPSS"</option>
                    <option value="512">512 "FORMALIZACION  LABORAL II FASSA-ESTATAL"</option>
                    <option value="490">490 "FORMALIZACION LABORAL III FASSA-ESTATAL"</option>
                    <option value="501">501 "FORMALIZACION LABORAL III FASSA-REPSS"</option>
                    <option value="511">511 "FORMALIZACION LABORAL III FASSA-REPSS"</option>
                    <option value="472">472 "PLANIFICACION FAMILIAR"</option>
                    <option value="474">474 "SALUD REPRODUCTIVA"</option>
                    <option value="476">476 "IGUALDAD DE GENERO"</option>
                    <option value="478">478 "CAPACITACION CONTINUA DEL PERSONAL DE SALUD"</option>
                    <option value="480">480 "REFORZAMIENTO DE RECURSOS HUMANOS DE LOS CENTROS CENTINELA 2018"</option>
                    <option value="482">482 "SALUD BUCAL"</option>
                    <option value="483">483 "PROVISION PARA EL SECTOR SALUD "</option>
                    <option value="486">486 "VACUNACION"</option>
                    <option value="487">487 "PROGRAMA SALUD INFANCIA Y ADOLESCENCIA"</option>
                    <option value="489">489 "PROVISION PARA EL SECTOR SALUD "</option>
                    <option value="493">493 "PROGRAMA DE RABIA"</option>
                    <option value="494">494 "PROGRAMA DE PALUDISMO"</option>
                    <option value="495">495 "PROGRAMA DE CHAGAS"</option>
                    <option value="496">496 "DIVERSOS PROGRAMAS ANTECEDENTE ANEXO IV REPSS"</option>
                    <option value="505">505 "PREVENCIÓN"</option>
                    <option value="506">506 "PROGRAMA CÓLERA"</option>
                    <option value="507">507 "PROGRAMA DE VIGILANCIA EPIDEMIOLOGICA"</option>
                    <option value="508">508 "PROGRAMA DE ALIMENTACION Y ACTIVIDAD"</option>
                    <option value="509">509 "PROGRAMA DE PICADURA DE ALACRAN"</option>
                    <option value="510">510 "PROGRAMA DE RICKETTSIOSIS"</option>
                    <option value="514">514 "PERSONAL UR 514"</option>
                    <option value="515">515 "DESASTRES EPIDEMIOLÓGICOS"</option>
                </select>
                <h4>Quincena:</h4>
                <select id="ur" name="ur">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                </select>
                <input type="submit" name="Submit" value="Buscar" style="width:80px; position: relative;left: 570px;" />
                 
                </form>
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



