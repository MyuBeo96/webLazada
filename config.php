<?php 
	define("DBSERVER", "localhost");
	define("DBUSERNAME","root");
	define("DBPASSWORD","");
	define("DBNAME","weblazada");

	$conn = mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
	// $conn->set_charset("utf8");
	mysqli_set_charset($conn, 'UTF8');
	if(!$conn){
		die('Connect error : '.mysqli_connect_errno());
	};
?>