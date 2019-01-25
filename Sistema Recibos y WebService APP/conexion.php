<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$server = '192.168.42.119';

// Connect to MSSQL
$link = mssql_connect($server, 'Daniel', 'usuario2018');
mssql_select_db('SSMNOM', $link);

if (!$link) {
    die('Algo fue mal mientras se conectaba a MSSQL');
}

?>