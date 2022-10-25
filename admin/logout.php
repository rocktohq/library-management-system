<?php
	
	/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
    */
	
    if (isset($_COOKIE['lmsadmin'])) {
        unset($_COOKIE['lmsadmin']); 
        setcookie('lmsadmin', null, -1, '/');

        header("Location: login.php");
    } else {
        header("Location: login.php");
    }

