<?php
include 'conexion.php';
session_start();
$rfc=$_SESSION['rfc'];
$iave=$_SESSION['iave'];
$pdf=$_REQUEST['pdf'];
$xml=$_REQUEST['xml'];
$qna=$_REQUEST['qna'];
$ano=$_REQUEST['ano'];
$a=$_REQUEST['activo'];

if ($a==2) {
?>
<script>
    var n1 = prompt("Ingresa tu contraseña para descargar");
    var iaves = "<?php echo $iave;?>";
    var variablepdf = "<?php echo $pdf;?>";
    var variablexml = "<?php echo $xml;?>";
    var variableqna = "<?php echo $qna;?>";
    var variableano = "<?php echo $ano;?>";

    if (n1==iaves) {
    	var variableactivo=1;

    	$.GET('http://sic.ssm.gob.mx/~sistemas.ssm/nomina/download-recibo.php',
		    {
		    	pdf:variablepdf, 
		    	xml:variablexml, 
		    	qna:variableqna, 
		    	ano:variableano, 
		    	activo:variableactivo 
		    },
		    function(data) {
		    	alert('Recibo firmado!');
		    });
    }
    else
    alert('Contraseña incorrecta!');
</script>
<?
}

else{

$url="http://192.168.42.119:13020/download.php?pdf=$pdf&xml=$xml";
$url2=str_replace(" ", "%20", $url);

$nuevo_nombre = "CFDI-QNA-$qna-$ano"; //asignamos nuevo nombre
$archivo_descarga = curl_init(); //inicializamos el curl
curl_setopt($archivo_descarga, CURLOPT_URL, $url2); //ponemos lo que queremos descargar
//curl_setopt($archivo_descarga, CURLOPT_HEADER, true);
curl_setopt($archivo_descarga, CURLOPT_RETURNTRANSFER, true);
curl_setopt($archivo_descarga, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($archivo_descarga, CURLOPT_AUTOREFERER, true);
$resultado_descarga = curl_exec($archivo_descarga); //realizamos la descarga
if(!curl_errno($archivo_descarga)) // si no hay error hacemos la descarga
{
  header('Content-type:file/zip'); //Acá le cambias el tipo de archivo (MimeType) por lo que quieras
  header('Content-Disposition: attachment; filename ="'.$nuevo_nombre.'.zip"'); //renombramos la descarga
  echo($resultado_descarga);
  exit();
}else
{
  echo(curl_error($archivo_descarga)); // Si hay error lo mostramos
}
}

?> 

