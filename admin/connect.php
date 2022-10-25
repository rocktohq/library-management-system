<?php
error_reporting(0);
/*
* Application Developed by Saidul Mursalin
* Database Connection Configuration
*/

// DB Information
$hostName = 'localhost';    // Host Name
$dbName = 'library';       // Database Name
$dbUser = 'library';       // Database Username
$dbPass = 'library321***';    // Database Password

// Let's try to Connect
$connect = new mysqli($hostName, $dbUser, $dbPass, $dbName);

// If there is any Error
if($connect->connect_errno) {
  echo "<strong>Failed to connect to MySQL:</strong> " . $connect->connect_error;
  exit();
}

?>