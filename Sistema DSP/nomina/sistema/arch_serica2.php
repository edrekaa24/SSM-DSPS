<?php
include 'conexion.php';

$refh=$_GET['ref'];
$qna=$_GET['qna'];
$anio=$_GET['anio'];
$tipo=$_GET['tipo'];



if ($tipo='ER') {

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

					case 'PRO':
						$ref2='24017007Q';
						$ref="'PRO'";
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
							A.PERCEPCIONES AS PERCEPCIONES,
							A.DEDUCCIONES AS DEDUCCIONES,
							DATEDIFF(week, A.PERAPINI, A.PERAPFIN) AS SEM,
							format(cast(A.PERAPINI as date),'yyyyMMdd') AS inicio,
							format(cast(A.PERAPFIN as date),'yyyyMMdd') AS fin,
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
							A.PERCEPCIONES-sum(IIF(D.tipo+D.concepto='102',importe,0))-sum(IIF(D.tipo+D.concepto='107',importe,0))-sum(IIF(D.tipo+D.concepto='130',importe,0))-sum(IIF(D.tipo+D.concepto='137',importe,0))-sum(IIF(D.tipo+D.concepto='116',importe,0)) as '10001',
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
							'17' AS C_X17,
							sum(IIF(D.tipo+D.concepto='17',importe,0)) as '20008'
							FROM SSMNOM.dbo.TOTXPER A
							right join SSMNOM.dbo.EMPLEADOS B on A.EMPLEADO=B.AFILIACION
							left join SSMNOM.dbo.MOVXPER D ON A.ID=D.ID
							WHERE A.EMPLEADO IN (SELECT distinct EMPLEADO FROM MOVXPER WHERE CONCEPTO='02' AND TIPO='2' AND ANO='$anio' AND QUINCENA='$qna' AND REFERENCIA in ($ref))
							AND A.QUINCENA='$qna'
							AND A.ANO='$anio'
							AND A.STADO='A'
							AND A.ref_nom IN ($ref)
							AND A.TIPAG IN ('2','6')
							AND A.UNIDAD NOT IN ('610','X00')
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
							A.UNIDAD,
							A.PERAPINI,
							A.PERAPFIN";

				$stmt = mssql_query($sql,$link);
				$cont=0;
				$x=1;

				while (($row = mssql_fetch_array($stmt, MSSQL_BOTH))) {

								$s=$row['SEM'];
								$ini=$row['inicio'];
								$fin=$row['fin'];
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
								if ($aPAGADURIA='     ') {
									$aPAGADURIA='S1717';
								}
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
								$neto=$tPER-$tDED;
								$cont=$cont+1;
								$qnas=$s/2;
								

						if ($qnas>1) {

								switch ($ini) {
											case '20180101':
												$q=1;
												break;

											case '20180116':
												$q=2;
												break;

											case '20180201':
												$q=3;
												break;

											case '20180216':
												$q=4;
												break;

											case '20180301':
												$q=5;
												break;

											case '20180316':
												$q=6;
												break;

											case '20180401':
												$q=7;
												break;

											case '20180416':
												$q=8;
												break;

											case '20180501':
												$q=9;
												break;

											case '20180516':
												$q=10;
												break;

											case '20180601':
												$q=11;
												break;

											case '20180616':
												$q=12;
												break;

											case '20180701':
												$q=13;
												break;

											case '20180716':
												$q=14;
												break;

											case '20180801':
												$q=15;
												break;

											case '20180816':
												$q=16;
												break;

											case '20180901':
												$q=17;
												break;

											case '20180916':
												$q=18;
												break;

											case '20181001':
												$q=19;
												break;

											case '20181016':
												$q=20;
												break;

											case '20181101':
												$q=21;
												break;

											case '20181116':
												$q=22;
												break;

											case '20181201':
												$q=23;
												break;

											case '20181216':
												$q=24;
												break;
										}
							
								while ($x<=$qnas) {
										
										switch ($q) {
											case 1:
												$aini='20180101';
												$afin='20180115';
												break;

											case 2:
												$aini='20180116';
												$afin='20180131';
												break;

											case 3:
												$aini='20180201';
												$afin='20180215';
												break;

											case 4:
												$aini='20180216';
												$afin='20180228';
												break;

											case 5:
												$aini='20180301';
												$afin='20180315';
												break;

											case 6:
												$aini='20180316';
												$afin='20180331';
												break;

											case 7:
												$aini='20180401';
												$afin='20180415';
												break;

											case 8:
												$aini='20180416';
												$afin='20180430';
												break;

											case 9:
												$aini='20180501';
												$afin='20180515';
												break;

											case 10:
												$aini='20180516';
												$afin='20180531';
												break;

											case 11:
												$aini='20180601';
												$afin='20180615';
												break;

											case 12:
												$aini='20180616';
												$afin='20180630';
												break;

											case 13:
												$aini='20180701';
												$afin='20180715';
												break;

											case 14:
												$aini='20180716';
												$afin='20180731';
												break;

											case 15:
												$aini='20180801';
												$afin='20180815';
												break;

											case 16:
												$aini='20180816';
												$afin='20180830';
												break;

											case 17:
												$aini='20180901';
												$afin='20180915';
												break;

											case 18:
												$aini='20180916';
												$afin='20180931';
												break;

											case 19:
												$aini='20181001';
												$afin='20181015';
												break;

											case 20:
												$aini='20181016';
												$afin='20181031';
												break;

											case 21:
												$aini='20181101';
												$afin='20181115';
												break;

											case 22:
												$aini='20181116';
												$afin='20181130';
												break;

											case 23:
												$aini='20181201';
												$afin='20181215';
												break;

											case 24:
												$aini='20181216';
												$afin='20181231';
												break;
										}
				
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
								echo $aini.'|';
								echo $afin.'|';
								echo number_format($aPERCEPCIONES/$qnas, 2, '.', '').'|';
								echo number_format($aDEDUCCIONES/$qnas, 2, '.', '').'|';
								echo $aP_11301.'|';
								echo $aC_7.'|';
								echo number_format($a11301/$qnas, 2, '.', '').'|';
								echo $aP_12201.'|';
								echo $aC_2.'|';
								echo number_format($a12201/$qnas, 2, '.', '').'|';
								echo $aP_12301.'|';
								echo '|';
								echo number_format($a12301/$qnas, 2, '.', '').'|';
								echo $aP_13101.'|';
								echo '|';
								echo number_format($a13101/$qnas, 2, '.', '').'|';
								echo $aP_13102.'|';
								echo '|';
								echo number_format($a13102/$qnas, 2, '.', '').'|';
								echo $aP_13401.'|';
								echo '|';
								echo number_format($a13401/$qnas, 2, '.', '').'|';
								echo $aP_13402.'|';
								echo '|';
								echo number_format($a13402/$qnas, 2, '.', '').'|';
								echo $aP_13407.'|';
								echo $aC_30.'|';
								echo number_format($a13407/$qnas, 2, '.', '').'|';
								echo $aP_13408.'|';
								echo '|';
								echo number_format($a13408/$qnas, 2, '.', '').'|';
								echo $aP_13411.'|';
								echo $aC_MR.'|';
								echo $a13411.'|';
								echo $aP_15403.'|';
								echo '|';
								echo number_format($a15403/$qnas, 2, '.', '').'|';
								echo $aP_15402.'|';
								echo $aC_37.'|';
								echo number_format($a15402/$qnas, 2, '.', '').'|';
								echo $aP_10001.'|';
								echo $aC_OP.'|';
								echo number_format($a10001/$qnas, 2, '.', '').'|';
								echo $aP_10002.'|';
								echo $aC_38.'|';
								echo number_format($a10002/$qnas, 2, '.', '').'|';
								echo $aP_20001.'|';
								echo $aC_OD.'|';
								echo number_format($a20001/$qnas, 2, '.', '').'|';
								echo $aP_20002.'|';
								echo $aC_3.'|';
								echo number_format($a20002/$qnas, 2, '.', '').'|';
								echo $aP_20003.'|';
								echo '|';
								echo number_format($a20003/$qnas, 2, '.', '').'|';
								echo $aP_20004.'|';
								echo $aC_8.'|';
								echo number_format($a20004/$qnas, 2, '.', '').'|';
								echo $aP_20005.'|';
								echo $aC_64.'|';
								echo number_format($a20005/$qnas, 2, '.', '').'|';
								echo $aP_20006.'|';
								echo $aC_62.'|';
								echo number_format($a20006/$qnas, 2, '.', '').'|';
								echo $aP_20007.'|';
								echo $aC_17.'|';
								echo number_format($a20007/$qnas, 2, '.', '').'|';
								echo $aP_20008.'|';
								echo $aC_X17.'|';
								echo number_format($a20008/$qnas, 2, '.', '')."\r\n";
								$x=$x+1;
								$q=$q+1;

							}
						}


						else {

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
								echo $ini.'|';
								echo $fin.'|';
								echo number_format($aPERCEPCIONES/$qnas, 2, '.', '').'|';
								echo number_format($aDEDUCCIONES/$qnas, 2, '.', '').'|';
								echo $aP_11301.'|';
								echo $aC_7.'|';
								echo number_format($a11301/$qnas, 2, '.', '').'|';
								echo $aP_12201.'|';
								echo $aC_2.'|';
								echo number_format($a12201/$qnas, 2, '.', '').'|';
								echo $aP_12301.'|';
								echo '|';
								echo number_format($a12301/$qnas, 2, '.', '').'|';
								echo $aP_13101.'|';
								echo '|';
								echo number_format($a13101/$qnas, 2, '.', '').'|';
								echo $aP_13102.'|';
								echo '|';
								echo number_format($a13102/$qnas, 2, '.', '').'|';
								echo $aP_13401.'|';
								echo '|';
								echo number_format($a13401/$qnas, 2, '.', '').'|';
								echo $aP_13402.'|';
								echo '|';
								echo number_format($a13402/$qnas, 2, '.', '').'|';
								echo $aP_13407.'|';
								echo $aC_30.'|';
								echo number_format($a13407/$qnas, 2, '.', '').'|';
								echo $aP_13408.'|';
								echo '|';
								echo number_format($a13408/$qnas, 2, '.', '').'|';
								echo $aP_13411.'|';
								echo $aC_MR.'|';
								echo $a13411.'|';
								echo $aP_15403.'|';
								echo '|';
								echo number_format($a15403/$qnas, 2, '.', '').'|';
								echo $aP_15402.'|';
								echo $aC_37.'|';
								echo number_format($a15402/$qnas, 2, '.', '').'|';
								echo $aP_10001.'|';
								echo $aC_OP.'|';
								echo number_format($a10001/$qnas, 2, '.', '').'|';
								echo $aP_10002.'|';
								echo $aC_38.'|';
								echo number_format($a10002/$qnas, 2, '.', '').'|';
								echo $aP_20001.'|';
								echo $aC_OD.'|';
								echo number_format($a20001/$qnas, 2, '.', '').'|';
								echo $aP_20002.'|';
								echo $aC_3.'|';
								echo number_format($a20002/$qnas, 2, '.', '').'|';
								echo $aP_20003.'|';
								echo '|';
								echo number_format($a20003/$qnas, 2, '.', '').'|';
								echo $aP_20004.'|';
								echo $aC_8.'|';
								echo number_format($a20004/$qnas, 2, '.', '').'|';
								echo $aP_20005.'|';
								echo $aC_64.'|';
								echo number_format($a20005/$qnas, 2, '.', '').'|';
								echo $aP_20006.'|';
								echo $aC_62.'|';
								echo number_format($a20006/$qnas, 2, '.', '').'|';
								echo $aP_20007.'|';
								echo $aC_17.'|';
								echo number_format($a20007/$qnas, 2, '.', '').'|';
								echo $aP_20008.'|';
								echo $aC_X17.'|';
								echo number_format($a20008/$qnas, 2, '.', '')."\r\n";
						}

				}


				$fecha=date("Ymd");



				echo "C"."|".$ref2.$anio.$qna2.$tipo."|".$fecha."|"."022"."|".$cont."|".$cont."|".$cont."|".$t11301."|".$t12201."|".$t12301."|".$t13101."|".$t13102."|".$t13401."|".$t13402."|".$t13407."|".$t13408."|".$t13411."|".$t15403."|".$t15402."|".$t10002."|".$t20002."|".$t20003."|".$t20004."|".$t20005."|".$t20006."|".$a20007."|".$a20008."|".$tPER."|".$tDED."|".$neto;


}


mssql_free_result($stmt);
mssql_close($link); 
?>