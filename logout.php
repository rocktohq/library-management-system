<?php
	
	/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
    */
	
    if (isset($_COOKIE['user'])) {
        unset($_COOKIE['user']); 
        setcookie('user', null, -1, '/');

        header("Location: login.php");
    } else {
        header("Location: login.php");
    }

