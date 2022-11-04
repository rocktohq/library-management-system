<?php


include '../includes/connect.php';

session_start();
// Aprove
if(isset($_POST['approve'])) {
    $book_id = $_POST['book_id'];
    $issued_date = Date('Y-m-d', time());
    $return_date = Date('Y-m-d', strtotime('+10 days'));

    $sql = "UPDATE 
                `borrows` 
            SET 
                `confirmed`='1', `borrowed_date` = '$issued_date', `return_date` = '$return_date' 
            WHERE 
                `id` = '$book_id'";
    $result = $connect->query($sql);
    if($result) {
        $_SESSION['success'] = "Book Confirmed";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Error Confirming Book!";
        header("Location: index.php");
    }
}

// Decline
if(isset($_POST['decline'])) {
    $book_id = $_POST['book_id'];

    $sql = "DELETE FROM 
                `borrows` 
            WHERE 
                `id` = '$book_id'";
    $result = $connect->query($sql);
    if($result) {
        $_SESSION['success'] = "Book Request Declined";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Error Declining The Request!";
        header("Location: index.php");
    }
}