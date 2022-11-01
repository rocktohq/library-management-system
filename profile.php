<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

// Required Files
require_once './includes/dbCon.php';
require './includes/connect.php';
require './includes/functions-profile.php';

if(isset($_COOKIE['user'])) {
   
    $userid = $_COOKIE['user'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo userName($userid); ?></title>

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
                <h1 class="text-light p2-3">User Profile</h1>
            </nav>
        </div>
        <!-- TOP NAVBAR/. -->
    </header>
    <!-- HEADER/. -->

    <!-- ./BOTTOM NAVBAR -->
    <nav class="bottom-navbar">
        <a href="index.php" class="fas fa-home"></a>
        <a href="profile.php" class="fas fa-user"></a>
    </nav>
    <!-- BOTTOM NAVBAR/. -->

    <!-- ./PROFILE -->
    <section class="user-profile">
        <div class="row">
            <?php echo userProfile($userid); ?>
        </div>
    </section>
    <!-- PROFILE/. -->

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