<?php

// User Name
function userName($userid) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `students` WHERE `uid` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $user = $query->fetch();

    if($user) {
        echo $user->name;
    }
}

// Author Name
function authorName($book_code) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `book_code` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$book_code]);
    $book = $query->fetch();

    if($book) {
        echo $book->book_author;
    }
}

// Department Name
function departName($book_code) {
    require 'dbCon.php';

    // Query to Feth the Book Details
    $sql = "SELECT * FROM `books` WHERE `book_code` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$book_code]);
    $book = $query->fetch();

    if($book) {
        echo strtoupper($book->department);
    }
}

// DepartmentList
function departmentList() {
    require 'dbCon.php';

    // Query to Feth the DepartmentList
    $sql = "SELECT * FROM `departments`";
    $query = $conn->query($sql);
    $departments = $query->fetchAll();

    // Print the DepartmentList
    echo "<ul>";
    foreach($departments as $department) {
        echo "<li class='department'>
            <a href='departments.php?name={$department->department}' class='button text-uppercase'>{$department->department}</a>
        </li>";
    }
    echo "</ul>";
}


// Top BookList
function topBooks() {
    require 'dbCon.php';

    // Query to Feth the New BookList
    $sql = "SELECT * FROM `books` ORDER BY `created_at` DESC LIMIT 10";
    $query = $conn->query($sql);
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        if(strlen($book->book_name) > 15 ) {
            $bookName = substr($book->book_name, 0, 15). "...";
        } else $bookName = $book->book_name;

        if(strlen($book->book_author) > 15 ) {
            $bookAuthor = substr($book->book_author, 0, 15). "...";
        } else $bookAuthor = $book->book_author;

        $department = strtolower($book->department);

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

        echo "<div class='swiper-slide box'>
                <div class='icons'>
                    <a href='' class='fas fa-search'></a>
                    <a href='' class='fas fa-heart'></a>
                    <a href='' class='fas fa-eye'></a>
                </div>
                <div class='image'>
                    <img src='{$bookPath}{$bookCover}' alt='' title='{$book->book_name}'>
                </div>
                <div class='content'>
                    <h4>{$bookName}</h4>
                    <div class='author'><span class='muted small'>by</span> <span class='text-primary'>{$bookAuthor}</span></div>
                    <div class='author'><a href='departments.php?name={$department}'><span class='muted'>Department:</span> <span class='text-primary text-uppercase'>{$department}</span></a></div>
                    <a href='book.php?id={$book->id}' class='button text-uppercase'>Book Details</a>
                </div>
            </div>";
    }
}

// New BookList
function newBooks() {
    require 'dbCon.php';

    // Query to Feth the New BookList
    $sql = "SELECT * FROM `books` ORDER BY `created_at` DESC LIMIT 10";
    $query = $conn->query($sql);
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        if(strlen($book->book_name) > 40 ) {
            $bookName = substr($book->book_name, 0, 40). "...";
        } else $bookName = $book->book_name;

        if(strlen($book->book_author) > 40 ) {
            $bookAuthor = substr($book->book_author, 0, 40). "...";
        } else $bookAuthor = $book->book_author;

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

        echo "<a href='book.php?id={$book->id}' class='swiper-slide box'>
                <div class='image'>
                    <img src='{$bookPath}{$bookCover}' alt='' title='{$book->book_name}'>
                </div>
                <div class='content'>
                    <h3>{$bookName}</h3>
                    <div class='author'><span class='muted'>by</span> <span class='text-primary'>{$bookAuthor}</span></div>
                    <div class='author'><span class='text-secondary'>Department:</span> <span class='text-secondary text-uppercase'>{$department}</span></div>
                </div>
            </a>";
    }
}

// New BookList Reverse
function newBooksRev() {
    require 'dbCon.php';

    // Query to Feth the New BookList
    $sql = "SELECT * FROM `books` WHERE `id` BETWEEN 10 AND 20";
    $query = $conn->query($sql);
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        
        if(strlen($book->book_name) > 40 ) {
            $bookName = substr($book->book_name, 0, 40). "...";
        } else $bookName = $book->book_name;

        if(strlen($book->book_author) > 40 ) {
            $bookAuthor = substr($book->book_author, 0, 40). "...";
        } else $bookAuthor = $book->book_author;

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

        echo "<a href='book.php?id={$book->id}' class='swiper-slide box'>
                <div class='image'>
                    <img src='{$bookPath}{$bookCover}' alt='' title='{$book->book_name}'>
                </div>
                <div class='content'>
                    <h3>{$bookName}</h3>
                    <div class='author'><span class='muted'>by</span> <span class='text-primary'>{$bookAuthor}</span></div>
                    <div class='author'><span class='text-secondary'>Department:</span> <span class='text-secondary text-uppercase'>{$department}</span></div>
                </div>
            </a>";
    }
}

// Top Book Code
function topBookCode() {
    include 'connect.php';

    $sql = "SELECT `book_code`, COUNT(id) as `count` FROM `borrows` ORDER BY `count` DESC LIMIT 1";
    $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['book_code'];
        }
}
// Top Book
function topBook() {
    require 'dbCon.php';
    $book_code = topBookCode();
    // Query to Feth the New BookList
    $sql = "SELECT * FROM `books` WHERE `book_code` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$book_code]);
    $book = $query->fetch();

    // Print the Book
    if(strlen($book->book_name) > 40 ) {
        $bookName = substr($book->book_name, 0, 40). "...";
    } else $bookName = $book->book_name;

    if(strlen($book->book_author) > 40 ) {
        $bookAuthor = substr($book->book_author, 0, 40). "...";
    } else $bookAuthor = $book->book_author;

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
    echo "<div class='content'>
            <h3 class='text-uppercase'>Top Borrowed Book</h3>
            <h2>{$book->book_name}</h2>
            <p>Author: <span class='text-primary'>{$bookAuthor}</span></p>
            <a href='book.php?id={$book->id}' class='button text-uppercase'>See Details</a>
        </div>";
        echo " <div class='top-book'>
                <img src='{$bookPath}{$bookCover}' alt='' title='{$book->book_name}'>
            </div>";
}

