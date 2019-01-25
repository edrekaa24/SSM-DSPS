<?php
$pdf=$_REQUEST['pdf'];
$pdf2 = str_replace("\\", "/", $pdf);


$url=$pdf2;
$url2=str_replace(" ", "%20", $url);
$url3='file:'.$url;
echo $url3;

$nuevo_nombre = "CFDI-QNA-$qna-$ano"; //asignamos nuevo nombre
$archivo_descarga = curl_init(); //inicializamos el curl
curl_setopt($archivo_descarga, CURLOPT_URL, $url3); //ponemos lo que queremos descargar
//curl_setopt($archivo_descarga, CURLOPT_HEADER, true);
curl_setopt($archivo_descarga, CURLOPT_RETURNTRANSFER, true);
curl_setopt($archivo_descarga, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($archivo_descarga, CURLOPT_AUTOREFERER, true);
$resultado_descarga = curl_exec($archivo_descarga); //realizamos la descarga
if(!curl_errno($archivo_descarga)) // si no hay error hacemos la descarga
{
  header('Content-type:file/pdf'); //Acá le cambias el tipo de archivo (MimeType) por lo que quieras
  header('Content-Disposition: attachment; filename ="'.$nuevo_nombre.'.pdf"'); //renombramos la descarga
  echo($resultado_descarga);
  exit();
}else
{
  echo(curl_error($archivo_descarga)); // Si hay error lo mostramos
}
?> 
