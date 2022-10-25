<?php

/*  
  # Library Management System
	#	Application by Saidul Mursalin
	#	Design & Developed by Saidul Mursalin
	#	Contact: facebook/itzmonir
*/

# Database Configuration
// Database Information
$hostName = "localhost";
$dbUser = "library";
$dbPass = "library321***";
$dbName = "library";

// Trying to Connect
try {
  $conn = new PDO("mysql:host=$hostName; dbname=$dbName", $dbUser, $dbPass);

  // Set the PDO Error Mode to Exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  
} catch(PDOException $e) {
  // Error!
  echo "Connection failed: " . $e->getMessage();
}
