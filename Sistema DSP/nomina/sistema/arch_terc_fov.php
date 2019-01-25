<?php
include 'conexion.php';

$refh=$_GET['ref'];
$qna=$_GET['qna'];
$anio=$_GET['anio'];
$tipo=$_GET['tipo'];

switch ($tipo) {
	case 'O':
		$prd='PRDO%';
		break;
	case 'E':
		$prd='PRDE%';
		break;
	case 'RE':
		$prd='PRDR%';
		break;
	}

if ($qna<10) {
	$qna2='0'.$qna;
}
else 
$qna2=$qna;


switch ($refh) {
	case 'EVE':
		$ref2='24017007Q';
		$ref="'EVE'";
		break;

	case 'FED':
		$ref2='01217007Q';
		$ref="'FED'";
		break;

	case 'GOB':
		$ref2='24017007Q';
		$ref="'EST','HOM','FOR 1','FOR 2','FOR 3'";
		break;

	case 'HT':
		$ref2='24117007Q';
		$ref="'TEM'";
		break;

	case 'PEF':
		$ref2='01217007Q';
		$ref="'PEF'";
		break;

	case 'PREC':
		$ref2='41217007Q';
		$ref="'PRE','REG'";
		break;

	case 'RPS':
		$ref2='24117007Q';
		$ref="'REP','HOS'";
		break;

	case 'SEC':
		$ref2='24017007Q';
		$ref="'SEC'";
		break;

	case 'TRA':
		$ref2='24017007Q';
		$ref="'TRA'";
		break;
	
	default:
		$ref2='FALTA_REFERENCIA';
		break;
}


//le informamos que será un archivo txt

header('Content-type: application/txt');

//también le damos un nombre
header('Content-Disposition: attachment; filename="serica'.$ref.$tipo.$qna2.$anio.'.txt"');

//query a mssql
 $sql = "SELECT 'D' AS TIPO, 
			rtrim(B.CEDULA) AS NSS, 
			rtrim(A.NOMBRES) AS NOMBRE,
			rtrim(A.AP_PATERNO) AS AP_PAT,
			rtrim(A.AP_MATERNO) AS AP_MAT,
			A.EMPLEADO AS RFC,
			A.CURP,
			IIF(SUBSTRING(A.CURP,11,1)='M','F','M') AS SEXO,
			A.PAGADURIA,
			B.CLAVE,
			A.CHEQUE,
			'1' AS REGIMEN,
			case (SELECT TOP 1 CONTRATO FROM COMUN.dbo.Unidades C WHERE C.clave=A.UNIDAD) 
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
			FROM SSMNOM.dbo.TOTXPER A
			right join SSMNOM.dbo.EMPLEADOS B on A.EMPLEADO=B.AFILIACION
			left join SSMNOM.dbo.MOVXPER D ON A.ID=D.ID
			WHERE A.QUINCENA='$qna'
			AND A.ANO='$anio'
			AND A.STADO='A'
			AND A.ref_nom IN ($ref)
			AND A.NOMPROD LIKE ('$prd')
			AND A.UNIDAD NOT IN ('610','X00')
			AND A.EMPLEADO IN (SELECT distinct EMPLEADO FROM MOVXPER WHERE CONCEPTO='02' AND TIPO='2' AND ANO='$anio' AND QUINCENA='$qna')
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

$stmt = mssql_query($sql,$link);
$cont=0;

while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {                                     

$aTIPO=$row['TIPO'];
$aNSS=$row['NSS'];
if ($aNSS<1) {
$aNSS='';
}
$aNOMBRE=utf8_encode($row['NOMBRE']);
$aAP_PAT=utf8_encode($row['AP_PAT']);
$aAP_MAT=utf8_encode($row['AP_MAT']);
$aRFC=$row['RFC'];
$aCURP=$row['CURP'];
$aSEXO=$row['SEXO'];
$aPAGADURIA=$row['PAGADURIA'];
$aCLAVE=$row['CLAVE'];
$aCHEQUE=$row['CHEQUE'];
$aREGIMEN=$row['REGIMEN'];
$aTIPO_CONTRATO=$row['TIPO_CONTRATO'];
$aPERCEPCIONES=$row['PERCEPCIONES'];
$tPER=$tPER+$aPERCEPCIONES;
$aDEDUCCIONES=$row['DEDUCCIONES'];
$tDED=$tDED+$aDEDUCCIONES;
$aP_11301=$row['P_11301'];
$aC_7=$row['C_7'];
$a11301=$row['11301'];
$t11301=$t11301+$a11301;  //IMPORTE TOTAL SUELDO BASE PARTIDA 11301
$aP_12201=$row['P_12201'];
$aC_2=$row['C_2'];
$a12201=$row['12201'];
$t12201=$t12201+$a12201;  //IMPORTE TOTAL SUELDO BASE PERSONAL EVENTUAL PARTIDA 12201
$aP_12301=$row['P_12301'];
$aC_X1=$row['C_X1'];
$a12301=$row['12301'];
$t12301=$t12301+$a12301;  //IMPORTE TOTAL PARTIDA 12301
$aP_13101=$row['P_13101'];
$aC_X2=$row['C_X2'];
$a13101=$row['13101'];
$t13101=$t13101+$a13101;  //IMPORTE TOTAL PARTIDA 13101
$aP_13102=$row['P_13102'];
$aC_X3=$row['C_X3'];
$a13102=$row['13102'];
$t13102=$t13102+$a13102;  //IMPORTE TOTAL PARTIDA 13102
$aP_13401=$row['P_13401'];
$aC_X4=$row['C_X4'];
$a13401=$row['13401'];
$t13401=$t13401+$a13401;  //IMPORTE TOTAL PARTIDA 13401
$aP_13402=$row['P_13402'];
$aC_X5=$row['C_X5'];
$a13402=$row['13402'];
$t13402=$t13402+$a13402;  //IMPORTE TOTAL PARTIDA 13402
$aP_13407=$row['P_13407'];
$aC_30=$row['C_30'];
$a13407=$row['13407'];
$t13407=$t13407+$a13407;  //IMPORTE TOTAL PARTIDA 13407
$aP_13408=$row['P_13408'];
$aC_X6=$row['C_X6'];
$a13408=$row['13408'];
$t13408=$t13408+$a13408;  //IMPORTE TOTAL PARTIDA 13408
$aP_13411=$row['P_13411'];
$aC_MR=$row['C_MR'];
$a13411=$row['13411'];
$t13411=$t13411+$a13411;  //IMPORTE TOTAL PARTIDA 13411
$aP_15403=$row['P_15403'];
$aC_X7=$row['C_X7'];
$a15403=$row['15403'];
$t15403=$t15403+$a15403;  //IMPORTE TOTAL PARTIDA 15403
$aP_15402=$row['P_15402'];
$aC_37=$row['C_37'];
$a15402=$row['15402'];
$t15402=$t15402+$a15402;  //IMPORTE TOTAL PARTIDA 15402
$aP_10001=$row['P_10001'];
$aC_OP=$row['C_OP'];
$a10001=$row['10001'];
$aP_10002=$row['P_10002'];
$aC_38=$row['C_38'];
$a10002=$row['10002'];
$t10002=$t10002+$a10002;  //IMPORTE TOTAL PARTIDA 10002 APOYO DE DESPENSA
$aP_20001=$row['P_20001'];
$aC_OD=$row['C_OD'];
$a20001=$row['20001'];
$aP_20002=$row['P_20002'];
$aC_3=$row['C_3'];
$a20002=$row['20002'];
$t20002=$t20002+$a20002;  //IMPORTE TOTAL PARTIDA 20002 PRESTAMOS PERSONALES
$aP_20003=$row['P_20003'];
$aC_X8=$row['C_X8'];
$a20003=$row['20003'];
$t20003=$t20003+$a20003;  //IMPORTE TOTAL PARTIDA 20003 SUPER ISSSTE
$aP_20004=$row['P_20004'];
$aC_8=$row['C_8'];
$a20004=$row['20004'];
$t20004=$t20004+$a20004;  //IMPORTE TOTAL PARTIDA 20004 SEGURO MÉDICO NO DERECHOHABIENTES
$aP_20005=$row['P_20005'];
$aC_64=$row['C_64'];
$a20005=$row['20005'];
$t20005=$t20005+$a20005;  //IMPORTE TOTAL PARTIDA 20005 CRÉDITO FOVISSSTE PARA VIVIENDA
$aP_20006=$row['P_20006'];
$aC_62=$row['C_62'];
$a20006=$row['20006'];
$t20006=$t20006+$a20006;  //IMPORTE TOTAL PARTIDA 20006 PENSIÓN ALIMENTICIA
$aP_20007=$row['P_20007'];
$aC_17=$row['C_17'];
$a20007=$row['20007'];
$t20007=$t20007+$a20007;  //IMPORTE TOTAL PARTIDA 20007 FALTAS
$aP_20008=$row['P_20008'];
$aC_X17=$row['C_X17'];
$a20008=$row['20008'];
$t20008=$t20008+$a20008;  //IMPORTE TOTAL PARTIDA 20008 RETARDOS
$cont=$cont+1;


//imprimir valores

echo $aTIPO.'|';
echo $aNSS.'|';
echo $aNOMBRE.'|';
echo $aAP_PAT.'|';
echo $aAP_MAT.'|';
echo $aRFC.'|';
echo $aCURP.'|';
echo $aSEXO.'|';
echo $aPAGADURIA.'|';
echo $aCLAVE.'|';
echo $aCHEQUE.'|';
echo $aREGIMEN.'|';
echo $aTIPO_CONTRATO.'|';
echo $aPERCEPCIONES.'|';
echo $aDEDUCCIONES.'|';
echo $aP_11301.'|';
echo $aC_7.'|';
echo $a11301.'|';
echo $aP_12201.'|';
echo $aC_2.'|';
echo $a12201.'|';
echo $aP_12301.'|';
echo $aC_X1.'|';
echo $a12301.'|';
echo $aP_13101.'|';
echo $aC_X2.'|';
echo $a13101.'|';
echo $aP_13102.'|';
echo $aC_X3.'|';
echo $a13102.'|';
echo $aP_13401.'|';
echo $aC_X4.'|';
echo $a13401.'|';
echo $aP_13402.'|';
echo $aC_X5.'|';
echo $a13402.'|';
echo $aP_13407.'|';
echo $aC_30.'|';
echo $a13407.'|';
echo $aP_13408.'|';
echo $aC_X6.'|';
echo $a13408.'|';
echo $aP_13411.'|';
echo $aC_MR.'|';
echo $a13411.'|';
echo $aP_15403.'|';
echo $aC_X7.'|';
echo $a15403.'|';
echo $aP_15402.'|';
echo $aC_37.'|';
echo $a15402.'|';
echo $aP_10001.'|';
echo $aC_OP.'|';
echo $a10001.'|';
echo $aP_10002.'|';
echo $aC_38.'|';
echo $a10002.'|';
echo $aP_20001.'|';
echo $aC_OD.'|';
echo $a20001.'|';
echo $aP_20002.'|';
echo $aC_3.'|';
echo $a20002.'|';
echo $aP_20003.'|';
echo $aC_X8.'|';
echo $a20003.'|';
echo $aP_20004.'|';
echo $aC_8.'|';
echo $a20004.'|';
echo $aP_20005.'|';
echo $aC_64.'|';
echo $a20005.'|';
echo $aP_20006.'|';
echo $aC_62.'|';
echo $a20006.'|';
echo $aP_20007.'|';
echo $aC_17.'|';
echo $a20007.'|';
echo $aP_20008.'|';
echo $aC_X17.'|';
echo $a20008."\r\n";

}
$neto=$tPER-$tDED;



$fecha=date("Ymd");



echo "C"."|".$ref2.$anio.$qna2.$tipo."|".$fecha."|"."022"."|".$cont."|".$cont."|".$cont."|".$t11301."|".$t12201."|".$t12301."|".$t13101."|".$t13102."|".$t13401."|".$t13402."|".$t13407."|".$t13408."|".$t13411."|".$t15403."|".$t15402."|".$t10002."|".$t20002."|".$t20003."|".$t20004."|".$t20005."|".$t20006."|".$a20007."|".$a20008."|".$tPER."|".$tDED."|".$neto;

mssql_free_result($stmt);
mssql_close($link); 

?>