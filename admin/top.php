<?php
// Top Books
function topBookDetails($book_code, $i)
{
    include '../includes/connect.php';

    $sql = "SELECT * FROM `books` WHERE `book_code` = '$book_code'";
    $result = $connect->query($sql);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            echo "<tr>
            <td><span class='text-danger fw-bold'>{$i}</span></td>
            <td>{$row['book_name']}</td>
            <td class='text-uppercase'>{$row['book_code']}</td>
            <td class='text-uppercase'>{$row['department']}</td>
        </tr>";

        }
}
function topBorrowedBooks() 
{
    include '../includes/connect.php';

    $sql = "SELECT `book_code`,
                COUNT(id) AS `total`
            FROM
                `borrows`
            GROUP BY
                `book_code`
            ORDER BY
                `total`
            DESC
            LIMIT 10";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $i = 1;
            while($row = $result->fetch_assoc()) 
            {
                echo topBookDetails($row['book_code'], $i);
                 $i++;

            }

           
        }
    
}
