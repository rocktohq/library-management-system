<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

// Required Files
require_once './includes/dbCon.php';
require './includes/connect.php';
require './includes/functions-main.php';
require './includes/functions-wishlist.php';

session_start();
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
}
if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
}

if(isset($_COOKIE['user'])) {
    $userid = $_COOKIE['user'];

    // WishList
    if(isset($_POST['remove'])) {
        $book_code = $_POST['book_code'];

        // Query to Delete from WishList
        $sql = "DELETE FROM `wishlist` WHERE `book_code` = '$book_code'";
        $result = $connect->query($sql);
        if($result) {
            $_SESSION['success'] = "Book has been Removed from the WishList";
            header("Location: wishlist.php");
        } else {
            $_SESSION['error'] = "Error Removing Book in the WishList";
            header("Location: wishlist.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WishList</title>

    <!-- ./CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/book.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- CSS/. -->

    <!-- ./FAVICON -->
    <link rel="shortcut icon" href="./assets/img/book-icon.svg" type="image/x-icon">
    <!-- FAVICON/. -->

</head>

<body>

    <!-- ./HEADER  -->
    <header class="header">
        <div class="header-1">
            <a href="index.php" class="logo"> <i class="fas fa-book"></i> LIBRARY </a>
            <form action="search-r.php" class="search-form">
                <input type="search" name="keywords" placeholder="search here..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>
            <div class="icons d-flex justify-contents-center align-items-center">
                <div id="search-btn" class="fas fa-search"></div>
                <a href="wishlist.php" class="fas fa-heart"></a>
                <a href="borrowlist.php" class="fas fa-shopping-cart"></a>
                <!-- Profile Options -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link fas fa-user" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-end profile-options px-2" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="profile.php">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="profile-update.php">Update Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Profile Options -->
            </div>
        </div>

        <!-- ./SEARCH RESULTS -->
        <div class="col-sm-6 offset-sm-3 bg-secondary text-light" id="show-results"></div>
        <!-- SEARCH RESULTS/. -->
        
        <!-- ./TOP NAVBAR -->
        <div class="header-2">
            <nav class="top-navbar">
                <a href="index.php">Home</a>
                <a href="#wishlist">WishList</a>
            </nav>
        </div>
        <!-- TOP NAVBAR/. -->
    </header>
    <!-- HEADER/. -->

    <!-- ./BOTTOM NAVBAR -->
    <nav class="bottom-navbar">
        <a href="index.php" class="fas fa-home"></a>
        <a href="#wishlist" class="fas fa-list"></a>
    </nav>
    <!-- BOTTOM NAVBAR/. -->

    <!-- ./DEPARTMENTS -->
    <section class="departments py-5">
        <h1 class="heading"><span class="text-uppercase">Departments</span></h1>
        <?php echo departmentList(); ?>
    </section>
    <!-- DEPARTMENTS/. -->

    <!-- ./WishList  -->
    <section class="featured" id="wishlist">
        <h1 class="heading"><span class="text-uppercase">WishList</span></h1>
        <!-- ./NOTIFICATION -->
        <?php
        if(isset($success)) {
            echo "<div class='col-8 offset-2'><div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <span class='text-success'><i class='bi bi-check-circle-fill'></i></span> <span>{$success}</span>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></div>";
            unset($_SESSION['success']);
        }
        ?>
        <?php
        if(isset($error)) {
            echo "<div class='col-8 offset-2'><div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <span class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i></span> <span>{$error}</span>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></div>";
            unset($_SESSION['error']);
        }
        ?>
        <!-- NOTIFICATION/. -->
        <div class="wishlist">
        <table class="table table-bordered border-success table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Book Code</th>
                    <th scope="col">Author</th>
                    <th scope="col">Department</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo wishList($userid); ?>
            </tbody>
        </table>
        </div>
    </section>
    <!-- WishList/. -->

    <!-- ./FOOTER -->
    <?php include './includes/footer.php'; ?>
    <!-- FOOTER/. -->

    <!-- ./LOADER -->
    <div class="loader-container">
        <img src="./assets/image/loader-img.gif" alt="">
    </div>
    <!-- LOADER/. -->

    <!-- ./JS -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $("#search-box").keyup(function(){
                let searchdata = $("#search-box").val();
                if(!searchdata) {
                    $("#show-results").html('');
                } else {
                    $.ajax({
                        type:'POST',
                        url:'search.php',
                        data:{
                            keywords:searchdata,
                            userid:<?php echo $userid; ?>,
                        },
                        success:function(data){
                            $("#show-results").html(data);
                        }
                    });
                }
            });
        });
    </script>
    <!-- JS./ -->

</body>

</html>
<?php
} else {
    header("Location: login.php");
}