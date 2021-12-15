<?php     
	session_start();

    $server = "sql308.epizy.com";
	$userid = "epiz_29731518";
	$pw = "g5WbCxHCFTIB";
	$db= "epiz_29731518_earthshine";

	// Create connection
	$conn = new mysqli($server, $userid, $pw);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully";

	//select the database
	$conn->select_db($db);
?>  