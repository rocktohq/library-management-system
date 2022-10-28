<?php

// DepartmentList
function departmentList($departmentName) {
    require 'dbCon.php';

    // Query to Feth the DepartmentList
    $sql = "SELECT * FROM `departments`";
    $query = $conn->query($sql);
    $departments = $query->fetchAll();

    // Print the DepartmentList
    echo "<ul>";
    foreach($departments as $department) {
        // Active Class
        if($departmentName == strtolower($department->department)) {
            $activeClass = " active ";
        } else {
            $activeClass = " ";
        }

        echo "<li class='department'>
            <a href='departments.php?name={$department->department}' class='button{$activeClass}text-uppercase'>{$department->department}</a>
        </li>";
    }
    echo "</ul>";
}


// Top BookList
function topBooks($departmentName) {
    require 'dbCon.php';

    // Query to Feth the Top BookList
    $sql = "SELECT * FROM `books` WHERE `department` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($departmentName));
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        $bookName = substr($book->book_name, 0, 25);
        $bookAuthor = substr($book->book_author, 0, 20);

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
                    <h4>{$bookName}...</h4>
                    <div class='author'><span class='muted small'>by</span> <span class='text-primary'>{$bookAuthor}...</span></div>
                    <a href='book.php?id={$book->id}' class='button text-uppercase'>Book Details</a>
                </div>
            </div>";
    }
}

// New BookList
function newBooks($departmentName) {
    require 'dbCon.php';

    // Query to Feth the New BookList
    $sql = "SELECT * FROM `books` WHERE `department` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($departmentName));
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        $bookName = substr($book->book_name, 0, 40);
        $bookAuthor = substr($book->book_author, 0, 40);
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

        echo "<a href='book.php?id={$book->id}' class='swiper-slide box' title='{$book->book_name}'>
                <div class='image'>
                    <img src='{$bookPath}{$bookCover}' alt=''>
                </div>
                <div class='content'>
                    <h4>{$bookName}</h4>
                    <div class='author fs-5'><span class='muted'>by</span> <span class='text-primary'>{$bookAuthor}</span></div>
                    <div class='author fs-5'><span class='muted'>Department:</span> <span class='text-primary'>{$department}</span></div>
                </div>
            </a>";
    }
}


// All BookList
function allBooks($departmentName) {
    require 'dbCon.php';

    // Query to Feth the All BookList
    $sql = "SELECT * FROM `books` WHERE `department` = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($departmentName));
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        $bookName = substr($book->book_name, 0, 40);
        $bookAuthor = substr($book->book_author, 0, 40);
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
                    <div class='author fs-5'><span class='muted'>by</span> <span class='text-primary'>{$bookAuthor}</span></div>
                    <div class='author fs-5'><span class='text-secondary'>Department:</span> <span class='text-secondary text-uppercase'>{$department}</span></div>
                </div>
            </a>";
    }
}

// All BookList Reverse
function allBooksRev($departmentName) {
    require 'dbCon.php';

    // Query to Feth the All BookList
    $sql = "SELECT * FROM `books` WHERE `department` = ? ORDER BY `created_at` DESC";
    $query = $conn->prepare($sql);
    $query->execute(array($departmentName));
    $books = $query->fetchAll();

    // Print the BookList
    foreach($books as $book) {
        $bookName = substr($book->book_name, 0, 40);
        $bookAuthor = substr($book->book_author, 0, 40);
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
                    <div class='author fs-5'><span class='muted'>by</span> <span class='text-primary'>{$bookAuthor}</span></div>
                    <div class='author fs-5'><span class='text-secondary'>Department:</span> <span class='text-secondary text-uppercase'>{$department}</span></div>
                </div>
            </a>";
    }
}