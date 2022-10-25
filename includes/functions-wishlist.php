<?php

function wishList($userid) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `wishlist` WHERE `listed_by` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $books = $query->fetchAll();
    $i = 1;

    foreach($books as $book) {
        echo "<tr><td>{$i}</td><td>";      
        echo boookName($book->book_code);
        echo "</td><td class='text-uppercase'>{$book->book_code}</td><td>";
        echo authorName($book->book_code);
        echo "</td><td>";
        echo departName($book->book_code);
        echo "</td><td>";
        echo "<form action='wishlist.php' method='POST'>
                <input type='hidden' name='book_code' value='{$book->book_code}'>
                <button type='submit' name='remove' class='btn btn-danger'>Remove Book</button>
            </form>
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