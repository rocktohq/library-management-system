<?php

// echo $issued_date = Date('Y-m-d', time());
// echo $return_date = Date('Y-m-d', strtotime('+10 days'));

if(isset($_COOKIE['lmsadmin'])) {
    $userid = $_COOKIE['user'];
}

include 'connect.php';

$sql = "SELECT
            returns.book_code,
            returns.borrowed_date,
            returns.borrowed_by,
            borrows.borrowed_by,
            borrows.returned
            
        FROM
            returns
        INNER JOIN borrows ON returns.borrowed_by = $userid AND returns.borrowed_by = borrows.borrowed_by AND borrows.returned = 0";

$result = $connect->query($sql);
if($result->num_rows) {
    while($row = $result->fetch_assoc()) {
        echo  $row['book_code'];
        echo  " - {$row['borrowed_by']}";
        echo "<br>";
    }
}