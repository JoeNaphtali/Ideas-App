<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

?>