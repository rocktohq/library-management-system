<?php


// WishList Count
function wishListCount($userid) {
    require 'dbCon.php';

    // Query to Feth the New BookList
    $sql = "SELECT * FROM `wishlist` WHERE `listed_by` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $rowCount = $query->rowCount();

    if($rowCount) {
        return $rowCount;
    }
}


// BorrowList Count
function borrowListCount($userid) {
    require 'dbCon.php';

    $confirmed = 1;
    $returned = 0;
    // Query to Feth the Book Details
    $sql = "SELECT * FROM `borrows` WHERE `borrowed_by` = ? AND `confirmed` = ? AND `returned` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid, $confirmed, $returned]);
    $rowCount = $query->rowCount();

    if($rowCount) {
        return $rowCount;
    }
}