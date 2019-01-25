 <?php
 include 'conexion.php';
 $sql = "SELECT 'D' AS TIPO, 
			rtrim(B.CEDULA) AS NSS, 
			rtrim(A.NOMBRES) AS NOMBRE,
			rtrim(A.AP_PATERNO),
			rtrim(A.AP_MATERNO),
			A.EMPLEADO AS RFC,
			A.CURP,
			IIF(SUBSTRING(A.CURP,11,1)='M','F','M') AS SEXO,
			A.PAGADURIA,
			B.CLAVE,
			A.CHEQUE,
			'1' AS REGIMEN,
			case (SELECT TOP 1 CONTRATO FROM Unidades C WHERE C.clave=A.UNIDAD) 
			WHEN 'BASE'
			        THEN '1'
			WHEN 'CONFIANZA'
			        THEN '2'
			WHEN 'MEDICOS'
			        THEN '4'
			WHEN 'EVENTUAL'
			        THEN '5'     
			WHEN 'VOLUNTARIO'
			        THEN '7'	         
			END AS TIPO_CONTRATO,
			A.PERCEPCIONES,
			A.DEDUCCIONES,
			11301 AS P_11301,
			'07' AS C_7,
			sum(IIF(D.concepto='07',importe,0)) as '11301',
			12201 AS P_12201,
			'02' AS C_2,
			sum(IIF(D.tipo+D.concepto='102',importe,0)) as '12201',
			12301 AS P_12301,
			'' AS C_X1,
			0 AS '12301',
			13101 AS P_13101,
			'' AS C_X2,
			sum(IIF(D.tipo+D.concepto LIKE ('1A%'),importe,0)) as '13101',
			13102 AS P_13102,
			'' AS C_X3,
			0 AS '13102',
			13401 AS P_13401,
			'' AS C_X4,
			0 AS '13401',
			13402 AS P_13402,
			'' AS C_X5,
			0 AS '13402',
			13407 AS P_13407,
			'30' AS C_30,
			sum(IIF(D.tipo+D.concepto='130',importe,0)) as '13407',
			13408 AS P_13408,
			'' AS C_X6,
			0 AS '13408',
			13411 AS P_13411,
			'MR' AS C_MR,
			sum(IIF(D.concepto='MR',importe,0)) as '13411',
			15403 AS P_15403,
			'' AS C_X7,
			0 AS '15403',
			15402 AS P_15402,
			'37' AS C_37,
			sum(IIF(D.concepto='37',importe,0)) as '15402',
			10001 AS P_10001,
			'OP' AS C_OP,
			sum(IIF(D.concepto='38',importe,0)) as '10001',
			10002 AS P_10002,
			'03' AS C_38,
			sum(IIF(D.concepto='03',importe,0)) as '10002',
			20001 AS P_20001,
			'OD' AS C_OD,
			A.DEDUCCIONES-sum(IIF(D.tipo+D.concepto='203',importe,0))-sum(IIF(D.tipo+D.concepto='303',importe,0))-sum(IIF(D.tipo+D.concepto='208',importe,0))-sum(IIF(D.tipo+D.concepto='264',importe,0))-sum(IIF(D.tipo+D.concepto='262',importe,0))-sum(IIF(D.concepto='17',importe,0)) as '20001',
			20002 AS P_20002,
			'03' AS C_3,
			sum(IIF(D.tipo+D.concepto='203' or D.tipo+D.concepto='303',importe,0)) as '20002',
			20003 AS P_20003,
			'' AS C_X8,
			0 AS '20003',
			20004 AS P_20004,
			'08' AS C_8,
			sum(IIF(D.tipo+D.concepto='208',importe,0)) as '20004',
			20005 AS P_20005,
			'64' AS C_64,
			sum(IIF(D.tipo+D.concepto='264',importe,0)) as '20005',
			20006 AS P_20006,
			'62' AS C_62,
			sum(IIF(D.tipo+D.concepto='262',importe,0)) as '20006',
			20007 AS P_20007,
			'17' AS C_17,
			sum(IIF(D.concepto='17',importe,0)) as '20007',
			20008 AS P_20008,
			'' AS C_X17,
			0 AS '20008'
			FROM TOTXPER A  
			right join EMPLEADOS B on A.EMPLEADO=B.AFILIACION
			left join MOVXPER D ON A.ID=D.ID
			WHERE A.QUINCENA=9
			AND A.ANO=2018
			AND A.STADO='A'
			AND A.ref_nom='FED'
			AND A.NOMPROD NOT IN ('%%%P%')
			AND A.UNIDAD NOT IN ('610','X00')
			AND A.EMPLEADO IN (SELECT distinct EMPLEADO FROM MOVXPER WHERE CONCEPTO='02' AND TIPO='2' AND ANO=2018 AND QUINCENA=9)
			GROUP BY 
			B.CEDULA,
			A.NOMBRES,
			A.AP_PATERNO,
			A.AP_MATERNO,
			A.EMPLEADO,
			A.CURP,
			A.PAGADURIA,
			B.CLAVE,
			A.CHEQUE,
			A.PERCEPCIONES,
			A.DEDUCCIONES,
			A.UNIDAD";
			$sql2="select sum(percepciones)-sum(deducciones) as total from totxper where ano=2018 and quincena=10 and stado='A'";
$stmt = mssql_query($sql2,$link);
while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {
    foreach($row As $value){        
        $out .= ''.$value.'|';
    }
    $out .= "\n";
}
mssql_free_result($stmt);
mssql_close($link); 
// Output to browser with the CSV mime type
header("Content-type: text/x-txt");
header("Content-Disposition: attachment; filename=table_dump.txt");

?>