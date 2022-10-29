<?php

/*  
  # Library Management System
	#	Application by Saidul Mursalin
	#	Design & Developed by Saidul Mursalin
	#	Contact: facebook/itzmonir
*/

# Database Configuration
// Database Information
$host = 'localhost';        // Host Name
$dbName = 'library';       // Database Name
$dbUser = 'library';       // Database Username
$dbPass = 'library321***';    // Database Password

// Let's try to Connect
$connect = new mysqli($host, $dbUser, $dbPass, $dbName);

// If there is any Error
if($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connect -> connect_error;
  exit();
}