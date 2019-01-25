<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php header("Content-Type: text/html; charset=utf-8");?>
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

</script>
</head>
<body>



<?php
$unidad=$_GET['unidad'];
error_reporting(E_ALL ^ E_DEPRECATED);

$server = '192.168.42.25\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, 'Daniel', 'daniel2018');
mssql_select_db('SSMNOM', $link);

if (!$link) {
    die('Algo fue mal mientras se conectaba a MSSQL');
}


//$serverName = "192.168.42.25\SQLEXPRESS"; //serverName\instanceName
//$connectionInfo = array( "Database"=>"SSMNOM", "UID"=>"Daniel", "PWD"=>"daniel2018");
//$connect = sqlsrv_connect( $serverName, $connectionInfo);


//QUERY PARA SELECCIONAR LAS UR Y EL PRODUCTO (PRDO%, PRDE%, UNIDAD IN(URS), and QUINCENA >5 AND QUINCENA <=10 ->PARA LIMITAR LAS QUINCENAS)
//$sql = "SELECT * FROM TOTXPER WHERE NOMPROD NOT IN ('%%%P%') AND ANO=2017 AND STADO='A' AND UNIDAD IN('U01','415')  ORDER BY QUINCENA";
//EMPLEADOS.CLAVE, (SELECT B.CUENTA FROM EMPLEADOS B WHERE B.AFILIACION=A.EMPLEADO) AS CUENTA_OK


$sql = "SELECT A.* FROM TOTXPER A INNER JOIN EMPLEADOS ON A.EMPLEADO=EMPLEADOS.AFILIACION WHERE A.NOMPROD NOT IN ('%%%P%') AND A.ANO=2018 AND A.QUINCENA=5 AND A.STADO='A' AND A.UNIDAD IN ('$unidad') ORDER BY A.QUINCENA";

$stmt = mssql_query($sql,$link);
if( !mssql_num_rows($stmt)) {
    die( print_r( mssql_errors(), true) );
}



      echo "<h2>Resultado:</h2>";
                
 ?>
                     
                           
                         <h3>Datos</h3>
                         <h4>Ir hasta abajo para descargar</h4>
                        <TABLE id="t01">
                          
                         <TR>
                            <TH align="center">ID</TH>
                            <TH align="center">EMPLEADO</TH>
							<TH align="center">PERIODO</TH>
							<TH align="center">PERCEPCIONES</TH>
							<TH align="center">DEDUCCIONES</TH>
							<TH align="center">QUINCENA</TH>
							<TH align="center">DIASLAB</TH>
							<TH align="center">TRAILERS</TH>
							<TH align="center">NOMPROD</TH>
							<TH align="center">GRUPO</TH>
							<TH align="center">UNIDAD</TH>
							<TH align="center">FUNCION</TH>
							<TH align="center">SUBFUNCION</TH>
							<TH align="center">PROGRAMA</TH>
							<TH align="center">ACTIVIDAD</TH>
							<TH align="center">PROYECTO</TH>
							<TH align="center">PARTIDA</TH>
							<TH align="center">PUESTO</TH>
							<TH align="center">NUMPUES</TH>
							<TH align="center">ESTADO</TH>
							<TH align="center">MUNICIPIO</TH>
							<TH align="center">CENTRO</TH>
							<TH align="center">ANO</TH>
							<TH align="center">REFERENCIA</TH>
							<TH align="center">PERAPINI</TH>
							<TH align="center">PERAPFIN</TH>
							<TH align="center">CHEQUE</TH>
							<TH align="center">STADO</TH>
							<TH align="center">BANCO</TH>
							<TH align="center">CUENTA</TH>
							<TH align="center">NOMBRE</TH>
							<TH align="center">NUMCONT</TH>
							<TH align="center">FECTIMB</TH>
							<TH align="center">HORATIMB</TH>
							<TH align="center">FOLIOTIMB</TH>
							<TH align="center">CEDULA</TH>
							<TH align="center">PAGADURIA</TH>
							<TH align="center">AHISA</TH>
							<TH align="center">TABULADOR</TH>
							<TH align="center">NIVEL</TH>
							<TH align="center">RANGO</TH>
							<TH align="center">MANDO</TH>
							<TH align="center">HORARIO</TH>
							<TH align="center">PORCENTAJE</TH>
							<TH align="center">TIPTRAB</TH>
							<TH align="center">NIVPUES</TH>
							<TH align="center">AP_PATERNO</TH>
							<TH align="center">AP_MATERNO</TH>
							<TH align="center">NOMBRES</TH>
							<TH align="center">CURP</TH>
							<TH align="center">DIGVER</TH>
							<TH align="center">JORNADA</TH>
							<TH align="center">DIASP</TH>
							<TH align="center">CICLOF</TH>
							<TH align="center">NUMAPOR</TH>
							<TH align="center">ACUMF</TH>
							<TH align="center">FALTAS</TH>
							<TH align="center">CLUES</TH>
							<TH align="center">PORPEN01</TH>
							<TH align="center">PORPEN02</TH>
							<TH align="center">PORPEN03</TH>
							<TH align="center">PORPEN04</TH>
							<TH align="center">PORPEN05</TH>
							<TH align="center">ISSSTE</TH>
							<TH align="center">TIPOUNI</TH>
							<TH align="center">CRESPDES</TH>

							<TH align="center">P01</TH>
							<TH align="center">P02</TH>
							<TH align="center">P03</TH>
							<TH align="center">P04</TH>
							<TH align="center">P05</TH>
							<TH align="center">P07</TH>
							<TH align="center">P16</TH>
							<TH align="center">P17</TH>
							<TH align="center">P18</TH>
							<TH align="center">P19</TH>
							<TH align="center">P20</TH>
							<TH align="center">P21</TH>
							<TH align="center">P24</TH>
							<TH align="center">P26</TH>
							<TH align="center">P29</TH>
							<TH align="center">P30</TH>
							<TH align="center">P31</TH>
							<TH align="center">P32</TH>
							<TH align="center">P34</TH>
							<TH align="center">P35</TH>
							<TH align="center">P36</TH>
							<TH align="center">P37</TH>
							<TH align="center">P38</TH>
							<TH align="center">P39</TH>
							<TH align="center">P3D</TH>
							<TH align="center">P42</TH>
							<TH align="center">P44</TH>
							<TH align="center">P45</TH>
							<TH align="center">P46</TH>
							<TH align="center">P50</TH>
							<TH align="center">P51</TH>
							<TH align="center">P54</TH>
							<TH align="center">P55</TH>
							<TH align="center">P56</TH>
							<TH align="center">P57</TH>
							<TH align="center">P58</TH>
							<TH align="center">P59</TH>
							<TH align="center">P5A</TH>
							<TH align="center">P5B</TH>
							<TH align="center">P62</TH>
							<TH align="center">P64</TH>
							<TH align="center">P65</TH>
							<TH align="center">P66</TH>
							<TH align="center">P68</TH>
							<TH align="center">P69</TH>
							<TH align="center">P70</TH>
							<TH align="center">P72</TH>
							<TH align="center">P73</TH>
							<TH align="center">P74</TH>
							<TH align="center">P75</TH>
							<TH align="center">P76</TH>
							<TH align="center">P77</TH>
							<TH align="center">P81</TH>
							<TH align="center">P82</TH>
							<TH align="center">P83</TH>
							<TH align="center">P90</TH>
							<TH align="center">P95</TH>
							<TH align="center">P96</TH>
							<TH align="center">P99</TH>
							<TH align="center">PA1</TH>
							<TH align="center">PA2</TH>
							<TH align="center">PA3</TH>
							<TH align="center">PA4</TH>
							<TH align="center">PA5</TH>
							<TH align="center">PAS</TH>
							<TH align="center">PC1</TH>
							<TH align="center">PC2</TH>
							<TH align="center">PCH</TH>
							<TH align="center">PE4</TH>
							<TH align="center">PE8</TH>
							<TH align="center">PE9</TH>
							<TH align="center">PM1</TH>
							<TH align="center">PM2</TH>
							<TH align="center">PM3</TH>
							<TH align="center">PM9</TH>
							<TH align="center">PMR</TH>
							<TH align="center">PP1</TH>
							<TH align="center">PPP</TH>
							<TH align="center">PPR</TH>
							<TH align="center">PSE</TH>

							<TH align="center">D01</TH>
							<TH align="center">D02</TH>
							<TH align="center">D03</TH>
							<TH align="center">D04</TH>
							<TH align="center">D05</TH>
							<TH align="center">D07</TH>
							<TH align="center">D16</TH>
							<TH align="center">D17</TH>
							<TH align="center">D18</TH>
							<TH align="center">D19</TH>
							<TH align="center">D20</TH>
							<TH align="center">D21</TH>
							<TH align="center">D24</TH>
							<TH align="center">D26</TH>
							<TH align="center">D29</TH>
							<TH align="center">D30</TH>
							<TH align="center">D31</TH>
							<TH align="center">D32</TH>
							<TH align="center">D34</TH>
							<TH align="center">D35</TH>
							<TH align="center">D36</TH>
							<TH align="center">D37</TH>
							<TH align="center">D38</TH>
							<TH align="center">D39</TH>
							<TH align="center">D3D</TH>
							<TH align="center">D42</TH>
							<TH align="center">D44</TH>
							<TH align="center">D45</TH>
							<TH align="center">D46</TH>
							<TH align="center">D50</TH>
							<TH align="center">D51</TH>
							<TH align="center">D54</TH>
							<TH align="center">D55</TH>
							<TH align="center">D56</TH>
							<TH align="center">D57</TH>
							<TH align="center">D58</TH>
							<TH align="center">D59</TH>
							<TH align="center">D5A</TH>
							<TH align="center">D5B</TH>
							<TH align="center">D62</TH>
							<TH align="center">D64</TH>
							<TH align="center">D65</TH>
							<TH align="center">D66</TH>
							<TH align="center">D68</TH>
							<TH align="center">D69</TH>
							<TH align="center">D70</TH>
							<TH align="center">D72</TH>
							<TH align="center">D73</TH>
							<TH align="center">D74</TH>
							<TH align="center">D75</TH>
							<TH align="center">D76</TH>
							<TH align="center">D77</TH>
							<TH align="center">D81</TH>
							<TH align="center">D82</TH>
							<TH align="center">D83</TH>
							<TH align="center">D90</TH>
							<TH align="center">D95</TH>
							<TH align="center">D96</TH>
							<TH align="center">D99</TH>
							<TH align="center">DA1</TH>
							<TH align="center">DA2</TH>
							<TH align="center">DA3</TH>
							<TH align="center">DA4</TH>
							<TH align="center">DA5</TH>
							<TH align="center">DAS</TH>
							<TH align="center">DC1</TH>
							<TH align="center">DC2</TH>
							<TH align="center">DCH</TH>
							<TH align="center">DE4</TH>
							<TH align="center">DE8</TH>
							<TH align="center">DE9</TH>
							<TH align="center">DM1</TH>
							<TH align="center">DM2</TH>
							<TH align="center">DM3</TH>
							<TH align="center">DM9</TH>
							<TH align="center">DMR</TH>
							<TH align="center">DP1</TH>
							<TH align="center">DPP</TH>
							<TH align="center">DPR</TH>
							<TH align="center">DSE</TH>




                         </TR>
                <?php



                    while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {

                    		
							//VARIABLES INDEPENDIENTES PARA MOVXPER
							
							$id=$row['ID'];

							//Variables para TOTXPER
                         	$EMPLEADO=$row['EMPLEADO'];
							$PERIODO=$row['PERIODO'];
							$PERCEPCIONES=$row['PERCEPCIONES'];
							$DEDUCCIONES=$row['DEDUCCIONES'];
							$QUINCENA=$row['QUINCENA'];
							$DIASLAB=$row['DIASLAB'];
							$TRAILERS=$row['TRAILERS'];
							$NOMPROD=$row['NOMPROD'];
							$GRUPO=$row['GRUPO'];
							$UNIDAD=$row['UNIDAD'];
							$FUNCION=$row['FUNCION'];
							$SUBFUNCION=$row['SUBFUNCION'];
							$PROGRAMA=$row['PROGRAMA'];
							$ACTIVIDAD=$row['ACTIVIDAD'];
							$PROYECTO=$row['PROYECTO'];
							$PARTIDA=$row['PARTIDA'];
							$PUESTO=$row['PUESTO'];
							$NUMPUES=$row['NUMPUES'];
							$ESTADO=$row['ESTADO'];
							$MUNICIPIO=$row['MUNICIPIO'];
							$CENTRO=$row['CENTRO'];
							$ANO=$row['ANO'];
							$REFERENCIA=$row['REFERENCIA'];
							$PERAPINI=$row['PERAPINI'];
							$PERAPFIN=$row['PERAPFIN'];
							$CHEQUE=$row['CHEQUE'];
							$STADO=$row['STADO'];
							$BANCO=$row['BANCO'];
							$CUENTA=$row['CUENTA'];
							$NOMBRE=$row['NOMBRE'];
							$NUMCONT=$row['NUMCONT'];
							$FECTIMB=$row['FECTIMB'];
							$HORATIMB=$row['HORATIMB'];
							$FOLIOTIMB=$row['FOLIOTIMB'];
							$CEDULA=$row['CEDULA'];
							$PAGADURIA=$row['PAGADURIA'];
							$AHISA=$row['AHISA'];
							$TABULADOR=$row['TABULADOR'];
							$NIVEL=$row['NIVEL'];
							$RANGO=$row['RANGO'];
							$MANDO=$row['MANDO'];
							$HORARIO=$row['HORARIO'];
							$PORCENTAJE=$row['PORCENTAJE'];
							$TIPTRAB=$row['TIPTRAB'];
							$NIVPUES=$row['NIVPUES'];
							$AP_PATERNO=$row['AP_PATERNO'];
							$AP_MATERNO=$row['AP_MATERNO'];
							$NOMBRES=$row['NOMBRES'];
							$CURP=$row['CURP'];
							$DIGVER=$row['DIGVER'];
							$JORNADA=$row['JORNADA'];
							$DIASP=$row['DIASP'];
							$CICLOF=$row['CICLOF'];
							$NUMAPOR=$row['NUMAPOR'];
							$ACUMF=$row['ACUMF'];
							$FALTAS=$row['FALTAS'];
							$CLUES=$row['CLUES'];
							$PORPEN01=$row['PORPEN01'];
							$PORPEN02=$row['PORPEN02'];
							$PORPEN03=$row['PORPEN03'];
							$PORPEN04=$row['PORPEN04'];
							$PORPEN05=$row['PORPEN05'];
							$ISSSTE=$row['ISSSTE'];
							$TIPOUNI=$row['TIPOUNI'];
							$CRESPDES=$row['CRESPDES'];
							



                          

                ?>
                            <TR>
                             <td><?php echo $id;?></td>
                             <td><?php echo $EMPLEADO;?></td>
							 <td><?php echo $PERIODO;?></td>
							 <td><?php echo $PERCEPCIONES;?></td>
							 <td><?php echo $DEDUCCIONES;?></td>
							 <td><?php echo $QUINCENA;?></td>
							 <td><?php echo $DIASLAB;?></td>
							 <td><?php echo $TRAILERS;?></td>
							 <td><?php echo $NOMPROD;?></td>
							 <td><?php echo $GRUPO;?></td>
							 <td><?php echo $UNIDAD;?></td>
							 <td><?php echo $FUNCION;?></td>
							 <td><?php echo $SUBFUNCION;?></td>
							 <td><?php echo $PROGRAMA;?></td>
							 <td><?php echo $ACTIVIDAD;?></td>
							 <td><?php echo $PROYECTO;?></td>
							 <td><?php echo $PARTIDA;?></td>
							 <td><?php echo $PUESTO;?></td>
							 <td><?php echo $NUMPUES;?></td>
							 <td><?php echo $ESTADO;?></td>
							 <td><?php echo $MUNICIPIO;?></td>
							 <td><?php echo $CENTRO;?></td>
							 <td><?php echo $ANO;?></td>
							 <td><?php echo $REFERENCIA;?></td>
							 <td><?php echo $PERAPINI;?></td>
							 <td><?php echo $PERAPFIN;?></td>
							 <td><?php echo $CHEQUE;?></td>
							 <td><?php echo $STADO;?></td>
							 <td><?php echo $BANCO;?></td>
							 <td><?php echo $CUENTA;?></td>
							 <td><?php echo $NOMBRE;?></td>
							 <td><?php echo $NUMCONT;?></td>
							 <td><?php echo $FECTIMB;?></td>
							 <td><?php echo $HORATIMB;?></td>
							 <td><?php echo $FOLIOTIMB;?></td>
							 <td><?php echo $CEDULA;?></td>
							 <td><?php echo $PAGADURIA;?></td>
							 <td><?php echo $AHISA;?></td>
							 <td><?php echo $TABULADOR;?></td>
							 <td><?php echo $NIVEL;?></td>
							 <td><?php echo $RANGO;?></td>
							 <td><?php echo $MANDO;?></td>
							 <td><?php echo $HORARIO;?></td>
							 <td><?php echo $PORCENTAJE;?></td>
							 <td><?php echo $TIPTRAB;?></td>
							 <td><?php echo $NIVPUES;?></td>
							 <td><?php echo $AP_PATERNO;?></td>
							 <td><?php echo $AP_MATERNO;?></td>
							 <td><?php echo $NOMBRES;?></td>
							 <td><?php echo $CURP;?></td>
							 <td><?php echo $DIGVER;?></td>
							 <td><?php echo $JORNADA;?></td>
							 <td><?php echo $DIASP;?></td>
							 <td><?php echo $CICLOF;?></td>
							 <td><?php echo $NUMAPOR;?></td>
							 <td><?php echo $ACUMF;?></td>
							 <td><?php echo $FALTAS;?></td>
							 <td><?php echo $CLUES;?></td>
							 <td><?php echo $PORPEN01;?></td>
							 <td><?php echo $PORPEN02;?></td>
							 <td><?php echo $PORPEN03;?></td>
							 <td><?php echo $PORPEN04;?></td>
							 <td><?php echo $PORPEN05;?></td>
							 <td><?php echo $ISSSTE;?></td>
							 <td><?php echo $TIPOUNI;?></td>
							 <td><?php echo $CRESPDES;?></td>

						<?php
						$P01=0;
									$P02=0;
									$P03=0;
									$P04=0;
									$P05=0;
									$P07=0;
									$P16=0;
									$P17=0;
									$P18=0;
									$P19=0;
									$P20=0;
									$P21=0;
									$P24=0;
									$P26=0;
									$P29=0;
									$P30=0;
									$P31=0;
									$P32=0;
									$P34=0;
									$P35=0;
									$P36=0;
									$P37=0;
									$P38=0;
									$P39=0;
									$P3D=0;
									$P42=0;
									$P44=0;
									$P45=0;
									$P46=0;
									$P50=0;
									$P51=0;
									$P54=0;
									$P55=0;
									$P56=0;
									$P57=0;
									$P58=0;
									$P59=0;
									$P5A=0;
									$P5B=0;
									$P62=0;
									$P64=0;
									$P65=0;
									$P66=0;
									$P68=0;
									$P69=0;
									$P70=0;
									$P72=0;
									$P73=0;
									$P74=0;
									$P75=0;
									$P76=0;
									$P77=0;
									$P81=0;
									$P82=0;
									$P83=0;
									$P90=0;
									$P95=0;
									$P96=0;
									$P99=0;
									$PA1=0;
									$PA2=0;
									$PA3=0;
									$PA4=0;
									$PA5=0;
									$PAS=0;
									$PC1=0;
									$PC2=0;
									$PCH=0;
									$PE4=0;
									$PE8=0;
									$PE9=0;
									$PM1=0;
									$PM2=0;
									$PM3=0;
									$PM9=0;
									$PMR=0;
									$PP1=0;
									$PPP=0;
									$PPR=0;
									$PSE=0;
									$D02=0;
									$D03=0;
									$D04=0;
									$D05=0;
									$D07=0;
									$D16=0;
									$D17=0;
									$D18=0;
									$D19=0;
									$D20=0;
									$D21=0;
									$D24=0;
									$D26=0;
									$D29=0;
									$D30=0;
									$D31=0;
									$D32=0;
									$D34=0;
									$D35=0;
									$D36=0;
									$D37=0;
									$D38=0;
									$D39=0;
									$D3D=0;
									$D42=0;
									$D44=0;
									$D45=0;
									$D46=0;
									$D50=0;
									$D51=0;
									$D54=0;
									$D55=0;
									$D56=0;
									$D57=0;
									$D58=0;
									$D59=0;
									$D5A=0;
									$D5B=0;
									$D62=0;
									$D64=0;
									$D65=0;
									$D66=0;
									$D68=0;
									$D69=0;
									$D70=0;
									$D72=0;
									$D73=0;
									$D74=0;
									$D75=0;
									$D76=0;
									$D77=0;
									$D81=0;
									$D82=0;
									$D83=0;
									$D90=0;
									$D95=0;
									$D96=0;
									$D99=0;
									$DA1=0;
									$DA2=0;
									$DA3=0;
									$DA4=0;
									$DA5=0;
									$DAS=0;
									$DC1=0;
									$DC2=0;
									$DCH=0;
									$DE4=0;
									$DE8=0;
									$DE9=0;
									$DM1=0;
									$DM2=0;
									$DM3=0;
									$DM9=0;
									$DMR=0;
									$DP1=0;
									$DPP=0;
									$DPR=0;
									$DSE=0;
						$sql_per = "SELECT TIPO,CONCEPTO,IMPORTE FROM MOVXPER WHERE ID='".$id."';";
							$stmt2 = mssql_query($sql_per,$link);

							while (($per = mssql_fetch_array($stmt2, MSSQL_BOTH))) {

									

										if ($per['TIPO']=='1' && $per['CONCEPTO']=='01') { $P01=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='02') { $P02=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='03') { $P03=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='04') { $P04=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='05') { $P05=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='07') { $P07=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='16') { $P16=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='17') { $P17=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='18') { $P18=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='19') { $P19=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='20') { $P20=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='21') { $P21=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='24') { $P24=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='26') { $P26=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='29') { $P29=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='30') { $P30=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='31') { $P31=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='32') { $P32=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='34') { $P34=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='35') { $P35=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='36') { $P36=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='37') { $P37=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='38') { $P38=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='39') { $P39=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='3D') { $P3D=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='42') { $P42=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='44') { $P44=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='45') { $P45=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='46') { $P46=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='50') { $P50=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='51') { $P51=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='54') { $P54=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='55') { $P55=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='56') { $P56=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='57') { $P57=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='58') { $P58=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='59') { $P59=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='5A') { $P5A=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='5B') { $P5B=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='62') { $P62=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='64') { $P64=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='65') { $P65=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='66') { $P66=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='68') { $P68=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='69') { $P69=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='70') { $P70=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='72') { $P72=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='73') { $P73=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='74') { $P74=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='75') { $P75=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='76') { $P76=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='77') { $P77=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='81') { $P81=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='82') { $P82=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='83') { $P83=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='90') { $P90=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='95') { $P95=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='96') { $P96=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='99') { $P99=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='A1') { $PA1=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='A2') { $PA2=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='A3') { $PA3=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='A4') { $PA4=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='A5') { $PA5=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='AS') { $PAS=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='C1') { $PC1=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='C2') { $PC2=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='CH') { $PCH=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='E4') { $PE4=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='E8') { $PE8=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='E9') { $PE9=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='M1') { $PM1=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='M2') { $PM2=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='M3') { $PM3=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='M9') { $PM9=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='MR') { $PMR=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='P1') { $PP1=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='PP') { $PPP=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='PR') { $PPR=$per['IMPORTE'];}
										if ($per['TIPO']=='1' && $per['CONCEPTO']=='SE') { $PSE=$per['IMPORTE'];}

										if ($per['TIPO']=='2' && $per['CONCEPTO']=='01') { $D01=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='02') { $D02=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='03') { $D03=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='04') { $D04=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='05') { $D05=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='07') { $D07=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='16') { $D16=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='17') { $D17=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='18') { $D18=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='19') { $D19=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='20') { $D20=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='21') { $D21=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='24') { $D24=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='26') { $D26=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='29') { $D29=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='30') { $D30=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='31') { $D31=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='32') { $D32=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='34') { $D34=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='35') { $D35=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='36') { $D36=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='37') { $D37=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='38') { $D38=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='39') { $D39=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='3D') { $D3D=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='42') { $D42=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='44') { $D44=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='45') { $D45=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='46') { $D46=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='50') { $D50=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='51') { $D51=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='54') { $D54=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='55') { $D55=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='56') { $D56=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='57') { $D57=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='58') { $D58=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='59') { $D59=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='5A') { $D5A=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='5B') { $D5B=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='62') { $D62=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='64') { $D64=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='65') { $D65=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='66') { $D66=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='68') { $D68=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='69') { $D69=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='70') { $D70=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='72') { $D72=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='73') { $D73=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='74') { $D74=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='75') { $D75=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='76') { $D76=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='77') { $D77=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='81') { $D81=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='82') { $D82=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='83') { $D83=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='90') { $D90=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='95') { $D95=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='96') { $D96=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='99') { $D99=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='A1') { $DA1=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='A2') { $DA2=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='A3') { $DA3=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='A4') { $DA4=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='A5') { $DA5=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='AS') { $DAS=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='C1') { $DC1=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='C2') { $DC2=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='CH') { $DCH=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='E4') { $DE4=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='E8') { $DE8=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='E9') { $DE9=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='M1') { $DM1=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='M2') { $DM2=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='M3') { $DM3=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='M9') { $DM9=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='MR') { $DMR=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='P1') { $DP1=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='PP') { $DPP=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='PR') { $DPR=$per['IMPORTE'];}
										if ($per['TIPO']=='2' && $per['CONCEPTO']=='SE') { $DSE=$per['IMPORTE'];}

                        		
                        	}
							?>
                        	            <td><?php echo $P01;?></td>
										<td><?php echo $P02;?></td>
										<td><?php echo $P03;?></td>
										<td><?php echo $P04;?></td>
										<td><?php echo $P05;?></td>
										<td><?php echo $P07;?></td>
										<td><?php echo $P16;?></td>
										<td><?php echo $P17;?></td>
										<td><?php echo $P18;?></td>
										<td><?php echo $P19;?></td>
										<td><?php echo $P20;?></td>
										<td><?php echo $P21;?></td>
										<td><?php echo $P24;?></td>
										<td><?php echo $P26;?></td>
										<td><?php echo $P29;?></td>
										<td><?php echo $P30;?></td>
										<td><?php echo $P31;?></td>
										<td><?php echo $P32;?></td>
										<td><?php echo $P34;?></td>
										<td><?php echo $P35;?></td>
										<td><?php echo $P36;?></td>
										<td><?php echo $P37;?></td>
										<td><?php echo $P38;?></td>
										<td><?php echo $P39;?></td>
										<td><?php echo $P3D;?></td>
										<td><?php echo $P42;?></td>
										<td><?php echo $P44;?></td>
										<td><?php echo $P45;?></td>
										<td><?php echo $P46;?></td>
										<td><?php echo $P50;?></td>
										<td><?php echo $P51;?></td>
										<td><?php echo $P54;?></td>
										<td><?php echo $P55;?></td>
										<td><?php echo $P56;?></td>
										<td><?php echo $P57;?></td>
										<td><?php echo $P58;?></td>
										<td><?php echo $P59;?></td>
										<td><?php echo $P5A;?></td>
										<td><?php echo $P5B;?></td>
										<td><?php echo $P62;?></td>
										<td><?php echo $P64;?></td>
										<td><?php echo $P65;?></td>
										<td><?php echo $P66;?></td>
										<td><?php echo $P68;?></td>
										<td><?php echo $P69;?></td>
										<td><?php echo $P70;?></td>
										<td><?php echo $P72;?></td>
										<td><?php echo $P73;?></td>
										<td><?php echo $P74;?></td>
										<td><?php echo $P75;?></td>
										<td><?php echo $P76;?></td>
										<td><?php echo $P77;?></td>
										<td><?php echo $P81;?></td>
										<td><?php echo $P82;?></td>
										<td><?php echo $P83;?></td>
										<td><?php echo $P90;?></td>
										<td><?php echo $P95;?></td>
										<td><?php echo $P96;?></td>
										<td><?php echo $P99;?></td>
										<td><?php echo $PA1;?></td>
										<td><?php echo $PA2;?></td>
										<td><?php echo $PA3;?></td>
										<td><?php echo $PA4;?></td>
										<td><?php echo $PA5;?></td>
										<td><?php echo $PAS;?></td>
										<td><?php echo $PC1;?></td>
										<td><?php echo $PC2;?></td>
										<td><?php echo $PCH;?></td>
										<td><?php echo $PE4;?></td>
										<td><?php echo $PE8;?></td>
										<td><?php echo $PE9;?></td>
										<td><?php echo $PM1;?></td>
										<td><?php echo $PM2;?></td>
										<td><?php echo $PM3;?></td>
										<td><?php echo $PM9;?></td>
										<td><?php echo $PMR;?></td>
										<td><?php echo $PP1;?></td>
										<td><?php echo $PPP;?></td>
										<td><?php echo $PPR;?></td>
										<td><?php echo $PSE;?></td>
							
										<td><?php echo $D01;?></td>
										<td><?php echo $D02;?></td>
										<td><?php echo $D03;?></td>
										<td><?php echo $D04;?></td>
										<td><?php echo $D05;?></td>
										<td><?php echo $D07;?></td>
										<td><?php echo $D16;?></td>
										<td><?php echo $D17;?></td>
										<td><?php echo $D18;?></td>
										<td><?php echo $D19;?></td>
										<td><?php echo $D20;?></td>
										<td><?php echo $D21;?></td>
										<td><?php echo $D24;?></td>
										<td><?php echo $D26;?></td>
										<td><?php echo $D29;?></td>
										<td><?php echo $D30;?></td>
										<td><?php echo $D31;?></td>
										<td><?php echo $D32;?></td>
										<td><?php echo $D34;?></td>
										<td><?php echo $D35;?></td>
										<td><?php echo $D36;?></td>
										<td><?php echo $D37;?></td>
										<td><?php echo $D38;?></td>
										<td><?php echo $D39;?></td>
										<td><?php echo $D3D;?></td>
										<td><?php echo $D42;?></td>
										<td><?php echo $D44;?></td>
										<td><?php echo $D45;?></td>
										<td><?php echo $D46;?></td>
										<td><?php echo $D50;?></td>
										<td><?php echo $D51;?></td>
										<td><?php echo $D54;?></td>
										<td><?php echo $D55;?></td>
										<td><?php echo $D56;?></td>
										<td><?php echo $D57;?></td>
										<td><?php echo $D58;?></td>
										<td><?php echo $D59;?></td>
										<td><?php echo $D5A;?></td>
										<td><?php echo $D5B;?></td>
										<td><?php echo $D62;?></td>
										<td><?php echo $D64;?></td>
										<td><?php echo $D65;?></td>
										<td><?php echo $D66;?></td>
										<td><?php echo $D68;?></td>
										<td><?php echo $D69;?></td>
										<td><?php echo $D70;?></td>
										<td><?php echo $D72;?></td>
										<td><?php echo $D73;?></td>
										<td><?php echo $D74;?></td>
										<td><?php echo $D75;?></td>
										<td><?php echo $D76;?></td>
										<td><?php echo $D77;?></td>
										<td><?php echo $D81;?></td>
										<td><?php echo $D82;?></td>
										<td><?php echo $D83;?></td>
										<td><?php echo $D90;?></td>
										<td><?php echo $D95;?></td>
										<td><?php echo $D96;?></td>
										<td><?php echo $D99;?></td>
										<td><?php echo $DA1;?></td>
										<td><?php echo $DA2;?></td>
										<td><?php echo $DA3;?></td>
										<td><?php echo $DA4;?></td>
										<td><?php echo $DA5;?></td>
										<td><?php echo $DAS;?></td>
										<td><?php echo $DC1;?></td>
										<td><?php echo $DC2;?></td>
										<td><?php echo $DCH;?></td>
										<td><?php echo $DE4;?></td>
										<td><?php echo $DE8;?></td>
										<td><?php echo $DE9;?></td>
										<td><?php echo $DM1;?></td>
										<td><?php echo $DM2;?></td>
										<td><?php echo $DM3;?></td>
										<td><?php echo $DM9;?></td>
										<td><?php echo $DMR;?></td>
										<td><?php echo $DP1;?></td>
										<td><?php echo $DPP;?></td>
										<td><?php echo $DPR;?></td>
										<td><?php echo $DSE;?></td>
                       
								<?php
							    unset($EMPLEADO);
								unset($PERIODO);
								unset($PERCEPCIONES);
								unset($DEDUCCIONES);
								unset($QUINCENA);
								unset($DIASLAB);
								unset($TRAILERS);
								unset($NOMPROD);
								unset($GRUPO);
								unset($UNIDAD);
								unset($FUNCION);
								unset($SUBFUNCION);
								unset($PROGRAMA);
								unset($ACTIVIDAD);
								unset($PROYECTO);
								unset($PARTIDA);
								unset($PUESTO);
								unset($NUMPUES);
								unset($ESTADO);
								unset($MUNICIPIO);
								unset($CENTRO);
								unset($ANO);
								unset($REFERENCIA);
								unset($PERAPINI);
								unset($PERAPFIN);
								unset($CHEQUE);
								unset($STADO);
								unset($BANCO);
								unset($CUENTA);
								unset($NOMBRE);
								unset($NUMCONT);
								unset($FECTIMB);
								unset($HORATIMB);
								unset($FOLIOTIMB);
								unset($CEDULA);
								unset($PAGADURIA);
								unset($AHISA);
								unset($TABULADOR);
								unset($NIVEL);
								unset($RANGO);
								unset($MANDO);
								unset($HORARIO);
								unset($PORCENTAJE);
								unset($TIPTRAB);
								unset($NIVPUES);
								unset($AP_PATERNO);
								unset($AP_MATERNO);
								unset($NOMBRES);
								unset($CURP);
								unset($DIGVER);
								unset($JORNADA);
								unset($DIASP);
								unset($CICLOF);
								unset($NUMAPOR);
								unset($ACUMF);
								unset($FALTAS);
								unset($CLUES);
								unset($PORPEN01);
								unset($PORPEN02);
								unset($PORPEN03);
								unset($PORPEN04);
								unset($PORPEN05);
								unset($ISSSTE);
								unset($TIPOUNI);
								unset($CRESPDES);


                            }
                            ?> 
                            <TR>                         
                        </TABLE>  
                        <br>
                        <br>
                   
                    
                     <?php
                       
                
                    mssql_free_result($stmt);
                    mssql_free_result($stmt2);
                    mssql_close($link); 

                ?>    

<a href="#" onclick="exportTableToCSV('tabla.csv')">Descargar Tabla (csv-Excel)</a> 
</body>
</html>