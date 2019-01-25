<?php
$servername = "localhost";
$username = "root";
$password = "dh/j67Wh3eQ1";
$dbname = "saefcaei";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}


function conectar()
   {
	
	$conexion=mysql_connect($servername, $username, $password);
	if (!$conexion)
	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}

	$coneccion=mysql_select_db($dbname,$conexion);

	if (!$coneccion)
	{
		echo"ERROR AL ABRIR LA BASE DE DATOS";
		exit();
	}
     	return ($conexion);
   }

//Forma de hacer querys

//$sql = "INSERT INTO inscripcion (t_solicitud)
//VALUES ('$t_solicitud')";

//if ($conn->query($sql) === TRUE) {
//    echo "Registro guardado con Éxito.";
//} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
//}

//$conn->close();
?>