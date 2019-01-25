<?php
include 'conexion.php';
session_start();
$nombre=$_SESSION['nombre'];
$depto=$_SESSION['depto'];
$id_usuario=$_SESSION['id_usuario'];
$nivel=$_SESSION['nivel'];
    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //dentro del echo -> <script language="javascript">alert("Sesion iniciada");</script>
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else
    header('Location:index.php');

   $sql1 = "SELECT TOTXPER.ID,TOTXPER.STADO,TOTXPER.NOMBRE,TOTXPER.UNIDAD,TOTXPER.REFERENCIA,TOTXPER.CENTRO,TOTXPER.EMPLEADO,TOTXPER.NOMPROD,TOTXPER.CUENTA,TOTXPER.PERCEPCIONES,TOTXPER.DEDUCCIONES, Cancelaciones.*, usuarios.nombre as nombre_usr FROM TOTXPER,Cancelaciones,usuarios WHERE TOTxPER.STADO like ('NC%') and TOTXPER.ID=Cancelaciones.id_totxper and Cancelaciones.usuario=usuarios.id_usuario";
   $stmt1 = mssql_query($sql1,$link);

$sql = "SELECT TOTXPER.ID,TOTXPER.STADO,TOTXPER.NOMBRE,TOTXPER.UNIDAD,TOTXPER.REFERENCIA,TOTXPER.CENTRO,TOTXPER.EMPLEADO,TOTXPER.NOMPROD,TOTXPER.CUENTA, Cancelaciones.* FROM TOTXPER,Cancelaciones WHERE TOTxPER.STADO like ('NC%') and TOTXPER.ID=Cancelaciones.id_totxper and usuario=".$id_usuario."";
$stmt = mssql_query($sql,$link);

$sql_b="SELECT app FROM USUARIOS WHERE id_usuario=2";
$stm = mssql_query($sql_b,$link);

while (($row_b = mssql_fetch_array($stm, MSSQL_BOTH))) {
    $activacion=$row_b['app'];
}
if ($activacion==1) {
    $txt_act='checked';
}
if ($activacion==0)
   $txt_act='';
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
<script type="text/javascript" src="js/jspdf.debug.js"></script>


<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<style>
#rfc-list{list-style:none;margin-top:0px;width:522px;position: absolute;}
#rfc-list li{padding: 10px; background: #FFF; border-bottom: #bbb9b9 1px solid;}
#rfc-list li:hover{background:#ece3d2;cursor: pointer;}

</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
// AJAX call for autocomplete 
$(document).ready(function(){
    $("#rfc").keyup(function(){
        $.ajax({
        type: "POST",
        url: "busqueda.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#rfc").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#rfc").css("background","#FFF");

        }
        });
    });
});
//To select country name
function selectrfc(val) {
$("#rfc").val(val);
$("#suggesstion-box").hide();
}
</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th{
    padding: 5px;
    text-align: center;
}
td {
    padding: 5px;
    text-align: right;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th    {
    background-color: #333333;
    color: white;
}
</style>

<script>
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}


function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("TABLE TR");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("TD, TH");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

function demoFromHTML() {
    var pdf = new jsPDF('l', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#customers')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 20,
        bottom: 20,
        left: 20,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Test.pdf');
    }, margins);
}

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
                <h1>Cancelaciones de Nómina</h1>
                <?php
                 if ($nivel==1 || $nivel==2)
                    {?>
                        <form name="checkbox" action="activar.php" method="POST">
                       <label class="switch">
                          <input type="checkbox" name="Activador" value="1" onclick="submit();" <?php echo $txt_act;?>>
                          <span class="slider round"></span>
                        </label> 
                    </form>
                    <?php
                    }
                ?>
                
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">

            


            <div class="maincontentinner">

                
                <form  name="form1" method="get" action="cancelaciones2.php" class="searchbar">
                <input autocomplete="off" name="rfc" id="rfc" type="text" maxlength="13" style="height: 20px; width: 522px;" onKeyUp="this.value=this.value.toUpperCase();"/>
               
                <input type="submit" name="Submit" value="Buscar" style="width:80px; position: relative;left: 570px;" />
                 <div id="suggesstion-box"></div>
                </form>
                
            </div>
            <br><br>
            <h3>Cancelados:</h3>
            
            <?php
        if ($nivel==9) {
            if( !mssql_num_rows($stmt1)) {
                        echo '<h4>Sin Cancelados</h4>';
                }
                 else{


                             ?>    
                              <div id="customers">
                                 <h1>Restringidos</h1>
                                        <TABLE id="t01">
                                      
                                        <TR> 
                                            <TH align="center">RFC</TH>
                                            <TH align="center">NOMBRE</TH>
                                            <TH align="center">TIPO DE NOMINA</TH>
                                            <TH align="center">CENTRO RESP</TH>
                                            <TH align="center">NÓMINA</TH>
                                            <TH align="center">NETO</TH>
                                            <TH align="center">CVE_MOTIVO</TH>
                                            <TH align="center">MOTIVO</TH>
                                            <TH align="center">VIGENCIA</TH>
                                            <TH align="center">CUENTA</TH>
                                            <TH align="center">CHECADOR/ISSSTE</TH>
                                            <TH align="center">USUARIO</TH>
                                        </TR>
                            <?php


                        if ($nivel==9) {
                         while (($row = mssql_fetch_array($stmt1, MSSQL_BOTH))) {
                          
                         
                          $rfc=$row['EMPLEADO'];
                          $nombre=utf8_encode($row['NOMBRE']);
                          $tipo_nomina=$row['UNIDAD'].'-'.$row['REFERENCIA'];
                          $centro=$row['CENTRO'];
                          $producto=$row['NOMPROD'];
                          $per=$row['PERCEPCIONES'];
                          $ded=$row['DEDUCCIONES'];
                          $cve_mot=$row['STADO'];
                          $motivo=$row['motivo'];
                          $vigencia=$row['vigencia'];
                          $pago=$row['CUENTA'];
                          $box=$row['box'];
                          $usr=utf8_encode($row['nombre_usr']);
                          $neto=$per-$ded;
                         
                ?>

                            <TR>
                            <td><?php echo $rfc;?></td>
                            <td><?php echo $nombre;?></td>
                            <td><?php echo $tipo_nomina;?></td>
                            <td><?php echo $centro;?></td>
                            <td><?php echo $producto;?></td>
                            <td><?php echo $neto;?></td> 
                            <td><?php echo $cve_mot;?></td>
                            <td><?php echo $motivo;?></td>
                            <td><?php echo $vigencia;?></td>
                            <td><?php echo $pago;?></td>
                            <td><?php echo $box;?></td>
                            <td><?php echo $usr;?></td>
                                      
                     <?php
                        
                        }
                    
                     ?>   
                     </TR>       
                        </TABLE>  
                         
                        <br>
                        <br>
                    </dic>
                        <a href="#" onclick="exportTableToCSV('Cancelaciones.csv')">Descargar Tabla</a> 
                        <!--<button onclick="javascript:demoFromHTML();">PDF</button>-->
                        <?php
                        
                        }
                    }
                }
                    

        if ($nivel!=9) {
                    if( !mssql_num_rows($stmt)) {
                        echo '<h4>Sin Cancelados</h4>';
                }
                 else{


                             ?>    

                            

                                        <TABLE id="t01">
                                      
                                        <TR> 
                                            <TH align="center">RFC</TH>
                                            <TH align="center">NOMBRE</TH>
                                            <TH align="center">TIPO DE NOMINA</TH>
                                            <TH align="center">CENTRO RESP</TH>
                                            <TH align="center">NÓMINA</TH>
                                            <TH align="center">CVE_MOTIVO</TH>
                                            <TH align="center">MOTIVO</TH>
                                            <TH align="center">VIGENCIA</TH>
                                            <TH align="center">CUENTA</TH>
                                            <TH align="center">CHECADOR/ISSSTE</TH>
                                            
                                        </TR>
                            <?php


                    while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {
                          
                         
                          $rfc=$row['EMPLEADO'];
                          $nombre=$row['NOMBRE'];
                          $tipo_nomina=$row['UNIDAD'].'-'.$row['REFERENCIA'];
                          $centro=$row['CENTRO'];
                          $producto=$row['NOMPROD'];
                          $cve_mot=$row['STADO'];
                          $motivo=$row['motivo'];
                          $vigencia=$row['vigencia'];
                          $pago=$row['CUENTA'];
                          $box=$row['box'];

                ?>
                            <TR>
                            <td><?php echo $rfc;?></td>
                            <td><?php echo $nombre;?></td>
                            <td><?php echo $tipo_nomina;?></td>
                            <td><?php echo $centro;?></td>
                            <td><?php echo $producto;?></td>
                            <td><?php echo $cve_mot;?></td>
                            <td><?php echo $motivo;?></td>
                            <td><?php echo $vigencia;?></td>
                            <td><?php echo $pago;?></td>
                            <td><?php echo $box;?></td>
                                      
                     <?php
                        
                        }
                    
                     ?>  
                        </TR>        
                        </TABLE>  
                        <br>
                        <br>
                        <a href="#" onclick="exportTableToCSV('Cancelaciones.csv')">Descargar Tabla</a> 
                        
                        <?php
                        
                        }
                    }
                    
                     ?>
                               
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2018. <a href="http://www.ssm.gob.mx/portal/" target="_blank">SSM</a> - Desarrollado por L.I. Daniel Sánchez Valle</span>
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

