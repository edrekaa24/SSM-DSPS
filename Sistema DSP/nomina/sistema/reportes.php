<?php
session_start();
$nombre=$_SESSION['nombre'];
$depto=$_SESSION['depto'];

$quincena=$_GET['quincena'];
if ($quincena==NULL){$quincena=0;}
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
<title>Escritorio.</title>
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
<style>
#t01 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#t01 td, #t01 th {
    border: 1px solid #ddd;
    padding: 8px;
}

#t01 tr:nth-child(even){background-color: #E7E7E8;}

#t01 tr:hover {background-color: #D6F4FF;}

#t01 th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #0866c6;
    color: white;
}
</style>
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
            
            <div class="pageicon"><span class="iconfa-home"></span></div>
            <div class="pagetitle">
                <h5>SSM - SERVICIOS DE SALUD MORELOS</h5>
                <h1>Reportes Quincenales</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            
            <div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span8">

                        <form method="GET" action="reportes.php">

                            <h3>Seleccionar Quincena</h3>
                                <select name="quincena" onchange="this.form.submit()">

                                  <option value="0">Seleccione</option>
                                  <option value="2015/">01-24-2015</option>
                                  <option value="2017/01-24 2017">01-24-2017</option>
                                  <option value="2018/">01-24-2018</option>
                                  <option value="2019/01-2019">01-2019</option>
                                  <option value="2019/02-2019">02-2019</option>
                                  <option value="2019/03-2019">03-2019</option>
                                  <option value="2019/04-2019">04-2019</option>
                                  <option value="2019/05-2019">05-2019</option>
                                  <option value="2019/06-2019">06-2019</option>
                                  <option value="2019/07-2019">07-2019</option>
                                  <option value="2019/08-2019">08-2019</option>
                                  <option value="2019/09-2019">09-2019</option>
                                  <option value="2019/10-2019">10-2019</option>
                                  <option value="2019/11-2019">11-2019</option>
                                  <option value="2019/12-2019">12-2019</option>
                                  <option value="2019/13-2019">13-2019</option>
                                  <option value="2019/14-2019">14-2019</option>
                                  <option value="2019/15-2019">15-2019</option>
                                  <option value="2019/16-2019">16-2019</option>
                                  <option value="2019/17-2019">17-2019</option>
                                  <option value="2019/18-2019">18-2019</option>
                                  <option value="2019/19-2019">19-2019</option>
                                  <option value="2019/20-2019">20-2019</option>
                                  <option value="2019/21-2019">21-2019</option>
                                  <option value="2019/22-2019">22-2019</option>
                                  <option value="2019/23-2019">23-2019</option>
                                  <option value="2019/24-2019">24-2019</option>

                            </select>


                        <table id="t01">
                             <tr>
                                <th>Archivos de quincena: <?php echo $quincena?></th>
                                      
                            </tr>
                            
                        <?php
                        function listar_archivos($carpeta){
                        if(is_dir($carpeta)){
                            if($dir = opendir($carpeta)){
                                while(($archivo = readdir($dir)) !== false){
                                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                        echo '<tr>';
                                        echo '<td><a target="_blank" href="'.$carpeta.'/'.$archivo.'">'.$archivo.'</a></td>';
                                        echo '</tr>';
                                    }
                                }
                                closedir($dir);
                            }
                        }
                    }
                     
                    echo listar_archivos('ftp://192.168.42.119/'.$quincena.''); 

                        ?>
                        </table>
                    </div>
                </div>


               
                               
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
