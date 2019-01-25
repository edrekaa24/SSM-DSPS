<?php
include_once('confi.php');
error_reporting(E_ALL);
echo "hi there this is a test";
//Get the variables here
$username = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) :  "";
$email = isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) :  "";
$password = isset($_POST['password']) ? mysql_real_escape_string($_POST['password']) :  "";
//Get the variables here end
$insertstatement = 'INSERT INTO `mytesttable`(`id`,`username`,`email`,`password`) VAlUES (NULL,"'.$username.'","'.$email.'","'.$password.'")';

$query123 = mysql_query($insertstatement) or trigger_error(mysql_error()." ".$insertstatement);

echo "$query123";
//Registration code here (insert statements)






//Registration code here (insert statements) end






?>