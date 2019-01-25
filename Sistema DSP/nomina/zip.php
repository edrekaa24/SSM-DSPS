<?php
// Creamos un instancia de la clase ZipArchive
 $zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open("miarchivo.zip",ZipArchive::CREATE);
 // Añadimos un directorio
 $dir = 'PDF';
 $dir2 = 'XML';
 $zip->addEmptyDir($dir);
  $zip->addEmptyDir($dir2);
 // Añadimos un archivo en la raid del zip.
 //$zip->addFile("4.jpg", "logo.jpg");
 //Añadimos un archivo dentro del directorio que hemos creado
 $zip->addFile("ftp://192.168.42.25/2018/09-2018/20180518 2018 9 Control de nomina.pdf",$dir."/DSP.pdf");
 $zip->addFile("4.jpg",$dir2."/xml.jpg");
 // Una vez añadido los archivos deseados cerramos el zip.
 $zip->close();
 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
 header("Content-type: application/octet-stream");
 header("Content-disposition: attachment; filename=miarchivo.zip");
 // leemos el archivo creado
 readfile('miarchivo.zip');
 // Por último eliminamos el archivo temporal creado
 unlink('miarchivo.zip');//Destruye el archivo temporal
?>