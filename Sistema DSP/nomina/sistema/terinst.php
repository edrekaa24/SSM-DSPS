<?php
include 'conexion.php';
session_start();
$nombre=$_SESSION['nombre'];
$depto=$_SESSION['depto'];
$id_usuario=$_SESSION['id_usuario'];
$nivel=$_SESSION['nivel'];
$qna=$_POST['qna'];
$ano=$_POST['anio'];
    //Verificamos si la cookie ya se ha establecido. 
    //[La cookie se establece al iniciar sesión con datos correctos]
if(isset($_COOKIE["misitio_userid"]))
    echo '';
    //dentro del echo -> <script language="javascript">alert("Sesion iniciada");</script>
    //En caso contrario indicamos que no se ha iniciado sesión.
    //Y poner un link mediante HTML para ir al formulario de inicio.
else
    header('Location:index.php');

$sql = "SELECT
    SUM(IIF(A.CONCEPTO='50' AND A.TIPO=2,IMPORTE,0)) as met1,
    SUM(IIF(A.CONCEPTO='51' AND A.TIPO=2,IMPORTE,IIF(A.CONCEPTO='57' AND A.TIPO=2,IMPORTE,0))) as met2,
    SUM(IIF(A.CONCEPTO='81' AND A.TIPO=2,IMPORTE,IIF(A.CONCEPTO='82' AND A.TIPO=2,IMPORTE,IIF(A.CONCEPTO='83' AND A.TIPO=2,IMPORTE,0)))) as met3,
    SUM(IIF(A.CONCEPTO='77' AND A.TIPO=2,IMPORTE,0)) as argos,
    SUM(IIF(A.CONCEPTO='74' AND A.TIPO=2,IMPORTE,0)) as axa,
    SUM(IIF(A.CONCEPTO='72' AND A.TIPO=2,IMPORTE,0)) as hdi,
    SUM(IIF(A.CONCEPTO='95' AND A.TIPO=2,IMPORTE,0)) as naser,
    SUM(IIF(A.CONCEPTO='21' AND A.TIPO=2,IMPORTE,0)) as hsbc,
    SUM(IIF(A.CONCEPTO='46' AND A.TIPO=2 AND A.ANTECEDENTE='PR',IMPORTE,0)) as promo,
    SUM(IIF(A.CONCEPTO='46' AND A.TIPO=2 AND A.ANTECEDENTE='ET',IMPORTE,0)) as etsa,
    SUM(IIF(A.CONCEPTO='46' AND A.TIPO=2 AND A.ANTECEDENTE='M1',IMPORTE,0)) as m1,
    SUM(IIF(A.CONCEPTO='46' AND A.TIPO=2 AND A.ANTECEDENTE='M2',IMPORTE,0)) as m2,
    SUM(IIF(A.CONCEPTO='46' AND A.TIPO=2 AND A.ANTECEDENTE='M9',IMPORTE,0)) as m9,
    B.UNIDAD,
    C.PRESUP,
    C.CUENTA
FROM MOVXPER A, TOTXPER B, COMUN.dbo.unidades C
WHERE B.QUINCENA='$qna' 
    AND B.ANO='$ano' 
    AND A.ID=B.ID 
    AND B.STADO='A'
    AND B.TIPAG<>0
    AND B.REF_NOM=C.REF_NOM
    AND B.UNIDAD=C.CLAVE 
    AND C.PERIODO=2018
GROUP BY
    B.UNIDAD,
    B.ANO,
    C.PRESUP,
    C.CUENTA";

$stmt = mssql_query($sql,$link);

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
<script type="text/javascript">
function imagen(){
imagen = '<img src="images/database.gif" alt="cargando..." />'
    document.getElementById('imagencargando').innerHTML = imagen;
}
</script>

<style>
table {
    width:auto;
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
                <h1>SOLICITUD PARA PAGO A TERCEROS INSTITUCIONALES - QUINCENAL</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">

            <div class="maincontentinner">
                        
                <form  name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">                   

                <h4>Quincena:</h4>
                <select id="qna" name="qna">
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
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                </select>

                <h4>Año:</h4>
                <select id="anio" name="anio">
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    
                </select>
                <br><br>
                <button type="submit" name="submit" class="btn btn-primary" onclick='imagen()'>Generar</button>
                 
                </form>
            

            <br><br>
            <h3>Resultados: Quincena - <?php echo $qna ?> - Año - <?php echo $ano ?></h3>
            <div id='imagencargando'></div>
            <?php
        
            if( !mssql_num_rows($stmt)) {
                        echo '<h4></h4>';
                }
                 else{


                             ?>    
                                        <TABLE id="t01">
                                      
                                        <TR> 
                                            <TH align="center">PRESUPUESTO</TH>
                                            <TH align="center">CUENTA</TH>
                                            <TH align="center">UNIDAD</TH>
                                            <TH align="center">(50) METLIFE</TH>
                                            <TH align="center">(51,57) METLIFE</TH>
                                            <TH align="center">(81,82,83) METLIFE</TH>
                                            <TH align="center">(77)ARGOS</TH>
                                            <TH align="center">(74)AXA</TH>
                                            <TH align="center">(72)HDI</TH>
                                            <TH align="center">(95SF)NASER</TH>
                                            <TH align="center">(21)HSBC</TH>
                                            <TH align="center">(46PR)PROMOBIEN</TH>
                                            <TH align="center">(46ET)ETESA</TH>
                                            <TH align="center">(46M1)BANORTE</TH>
                                            <TH align="center">(46M2)BANAMEX</TH>
                                            <TH align="center">(46M9)BANORTE</TH>
                                        </TR>
                            <?php


                        
                         while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {
                          
                         
                          $pres=$row['PRESUP'];
                          $cta=$row['CUENTA'];
                          $unidad=$row['UNIDAD'];
                          $met1=$row['met1'];
                          $met2=$row['met2'];
                          $met3=$row['met3'];
                          $argos=$row['argos'];
                          $axa=$row['axa'];
                          $hdi=$row['hdi'];
                          $naser=$row['naser'];
                          $hsbc=$row['hsbc'];
                          $promo=$row['promo'];
                          $etsa=$row['etsa'];
                          $m1=$row['m1'];
                          $m2=$row['m2'];
                          $m9=$row['m9'];
                         
                ?>

                            <TR>
                            <td><?php echo $pres;?></td>
                            <td><?php echo $cta;?></td>
                            <td><?php echo $unidad;?></td>
                            <td><?php echo number_format($met1, 2, '.', '');?></td>
                            <td><?php echo number_format($met2, 2, '.', '');?></td>
                            <td><?php echo number_format($met3, 2, '.', '');?></td>
                            <td><?php echo number_format($argos, 2, '.', '');?></td>
                            <td><?php echo number_format($axa, 2, '.', '');?></td>
                            <td><?php echo number_format($hdi, 2, '.', '');?></td>
                            <td><?php echo number_format($naser, 2, '.', '');?></td>
                            <td><?php echo number_format($hsbc, 2, '.', '');?></td>
                            <td><?php echo number_format($promo, 2, '.', '');?></td>
                            <td><?php echo number_format($etsa, 2, '.', '');?></td>
                            <td><?php echo number_format($m1, 2, '.', '');?></td>
                            <td><?php echo number_format($m2, 2, '.', '');?></td>
                            <td><?php echo number_format($m9, 2, '.', '');?></td>
                            </TR>          
                     <?php
                        
                        }
                    
                     ?>        
                        </TABLE>  
                         
                        <br>
                        <br>
                        
                        <button onclick="exportTableToCSV('SOLICITUD_PARA_PAGO_A_TERCEROS_INSTITUCIONALES_QNA-<?php echo $qna; ?>.csv')"class="btn btn-primary">Descargar</button>
                        <?php
                    }
                 ?>

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

