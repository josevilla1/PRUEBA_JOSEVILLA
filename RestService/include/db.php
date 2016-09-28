<?php
//c:\UniServerZ\www\RestService\include\db.php
function getDB(){
	$dbhost="localhost";
	$dbuser="taller_user";
	$dbpass="taller_password";
	$dbname="taller_rest";
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>