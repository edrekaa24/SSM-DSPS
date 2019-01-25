<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT');
header('Content-type: application/json');

//Recibimos los valores que intrujo el usuario desde el formulario.
$rfc= $_REQUEST["rfc_emp"];

//$curp = $_POST["password"];
//Creamos la conexión a la BD

include("conexion.php");
//Escribimos la sentencia SQL que ejecutaremos.
$sql = "SELECT TOP 1 TOTXPER.*, Nomina.nomina,EMPLEADOS.FECINIC FROM TOTXPER,Nomina,EMPLEADOS WHERE EMPLEADO LIKE '".$rfc."' AND TOTXPER.STADO NOT IN ('PP') and nomina.siglas=TOTXPER.ref_nom AND EMPLEADOS.AFILIACION=TOTXPER.EMPLEADO ORDER BY ANO DESC , QUINCENA DESC";

//Ejecutamos la sentencia SQL
$stmt = mssql_query($sql,$link);
if( !mssql_num_rows($stmt)) {
   echo json_encode("fail");
}

else {
   

        while (($datos = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
                                        $nombre1=utf8_encode($datos['NOMBRES']);
                                        $ap_pat=utf8_encode($datos['AP_PATERNO']);
                                        $ap_mat=utf8_encode($datos['AP_MATERNO']);
                                        $nombre_emp=$nombre1." ".$ap_pat." ".$ap_mat;
                                        $puesto=$datos['PUESTO'];
                                        $curp=$datos['CURP'];
                                        $cve_centro=$datos['CENTRO'];
                                        $centro=$datos['CRESPDES'];
                                        $nomina=$datos['nomina'];
                                        $cuenta=$datos['CUENTA'];
                                        $fechini=$datos['FECINIC'];
                                        $percepciones=$datos['PERCEPCIONES'];
                                        $deducciones=$datos['DEDUCCIONES'];
                                        $neto=$percepciones-$deducciones;
        }
            //Contamos el numero de filas que arroja la sentencia SQL
            //Solo arrojará el "id_usuario" en caso de que los datos introducidos por el usuario sean correctos
            //Por tanto arrojará mas de -0- filas y eso nos indicará que los datos son correctos

                         $text="<h4><b>Nombre(s):               </b>$nombre_emp</h4>
                                <h4><b>CURP:                    </b>$curp</h4>
                                <h4><b>PUESTO:                  </b>$puesto</h4>
                                <h4><b>CLAVE CTRO TRABAJO:      </b>$cve_centro</h4>
                                <h4><b>CENTRO DE TRABAJO:       </b>$centro</h4>
                                <h4><b>NOMINA:                  </b>$nomina</h4>
                                <h4><b>CUENTA:                  </b>$cuenta</h4>
                                <h4><b>FECHA DE INGRESO A LA DEPENDENCIA:        </b>$fechini</h4>
                                <h4><b>PERCEPCIONES: $                 </b>".number_format($percepciones,2)."</h4>
                                <h4><b>DEDUCCIONES: $                 </b>".number_format($deducciones,2)."</h4>
                                <h4><b>NETO: $                 </b>".number_format($neto,2)."</h4>";
            //Establecemos la cookie para matener la sesión abierta.
            //setcookie("misitio_userid","$id_usuario",time() + 365 * 24 * 60 * 60);
            //hacemos la redirección al archivo que evalua si se inicio sesión o no.

            echo json_encode("$text");
        
}
mssql_close($link); 

?>