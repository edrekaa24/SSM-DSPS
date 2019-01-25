<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT');
header('Content-type: application/json');

//Recibimos los valores que intrujo el usuario desde el formulario.
$USUARIO= $_REQUEST["username"];
$CLAVE = $_REQUEST["password"];
//$curp = $_POST["password"];
//Creamos la conexión a la BD

include("conexion.php");
//Escribimos la sentencia SQL que ejecutaremos.
$sql = "SELECT * FROM USUARIOS WHERE usuario='".$USUARIO."' AND clave = '".$CLAVE."'";

//Ejecutamos la sentencia SQL
$stmt = mssql_query($sql,$link);

if( !mssql_num_rows($stmt)) {
   echo json_encode("fail");
}

else {
   

        while (($row = mssql_fetch_array($stmt, MSSQL_BOTH)))  {
            $id_usuario=$row['id_usuario'];
            $nombre=utf8_encode($row['nombre']);
            $rfc=$row['empleado'];
        }

        $sql2 = "SELECT SSMNOM.dbo.TOTXPER.*, COMUN.dbo.PUESTOS.NOMBRE AS PUEST, COMUN.dbo.CENTROS.NOMBRE AS CENT FROM COMUN.dbo.PUESTOS, COMUN.dbo.CENTROS, SSMNOM.dbo.TOTXPER WHERE SSMNOM.dbo.TOTXPER.empleado='".$rfc."' AND COMUN.dbo.PUESTOS.CODIGO=SSMNOM.dbo.TOTXPER.PUESTO AND COMUN.dbo.CENTROS.CLAVE=SSMNOM.dbo.TOTXPER.CENTRO";
        $stmt2 = mssql_query($sql2,$link); 

        while (($row2 = mssql_fetch_array($stmt2, MSSQL_BOTH)))  {
            $puesto=$row2['PUEST'];
            $centro=utf8_encode($row2['CENT']);
            
        }





            $nombre=rtrim($nombre);

            $datos="<div id='tab1' class='tabcontent'>
                                                <h3>Nombre Completo: </h3>
                                                <h4>
                                                $nombre
                                                </h4>
                                                <h3>RFC: </h3>
                                                <h4>
                                                $rfc
                                                </h4>
                                         </div>

                                         <div id='tab2' class='tabcontent'>
                                             <h3>Puesto</h3>
                                             <h4>
                                                $puesto
                                             </h4>
                                             <h4>Centro de trabajo</h4>
                                             <h4>
                                                $centro
                                             </h4>
                                         </div>
                                
                                         <div id='tab3' class='tabcontent'>
                                             <h3>Usuario</h3>
                                             <h4>
                                                $USUARIO
                                             </h4>
                                             
                                         </div> ";
            
            echo json_encode("$datos");

       
}
mssql_close($link); 

?>

                                          









                                            