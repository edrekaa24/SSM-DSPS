<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$server = '192.168.42.119'; //URL DEL SERVIDOR

// CONEXIÓN A MSSQL
$link = mssql_connect($server, 'Daniel', 'usuario2018');  //USUARIO Y CONTRASEÑA DEL SERVIDOR SQL

mssql_select_db('SSMNOM', $link); //SELECCIÓN DE LA BASE DE DATOS
ini_set('mssql.charset', 'UTF-8'); //COMPATIBILIDAD CON DATOS DE CÓDIGO UTF-8



$link2 = mssql_connect($server, 'Daniel', 'usuario2018'); //CONEXIÓN ALTERNA 

 
?>