<?php
include 'conexion.php';
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
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        
        jQuery('#dyntable2').dataTable( {
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "400px"
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
            
            <div class="pageicon"><span class="iconfa-home"></span></div>
            <div class="pagetitle">
                <h5>SSM - SERVICIOS DE SALUD MORELOS</h5>
                <h1>CONTROL DE DSP</h1>
            </div>
        </div><!--pageheader-->
        
        
        <div class="maincontent">
            <div class="maincontentinner">
                
  

                        <form method="GET" action="dsps.php">

                            <h3>Seleccionar Quincena</h3>
                                <select name="quincena" onchange="this.form.submit()">
                                  <option value="0">Seleccione</option>
                                  <option value="1">1-2019</option>
                                  <option value="2">2-2019</option>
                                  <option value="3">3-2019</option>
                                  <option value="4">4-2019</option>
                                  <option value="5">5-2019</option>
                                  <option value="6">6-2019</option>
                                  <option value="7">7-2019</option>
                                  <option value="8">8-2019</option>
                                  <option value="9">9-2019</option>
                                  <option value="10">10-2019</option>
                                  <option value="11">11-2019</option>
                                  <option value="12">12-2019</option>
                            </select>


                         <h4 class="widgettitle">DSP´s de quincena: <?php echo $quincena?></h4>
                          <table class="table table-bordered table-infinite" id="dyntable2">
                             <colgroup>
                                <col class="con0" style="align: center; width: 4%" />
                                <col class="con1" />
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con0" />
                            </colgroup>
                            <thead>
                            <tr>
                              <th class="head0">DSP</th>
                              <th class="head1">Año</th>
                              <th class="head0">Quincena</th>
                              <th class="head1">Nómina</th>
                              <th class="head0">Referencia</th>
                              <th class="head1">UR</th>
                              <th class="head0">Productos</th>
                              <th class="head1">Fecha</th>
                              <th class="head0">Programa</th>
                              <th class="head1">Presupuesto</th>
                              <th class="head0">Cuenta Emisora</th>
                              <th class="head1">Cuenta</th>
                              <th class="head0">Total Cuentas</th>
                              <th class="head1">Total Cheques</th>
                              <th class="head0">PDF</th>
                            </tr>
                            </thead>
                        <tbody>
                            
                        <?php
                        if ($quincena>0) {
                        $selected2 = mssql_select_db('COMUN', $link2) or die("Algo fue mal mientras se conectaba a MSSQL"); 
                        $sql="SELECT * FROM dsp where ano=2019 and quincena=$quincena and stado='A' order by DSP";
                        $stmt = mssql_query($sql);
                              while (($datos = mssql_fetch_array($stmt, MSSQL_BOTH))) {
                                        
                                        $anio=$datos['ano'];
                                        $qna=$datos['quincena'];
                                        $ref=$datos['referencia'];
                                        $ref_nom=$datos['ref_nom'];
                                        $ur=$datos['unidad'];
                                        $prod=$datos['productos'];
                                        $dsp=$datos['DSP'];
                                        $fecha=$datos['fecha'];
                                        $nom_pre=$datos['nombre_presup'];
                                        $presup=$datos['presup'];
                                        $cta_emi=$datos['emisora'];
                                        $cta=$datos['cuenta'];
                                        $ctas=$datos['cuentas'];
                                        $cheq=$datos['cheques'];
                                        $pdf=$datos['archivo_pdf'];
                                        $prod=str_replace(",", ", ", $prod);
                                ?>

                                <tr class="gradeA">
                                 <td><?php echo $dsp;?></td>
                                 <td><?php echo $anio;?></td>
                                 <td><?php echo $qna;?></td>
                                 <td><?php echo $ref;?></td>
                                 <td><?php echo $ref_nom;?></td>
                                 <td><?php echo $ur;?></td>
                                 <td><?php echo $prod;?></td>
                                 <td><?php echo $fecha;?></td>
                                 <td><?php echo $nom_pre;?></td>
                                 <td><?php echo $presup;?></td>
                                 <td><?php echo $cta_emi;?></td>
                                 <td><?php echo $cta;?></td>
                                 <td><?php echo "$".$ctas;?></td>
                                 <td><?php echo "$".$cheq;?></td>
                                 <td><?php echo $pdf;?></td>
                                </tr>


                        <?php        
                              }
                        }
                        if ($quincena==0) {
                          echo "Selecciona una quincena";
                        }
                        ?>


                        </tbody>
                        </table>
                    
               


               
                               
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
</html>
