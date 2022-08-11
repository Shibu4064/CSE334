<?php

define('db_server', 'localhost');
define('db_username', 'root');
define('db_password', '');
define('db_name', 'erisdb');

$mysqli=new mysqli(db_server,db_username,db_password,db_name);

if($mysqli===false){
	die("error:could not connect".$mysqli->connect_error);
}



 ?>