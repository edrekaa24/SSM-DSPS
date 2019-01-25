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
<script type="text/javascript" src="js/jquery.smartWizard.min.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript">
jQuery(document).ready(function(){
    
    // Smart Wizard     
    jQuery('#wizard').smartWizard({onFinish: onFinishCallback});
    jQuery('#wizard2').smartWizard({onFinish: onFinishCallback});
    jQuery('#wizard3').smartWizard({onFinish: onFinishCallback});
        
    function onFinishCallback(){
        alert('¡FUMP GUARDADO CON ÉXITO!');
    } 
            
    jQuery('select, input:checkbox').uniform();
    
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
            
            <div class="pageicon"><span class="iconfa-file"></span></div>
            <div class="pagetitle">
                <h5>SSM SERVICIOS DE SALUD MORELOS</h5>
                <h1>FORMATO ÚNICO DE MOVIMIENTOS DEL PERSONAL</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">

            <div class="maincontentinner">

                <!-- START OF TABBED WIZARD -->
                    <h4 class="subtitle2">Capturar FUMP</h4>
                    <br />
                    <form class="stdform" method="post" action="wizards.html">
                    <div id="wizard3" class="wizard tabbedwizard">
                        
                        <ul class="tabbedmenu">
                            <li>
                                <a href="#wiz3step1">
                                    <span class="h2">PASO 1</span>
                                    <span class="label">INFORMACIÓN BÁSICA</span>
                                </a>
                            </li>
                            <li>
                                <a href="#wiz3step2">
                                    <span class="h2">PASO 2</span>
                                    <span class="label">DATOS PERSONALES</span>
                                </a>
                            </li>
                            <li>
                                <a href="#wiz3step3">
                                    <span class="h2">PASO 3</span>
                                    <span class="label">DATOS PRESUPUESTALES</span>
                                </a>
                            </li>
                        </ul>
                        
                            
                        <div id="wiz3step1" class="formwiz">
                            <h4>PASO 1: INFORMACIÓN BÁSICA</h4>
                            
                                <p>
                                    <label>UNIDAD EXPEDIDORA</label>
                                    <span class="field"><input type="text" name="unidad" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>LUGAR DE EXPEDICIÓN</label>
                                    <span class="field"><input type="text" name="lugar" class="input-xxlarge"/></span>
                                </p>

                                <p>
                                    <label>FECHA DE EXPEDICIÓN</label>
                                    <span class="field"><input type="text" name="fecha" class="input-xxlarge" /></span>
                                </p>
                                
                            
                        </div><!--#wiz13tep1-->
                        
                        <div id="wiz3step2" class="formwiz">
                            <h4>PASO 2: DATOS PERSONALES</h4> 
                                
                                <p>
                                    <label>RFC</label>
                                    <span class="field"><input type="text" name="rfc" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>CURP</label>
                                    <span class="field"><input type="text" name="curp" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>APELLIDO PATERNO</label>
                                    <span class="field"><input type="text" name="ap_pat" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>APELLIDO MATERNO</label>
                                    <span class="field"><input type="text" name="ap_mat" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>NOMBRE</label>
                                    <span class="field"><input type="text" name="ap_mat" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>CALLE</label>
                                    <span class="field"><input type="text" name="calle" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>NÚMERO EXTERIOR</label>
                                    <span class="field"><input type="text" name="no_ext" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>NÚMERO INTERIOR</label>
                                    <span class="field"><input type="text" name="no_int" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>COLONIA</label>
                                    <span class="field"><input type="text" name="col" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>CÓDIGO POSTAL</label>
                                    <span class="field"><input type="text" name="cp" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>DELEGACIÓN O MUNICIPIO</label>
                                    <span class="field"><input type="text" name="municipio" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>ESTADO</label>
                                    <span class="field"><input type="text" name="estado" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>TELÉFONO</label>
                                    <span class="field"><input type="text" name="tel" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>CUENTA BANCARIA NÚMERO</label>
                                    <span class="field"><input type="text" name="cta_ban" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>GENERO</label>
                                    <span class="field"><select name="genero" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="M">MASCULINO</option>
                                        <option value="F">FEMENINO</option>
                                    </select></span>
                                </p>

                                <p>
                                    <label>ESTADO CIVIL</label>
                                    <span class="field"><select name="genero" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="s">SOLTERO</option>
                                        <option value="c">CASADO</option>
                                        <option value="d">DIVORCIADO</option>
                                        <option value="v">VIUDO</option>
                                        <option value="o">OTRO</option>
                                    </select></span>
                                </p>

                                <p>
                                    <label>NACIONALIDAD</label>
                                    <span class="field"><select name="genero" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="MX">MEXICANA</option>
                                        <option value="MXNT">MEXICANA POR NATURALIZACION</option>
                                        <option value="EX">EXTRANJERO</option>
                                    </select></span>
                                </p>

                                <p>
                                    <label>FECHA INGRESO GOBIERNO FEDERAL</label>
                                    <span class="field"><input type="text" name="fec_gob_fed" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>FECHA INGRESO SECRETARIA DE SALUD</label>
                                    <span class="field"><input type="text" name="fec_sec_sal" class="input-xxlarge" /></span>
                                </p>
                                                                                          
                        </div><!--#wiz3step2-->
                        
                        <div id="wiz3step3">
                            <h4>PASO 3: DATOS PRESUPUESTALES</h4>
                            <h4>ANTECEDENTES</h4>
                            <div class="par terms">
                                <p>
                                    <label>CLAVE PRESUPUESTAL ANTERIOR</label>
                                    <span class="field">
                                    	<input type="text" name="un-resp-ant" class="input-small" placeholder="UNIDAD RESP"/>
                                    	<input type="text" name="act-inst-ant" class="input-small" placeholder="ACT. INST."/>
                                    	<input type="text" name="proy-ant" class="input-small" placeholder="PROYECTO"/>
                                    	<input type="text" name="part-ant" class="input-small" placeholder="PARTIDA"/>
                                    	<input type="text" name="cod-ant" class="input-small" placeholder="CÓDIGO"/>
                                    	<input type="text" name="puesto-ant" class="input-small" placeholder="PUESTO"/>
                                    	<input type="text" name="gf-ant" class="input-small" placeholder="GF"/>
                                    	<input type="text" name="fn-ant" class="input-small" placeholder="FN"/>
                                    	<input type="text" name="sf-ant" class="input-small" placeholder="SF"/>
                                    </span>
                                </p>
                                
                                <p>
                                    <label>ADSCRIPCIÓN</label>
                                    <span class="field"><input type="text" name="adscripcion-ant" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>CLAVE DEL CENTRO DE RESPONSABILIDAD</label>
                                    <span class="field"><input type="text" name="cve-resp-ant" class="input-xxlarge" /></span>
                                </p>
                            <br>
                            <h4>DATOS DEL SUSTITUIDO</h4>
                            	<p>
                                    <label>APELLIDO PATERNO</label>
                                    <span class="field"><input type="text" name="ap_pat-sust" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>APELLIDO MATERNO</label>
                                    <span class="field"><input type="text" name="ap_mat-sust" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>NOMBRE</label>
                                    <span class="field"><input type="text" name="nom-sust" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>RFC</label>
                                    <span class="field"><input type="text" name="rfc-sust" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>EFECTOS DEL</label>
                                    <span class="field"><input type="text" name="fec-del-sust" class="input-small" />
                                    AL
                                    <input type="text" name="fec-al-sust" class="input-small" /></span>
                                </p>

                                <p>
                                    <label>MOTIVO</label>
                                    <span class="field"><input type="text" name="motivo-sust" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>NO. DOCUMENTO</label>
                                    <span class="field"><input type="text" name="doc-sust" class="input-xxlarge" /></span>
                                </p>
                                
                            </div>
                            <h4>OPERACIÓN</h4>
                            <div class="par terms">

                            	<p>
                                    <label>VIGENCIA DEL</label>
                                    <span class="field"><input type="text" name="fec-del-vig" class="input-small" />
                                    AL
                                    <input type="text" name="fec-al-vig" class="input-small" /></span>
                                </p>

                                <p>
                                    <label>NO. DOCUMENTO</label>
                                    <span class="field"><input type="text" name="doc-op" class="input-xxlarge" /></span>
                                </p>

                                 <p>
                                    <label>LOTE</label>
                                    <span class="field"><input type="text" name="lot-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>QNA</label>
                                    <span class="field"><input type="text" name="qna-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>NÚMERO DE CONTRATO</label>
                                    <span class="field"><input type="text" name="no-cont-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>CÓDIGO DE MOVIMIENTO</label>
                                    <span class="field"><select name="cod-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="1101">1101 - BAJAS</option>
                                        <option value="4005">4005 - INGRESO</option>
                                        <option value="4505">4505 - REINGRESO</option>
                                        </select></span>                                        
                                </p>

                                <p>
                                    <label>TIPO DE MOVIMIENTO</label>
                                    <span class="field"><select name="t-mov-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="NUE">NUEVO INGRESO</option>
                                        <option value="REI">REINGRESO</option>
                                        <option value="PRO">PROMOCIÓN</option>
                                        <option value="AUM">AUMENTO</option>
                                        <option value="DIS">DISMINUCIÓN</option>
                                        <option value="PEN">PENSIÓN ALIMENTICIA</option>
                                        <option value="DAT">DATOS PERSONALES</option>
                                        <option value="BAJ">BAJA</option>
                                        <option value="REA">REANUDACIÓN DE LABORES</option>
                                        <option value="LIC">LICENCIA</option>
                                        <option value="CAM">CAMBIO RADICACIÓN SUELDOS</option>
                                        <option value="PRI">PRIMA QUINCENAL</option>
                                        <option value="PRE">PREJUBILATORIA</option>
                                        <option value="DES">DESTITULARIZACIÓN</option>
                                    </select></span>
                                </p>

                                <p>
                                    <label>TIPO TRABAJADOR</label>
                                    <span class="field"><select name="t-tra-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="BASE">BASE</option>
                                        <option value="CONFIANZA">CONFIANZA</option>
                                        <option value="INT-PROV">INTERNO O PROVISIONAL</option> 
                                        <option value="EVENTUAL">EVENTUAL</option> 
                                        </select></span>                                      
                                </p>

                                <p>
                                    <label>NÚMERO DE EMPLEADO</label>
                                    <span class="field"><input type="text" name="no-emp-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>ADSCRIPCION</label>
                                    <span class="field"><input type="text" name="ads-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>CLAVE DE CENTRO DE RESPONSABILIDAD</label>
                                    <span class="field"><input type="text" name="cve-centresp-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>CLAVE PRESUPUESTAL</label>
                                    <span class="field">
                                    	<input type="text" name="un-resp-op" class="input-small" placeholder="UNIDAD RESP"/>
                                    	<input type="text" name="act-inst-op" class="input-small" placeholder="ACT. INST."/>
                                    	<input type="text" name="proy-op" class="input-small" placeholder="PROYECTO"/>
                                    	<input type="text" name="part-op" class="input-small" placeholder="PARTIDA"/>
                                    	<input type="text" name="cod-op" class="input-small" placeholder="CÓDIGO"/>
                                    	<input type="text" name="puesto-op" class="input-small" placeholder="PUESTO"/>
                                    	<input type="text" name="gf-op" class="input-small" placeholder="GF"/>
                                    	<input type="text" name="fn-op" class="input-small" placeholder="FN"/>
                                    	<input type="text" name="sf-op" class="input-small" placeholder="SF"/>
                                    </span>
                                </p>

                                <p>
                                    <label>NOMBRE DEL PUESTO</label>
                                    <span class="field"><input type="text" name="cve-centresp-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>HORARIO ASIGNADO</label>
                                    <span class="field"><select name="hor-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="8">8 HORAS</option>
                                        <option value="7">7 HORAS</option>
                                        <option value="6">6 HORAS</option> 
                                        <option value="HSM">POR H.S.M.</option>
                                        <option value="OTRO">OTRO TIPO</option>
                                        </select></span>                                      
                                </p>

                                <p>
                                    <label>TIPO DE SERVICIO</label>
                                    <span class="field"><select name="t-serv-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="SUP">SUPERIOR</option>
                                        <option value="MED">M. MEDIO</option>
                                        <option value="APO">APOYO</option> 
                                        <option value="MPM">RAMA M.P.M.</option>
                                        <option value="ADVA">RAMA ADVA.</option>
                                        </select></span>                                      
                                </p>

                                <p>
                                    <label>TABULADOR</label>
                                    <span class="field"><select name="tab-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="1">NIVEL 1</option>
                                        <option value="2">NIVEL 2</option>
                                        <option value="3">NIVEL 3</option>
                                        </select></span>                                      
                                </p>

                                <p>
                                    <label>TIPO DE LICENCIA</label>
                                    <span class="field"><select name="tiplic-op" class="uniformselect">
                                        <option value="">ELEGIR</option>
                                        <option value="1">CON SUELDO</option>
                                        <option value="2">A MEDIO SUELDO</option>
                                        <option value="3">SIN SUELDO</option>
                                        <option value="3">PRE PENSIONARIA</option>
                                        </select></span>                                      
                                </p>

                                <p>
                                    <label>MOTIVO</label>
                                    <span class="field"><input type="text" name="motlic-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>DÍAS LICENCIA</label>
                                    <span class="field"><input type="text" name="diaslic-op" class="input-xxlarge" /></span>
                                </p>

                                <h4>PERCEPCIONES</h4>

                                <p>
                                    <label>1</label>
                                    <span class="field">
                                    	<input type="text" name="ptp-op-1" class="input-medium" placeholder="PARTIDA PRESUPUESTAL"/>
                                    	<input type="text" name="act-op-1" class="input-medium" placeholder="ACTUALES"/>
                                    	<input type="text" name="inds-op-1" class="input-medium" placeholder="INCREMENTO O DISMINUCIÓN"/>
                                    	<input type="text" name="aco-op-1" class="input-medium" placeholder="ACORDADAS"/>
                                    </span>
                                    <label>2</label>
                                    <span class="field">
                                    	<input type="text" name="ptp-op-2" class="input-medium" placeholder="PARTIDA PRESUPUESTAL"/>
                                    	<input type="text" name="act-op-2" class="input-medium" placeholder="ACTUALES"/>
                                    	<input type="text" name="inds-op-2" class="input-medium" placeholder="INCREMENTO O DISMINUCIÓN"/>
                                    	<input type="text" name="aco-op-2" class="input-medium" placeholder="ACORDADAS"/>
                                    </span>
                                    <label>3</label>
                                    <span class="field">
                                    	<input type="text" name="ptp-op-3" class="input-medium" placeholder="PARTIDA PRESUPUESTAL"/>
                                    	<input type="text" name="act-op-3" class="input-medium" placeholder="ACTUALES"/>
                                    	<input type="text" name="inds-op-3" class="input-medium" placeholder="INCREMENTO O DISMINUCIÓN"/>
                                    	<input type="text" name="aco-op-3" class="input-medium" placeholder="ACORDADAS"/>
                                    </span>
                                    <label>4</label>
                                    <span class="field">
                                    	<input type="text" name="ptp-op-4" class="input-medium" placeholder="PARTIDA PRESUPUESTAL"/>
                                    	<input type="text" name="act-op-4" class="input-medium" placeholder="ACTUALES"/>
                                    	<input type="text" name="inds-op-4" class="input-medium" placeholder="INCREMENTO O DISMINUCIÓN"/>
                                    	<input type="text" name="aco-op-4" class="input-medium" placeholder="ACORDADAS"/>
                                    </span>
                                    <label>5</label>
                                    <span class="field">
                                    	<input type="text" name="ptp-op-5" class="input-medium" placeholder="PARTIDA PRESUPUESTAL"/>
                                    	<input type="text" name="act-op-5" class="input-medium" placeholder="ACTUALES"/>
                                    	<input type="text" name="inds-op-5" class="input-medium" placeholder="INCREMENTO O DISMINUCIÓN"/>
                                    	<input type="text" name="aco-op-5" class="input-medium" placeholder="ACORDADAS"/>
                                    </span>
                                    <label>6</label>
                                    <span class="field">
                                    	<input type="text" name="ptp-op-6" class="input-medium" placeholder="PARTIDA PRESUPUESTAL"/>
                                    	<input type="text" name="act-op-6" class="input-medium" placeholder="ACTUALES"/>
                                    	<input type="text" name="inds-op-6" class="input-medium" placeholder="INCREMENTO O DISMINUCIÓN"/>
                                    	<input type="text" name="aco-op-6" class="input-medium" placeholder="ACORDADAS"/>
                                    </span>
                                    <span class="field">
                                    	<input type="text" name="x" class="input-medium" placeholder="TOTALES" readonly/>
                                    	<input type="text" name="act-op-tot" class="input-medium" placeholder="$0.00"/>
                                    	<input type="text" name="inds-op-tot" class="input-medium" placeholder="$0.00"/>
                                    	<input type="text" name="aco-op-tot" class="input-medium" placeholder="$0.00"/>
                                    </span>
                                </p>

                                <p>
                                    <label>NÓMINA</label>
                                    <span class="field"><input type="text" name="nomina-op" class="input-xxlarge" /></span>
                                </p>

                                <p>
                                    <label>JUSTIFICACIÓN O MOTIVOS DEL MOVIMIENTO</label>
                                    <span class="field"><textarea cols="80" rows="5" class="span6" name="justificacion"></textarea></span>
                                </p>

                                
                            </div>
                        </div><!--#wiz3step3-->
                        
                    </div><!--#wizard-->
                    </form>
                                        
                    <!-- END OF TABBED WIZARD -->
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



