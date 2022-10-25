<?php

// User Details
function userName($userid) {
    require 'dbCon.php';

    // Query to Feth the User Details
    $sql = "SELECT * FROM `students` WHERE `uid` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $user = $query->fetch();

    return $user->name;
}

// User Details
function userProfile($userid) {
    require 'dbCon.php';

    // Query to Feth the User Details
    $sql = "SELECT * FROM `students` WHERE `uid` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $user = $query->fetch();

    // Print the User Details
    $department = strtoupper($user->department);

    $userPath = "./uploads/profile/";
    if($user->photo) {
        if (file_exists($userPath.$user->photo)) {
            $photo = $user->photo;
        } else {
            $photo = "avatar.svg";
        }
    } else {
        $photo = "avatar.svg";
    }

    echo "<div class='col-sm-6'>
            <div class='book-cover'>
                <img class='img-fluid' src='{$userPath}{$photo}'' alt=''>
            </div>
        </div>
        <div class='col-sm-6'>
        <div class='user-info'>
            <h5>Student Name: {$user->name}</h5>
            <h5>Department: {$department}</h5>
            <h5>Admission Session: {$user->session}</h5>
            <h5>Batch: {$user->batch}</h5>
            <h5>Year: {$user->year} : {$user->semester}</h5>
            <h5>Phone: {$user->phone}</h5>
            <h5>Total Borrowed Books: ";
            echo totalBorrowed($userid);
        echo "</h5>
        </div>
    </div>";
}


// Borrowed Books
function totalBorrowed($userid) {
    require 'dbCon.php';

    // Query to Feth the User Details
    $sql = "SELECT * FROM `borrows` WHERE `borrowed_by` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $total = $query->rowCount();

    return $total;
}

// WishList Books
function totalWishList($userid) {
    require 'dbCon.php';

    // Query to Feth the User Details
    $sql = "SELECT * FROM `wishlist` WHERE `listed_by` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
    $total = $query->rowCount();

    return $total;
}