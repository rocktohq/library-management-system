<?php

function bookRequests() {
    include '../includes/connect.php';
    

}
// Student Information From ID
function studentPhone($id) {
    include '../includes/connect.php';
    $sql = "SELECT `phone` FROM `students` WHERE `uid` = '$id'";
    $result = $connect->query($sql);
    if($result->num_rows)
    {
        $row = $result->fetch_assoc();
        return $row['phone'];
    }

}
