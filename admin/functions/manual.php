<?php

// Book Quantity
function bookQuantity($book_code) {
    require '../includes/connect.php';
    $sql = "SELECT `book_quantity` FROM `books` WHERE `book_code` = '$book_code'";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['book_quantity'];
        }

}

// Borrow Conut
function borrwCount($book_code) {
    require '../includes/connect.php';
    $sql = "SELECT COUNT(id) as `count` FROM `borrows` WHERE `book_code` = '$book_code' AND `confirmed` = '1' AND `returned` = '0'";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }

}

// Available Book
function bookAvailable($bookId) {
    require '../includes/connect.php';
    $sql = "SELECT COUNT(id) as `count` FROM `borrows` WHERE `book_code` = '$bookId'";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }

}