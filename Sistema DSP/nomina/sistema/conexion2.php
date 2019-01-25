<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$myServer = "192.168.42.25";
$myUser = "Daniel";
$myPass = "daniel2018";
$myDB = "SSMNOM"; 

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer"); 

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB"); 

//$serverName = "192.168.42.25\SQLEXPRESS"; //serverName\instanceName
//$connectionInfo = array( "Database"=>"SSMNOM", "UID"=>"Daniel", "PWD"=>"daniel2018");
//$connect = mssql_connect( $serverName, $connectionInfo);


//Nombre del servidor, usuario, contraseña
 $conexion = mysql_connect("localhost","root","");
 $conn = new mysqli("localhost","root","","ssm_nominas");


//Base de datos seleccionada
 mysql_select_db("ssm_nominas", $conexion);





 function conexion(){

 $con = mysqli_connect("localhost","root","");

 if (!$con){

  die('Could not connect: ' . mysqli_error());
 }

 mysql_select_db("ssm_nominas", $con);

 return($con);

}

 
?>