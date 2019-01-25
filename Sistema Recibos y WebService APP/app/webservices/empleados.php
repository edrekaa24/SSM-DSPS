<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT');
header('Content-type: application/json');


include("conexion.php");
//Escribimos la sentencia SQL que ejecutaremos.
$sql = "SELECT MAX(QUINCENA) as QUINCENA, ANO FROM TOTXPER WHERE ANO=(SELECT MAX(ANO) FROM TOTXPER) GROUP BY ANO";

//Ejecutamos la sentencia SQL
$stmt = mssql_query($sql,$link);

if( !mssql_num_rows($stmt)) {
   echo json_encode("fail");
}

else {
   

        while (($row = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
            $ano=$row['ANO'];
            $qna=utf8_encode($row['QUINCENA']);
        }
        

        $sql2 = "SELECT count(DISTINCT empleado) as tot_emp from TOTXPER,EMPLEADOS where TOTXPER.QUINCENA=12 and TOTXPER.ANO=$ano and TOTXPER.STADO='A' AND TOTXPER.EMPLEADO=EMPLEADOS.AFILIACION and TOTXPER.ref_nom NOT IN ('PAS','UNE')";
        $stmt2 = mssql_query($sql2,$link); 

        while (($row2 = mssql_fetch_array($stmt2, MSSQL_BOTH)))  {
            $tot_emp=$row2['tot_emp']; 
                     
        }

        $sql3="SELECT count(DISTINCT empleado) as tot_ref, ref_nom from TOTXPER,EMPLEADOS where TOTXPER.QUINCENA=12 and TOTXPER.ANO=2018 and TOTXPER.STADO='A' AND TOTXPER.EMPLEADO=EMPLEADOS.AFILIACION and TOTXPER.ref_nom NOT IN ('PAS','UNE') group by ref_nom";
        $stmt3=mssql_query($sql3,$link); 
         while (($row3 = mssql_fetch_array($stmt3, MSSQL_BOTH)))  {
            $tot_ref=$row3['tot_ref'];   
            $ref_nom=$row3['ref_nom'];   
            $datos="<tr><td style='border: 1px solid black; text-align: center;'>$ref_nom</td>";
            $datos2="<td style='border: 1px solid black; text-align: center;'>$tot_ref</td></tr>";
            $datos3=$datos3.$datos.$datos2;       
        }

            $tab_ini="<TABLE style='border: 1px solid black; text-align: left; width: 100%;'>
                            <TR> 
                                <TH style='border: 1px solid black; text-align: center;'>CATEGORIA</TH>
                                <TH style='border: 1px solid black; text-align: center;'>EMPLEADOS</TH>
                            </TR>";

            $tab_fin="</TABLE>";

            $t_total="<br>
                      <h3> TOTAL DE EMPLEADOS:   $tot_emp</h3>";
            $qna_rep="<h4>QUINCENA: $qna     -     AÑO: $ano</h4> <br>";

            
            $datos=$qna_rep.$tab_ini.$datos3.$tab_fin.$t_total;

            echo json_encode("$datos");

       
}
mssql_close($link); 

?>

                                          









                                            