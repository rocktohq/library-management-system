<?php


// Book Name
function boookName($bookId) {
    require 'dbCon.php';

    // Query to Feth the Book Name
    $sql = "SELECT `book_name` FROM `books` WHERE `id` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($bookId));
    $book = $query->fetch();

    return $book->book_name;
}


// Book Details
function bookDetails($bookId) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `id` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($bookId));
    $book = $query->fetch();

    // Print the Book Details
    $department = strtoupper($book->department);

    $bookPath = "./uploads/books/";
    if($book->book_cover) {
        if (file_exists($bookPath.$book->book_cover)) {
            $bookCover = $book->book_cover;
        } else {
            $bookCover = "book_cover.svg";
        }
    } else {
        $bookCover = "book_cover.svg";
    }

    $count = bookQuantity($book->book_code) - borrwCount($book->book_code);
    if($count > 0) {
        $availibity = "<span class='text-success'>Available</span> [{$count}]";
    } else {
        $availibity = "<span class='text-danger'>Not Available</span>";
    }

    echo "<div class='col-sm-6'>
            <div class='book-cover'>
                <img class='img-fluid' src='{$bookPath}{$bookCover}'' alt=''>
            </div>
        </div>
        <div class='col-sm-6'>
        <div class='book-info'>
            <h2>{$book->book_name}</h2>
            <h5 class='mt-2'><span>Book Code: </span><span class='text-primary text-uppercase'>{$book->book_code}</span></h5>
            <h5 class='mt-2'><span>Author: </span><span class='text-muted'>{$book->book_author}</span></h5>
            <h5 class='mt-2'><span>Department: </span><a href='departments.php?name={$book->department}'><span>{$department}</span></a></h5>
            <h5 class='mt-2'><span>Availability: </span>";
            echo $availibity;
            echo "</h5>";
            echo "<form action='book.php?id={$bookId}' method='POST' class='ms-auto mt-5'>
                <input type='hidden' name='book_code' value='{$book->book_code}'>
                <input type='hidden' name='book_id' value='{$book->id}'>";
                if($count > 0) {
                    echo "<button type='submit' name='borrow' class='btn btn-success text-uppercase me-2'>Borrow This Book</button>";
                }
                echo "<button type='submit' name='wishlist' class='btn btn-danger text-uppercase'>Add to WishList</button>
            </form>
        </div>
        </div>";
}

function bookAvailable($bookId) {
    require 'connect.php';
    $sql = "SELECT COUNT(id) as `count` FROM `borrows` WHERE `book_code` = '$bookId'";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }

}


function bookQuantity($book_code) {
    require 'connect.php';
    $sql = "SELECT `book_quantity` FROM `books` WHERE `book_code` = '$book_code'";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['book_quantity'];
        }

}

function borrwCount($book_code) {
    require 'connect.php';
    $sql = "SELECT COUNT(id) as `count` FROM `borrows` WHERE `book_code` = '$book_code' AND `confirmed` = '1' AND `returned` = '0'";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }

}

function addWishList($bookId, $userid) {
    require 'dbCon.php';


    // Query to Feth the WishList Details
    $sql = "SELECT * FROM `wishlist` WHERE `listed_by` = ? AND `book_code` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($userid, $bookId));
    $exist = $query->rowCount();
    $book = $query->fetch();

    if($exist) {
        $_SESSION['error'] = "Book Already in the WishList";
    } else {
        // Insert Into WishList
        $sql = "INSER INTO `wishlist` (book_code, listed_by) VALUES(?, ?)";
        $query = $conn->prepare($sql);
        $query->execute(array($bookId, $userid));

        if($result) {
            $_SESSION['message'] = "Book isn't in theWishList";
        } else {
            $_SESSION['error'] = "Error Adding Book in the WishList";
        }
    }
}

function bookId($bookId) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `id` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($bookId));
    $exist = $query->rowCount();
    $book = $query->fetch();

    if($exist) {
        return $book->id;
    }
}