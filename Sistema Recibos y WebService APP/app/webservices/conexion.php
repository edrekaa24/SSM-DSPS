<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$server = '192.168.42.119';

// Connect to MSSQL
$link = mssql_connect($server, 'Daniel', 'usuario2018');
mssql_select_db('SSMNOM', $link);

//mssql_select_db('SSMNOM', $link);
ini_set('mssql.charset', 'UTF-8');



//$selected = mssql_select_db('SSMNOM', $link)
//  or die("Algo fue mal mientras se conectaba a MSSQL"); 

//if (!$link) {
//    die('Algo fue mal mientras se conectaba a MSSQL');
//}

//$link2 = mssql_connect($server, 'Daniel', 'daniel2018');
//$serverName = "192.168.42.25\SQLEXPRESS"; //serverName\instanceName
//$connectionInfo = array( "Database"=>"SSMNOM", "UID"=>"Daniel", "PWD"=>"daniel2018");
//$connect = sqlsrv_connect( $serverName, $connectionInfo);


 
?>