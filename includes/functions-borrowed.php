<?php

//Borrowed List
function borrowList($userid) {
    require 'dbCon.php';

    $confirmed = 1;
    $orderby = "borrowed_date";
    // Query to Feth the Book Details
    $sql = "SELECT * FROM `borrows` WHERE `borrowed_by` = ? AND `confirmed` = ? ORDER BY ".$orderby ." DESC";
    $query = $conn->prepare($sql);
    $query->execute([$userid, $confirmed]);
    $books = $query->fetchAll();
    $i = 1;

    foreach($books as $book) {

        $return_date = new DateTime($book->return_date);
        $borrow_date = new DateTime($book->borrowed_date);

        $return_date = date_format($return_date,"d M Y");
        $borrow_date = date_format($borrow_date,"d M Y");

        echo "<tr><td>{$i}</td><td>";      
        echo boookName($book->book_code);
        echo "</td><td class='text-uppercase'>{$book->book_code}</td><td>";
        echo $borrow_date;
        echo "</td><td>";
        echo $return_date;
        echo "</td><td>";

        if($book->returned) {
            echo "Returned";
        } else {
            echo "<form action='' method='POST'>
            <input type='hidden' name='book_code' value='{$book->book_code}'>
            <input type='hidden' name='borrowed_date' value='{$book->borrowed_date}'>
            <input type='hidden' name='return_date' value='{$book->return_date}'>
            <button class='btn btn-success' type='submit' name='return'>Return</button>
            </form>
            </td></tr>";
        }

        $i++;
    }
}

//Borrowed List
function notConfirmed($userid) {
    require 'dbCon.php';

    $confirmed = 0;
    // Query to Feth the Book Details
    $sql = "SELECT * FROM `borrows` WHERE `borrowed_by` = ? AND `confirmed` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid, $confirmed]);
    $books = $query->fetchAll();
    $i = 1;

    foreach($books as $book) {

        $return_date = new DateTime($book->return_date);
        $borrow_date = new DateTime($book->borrowed_date);

        $return_date = date_format($return_date,"d M Y");
        $borrow_date = date_format($borrow_date,"d M Y");

        echo "<tr><td>{$i}</td><td>";      
        echo boookName($book->book_code);
        echo "</td><td class='text-uppercase'>{$book->book_code}</td><td>";
        echo $borrow_date;
        echo "</td><td>";
        echo "Estimated: {$return_date}";
        echo "</td><td>";
        echo "Not Confirmed
        </td></tr>";

        $i++;
    }
}

// Book Name
function boookName($book_code) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `book_code` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$book_code]);
    $book = $query->fetch();

    if($book) {
        echo $book->book_name;
    }
}
