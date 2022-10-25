<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

include './includes/connect.php';

if(isset($_COOKIE['user'])) {
    $userid = $_COOKIE['user'];

    if(isset($_GET['id'])) {
        $book_code = $_GET['id'];
    } else {
        header("Location: index.php");
    }


    $sql = "SELECT * FROM `searches` WHERE `book_code` = '$book_code'";
    $result = $connect->query($sql);

    if($result->num_rows) {
        $row = $result->fetch_assoc();
        $hits = $row['hits'] + 1;
        $sqlu = "UPDATE `searches` SET `hits`='$hits' WHERE `book_code` = '$book_code'";
        $resultu = $connect->query($sqlu);
        if($resultu) {
            header("Location: book.php?id={$book_code}");
        }
    } else {
        $sql = "INSERT INTO `searches`(`book_code`, `searched_by`, `hits`) VALUES ('$book_code', '$userid', '1')";
        $result = $connect->query($sql);
        if($result) {
            header("Location: book.php?id={$book_code}");
        }
    }

}