<?php

function bookName($bookId) {
    require '../includes/dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `id` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($bookId));
    $exist = $query->rowCount();
    $book = $query->fetch();

    if($exist) {
        return $book->book_name;
    }
}

function bookDept($bookId) {
    require '../includes/dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `id` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($bookId));
    $exist = $query->rowCount();
    $book = $query->fetch();

    if($exist) {
        return $book->department;
    }
}

include '../includes/connect.php';

if(isset($_GET['a'])) {

    // Show Data
    if($_GET['a'] === 'showlist') {
        if(isset($_POST['displayData'])) {
            $i = 1;
            $sql = "SELECT * FROM `searches` ORDER BY `hits` DESC LIMIT 10";
            $result = $connect->query($sql);
            if($result->num_rows){
                while($row = $result->fetch_assoc()) {

                    echo "<tr class='text-center'>
                            <td class='fw-bold'>{$i}</td><td>";
                            echo bookName($row['book_code']);
                            echo "</td><td class='text-uppercase'>";
                            echo bookDept($row['book_code']);
                            echo "</td>
                            <td>{$row['hits']}</td>
                        </tr>";
                    $i++;
                }
            }
            else{
                echo "<tr><td colspan='5' class='text-center'>0 result's found</td></tr>";
            }
        }          
    }

    // Show Data
    if($_GET['a'] === 'search') {
        if(isset($_POST['name'])) {
            $i = 1;
            $sql = "SELECT * FROM `students` WHERE `name` LIKE '%".$_POST['name']."%' OR `uid` LIKE '%".$_POST['name']."%'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    
                    echo "<tr class='text-center'>
                            <td class='fw-bold'>{$i}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['uid']}</td>
                            <td>".strtoupper($row["department"])."</td>
                            <td class='text-center'>
                                <span class='me-1 btn btn-danger' onclick='deleteUser({$row['id']})'><i class='bi bi-trash'></i></span>
                            </td>
                        </tr>";
                    $i++;
                }
            }
            else{
                echo "<tr><td colspan='5' class='text-center'>0 result's found</td></tr>";
            }
        }          
    }

}