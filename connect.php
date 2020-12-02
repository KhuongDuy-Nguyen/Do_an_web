<?php
	$servername = "localhost";
	$database = "onlineweb";
	$username = "root";
	$password = "";
	$port = "3306";
	$connect = mysqli_connect($servername, $username, $password, $database, $port);
	mb_language('uni');
	mb_internal_encoding('UTF-8');
?>	