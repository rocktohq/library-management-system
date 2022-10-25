<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

// Required Files
require_once './includes/dbCon.php';
include './includes/functions-departments.php';

if(isset($_COOKIE['user'])) {

    if(isset($_GET['name'])) {
        $departmentName = strtolower($_GET['name']);
    }

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Department <?php echo strtoupper($departmentName); ?> - Library</title>

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
                <!-- ./SEARCHBAR -->
                <form action="search-r.php" class="search-form">
                    <input type="search" name="keywords" placeholder="search here..." id="search-box">
                    <label for="search-box" class="fas fa-search"></label>
                </form>
                <!-- SEARCHBAR/. -->
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
                    <a href="#featured">Top Books</a>
                    <a href="#allbooks">All Books</a>
                </nav>
            </div>
            <!-- TOP NAVBAR/. -->
        </header>
        <!-- HEADER/. -->

        <!-- ./BOTTOM NAVBAR -->
        <nav class="bottom-navbar">
            <a href="index.php" class="fas fa-home"></a>
            <a href="#featured" class="fas fa-list"></a>
            <a href="#allbooks" class="fas fa-tags"></a>
        </nav>
        <!-- BOTTOM NAVBAR/. -->

        <!-- ./DEPARTMENTS -->
        <section class="departments py-5">
            <h1 class="heading"> <span class="text-uppercase">Departments</span> </h1>
            <?php echo departmentList($departmentName); ?>
        </section>
        <!-- DEPARTMENTS/. -->

        <!-- FEATURED  -->
        <section class="featured" id="featured">
            <h1 class="heading"> <span class="text-uppercase">Top Books</span> </h1>
            <div class="swiper featured-slider">
                <div class="swiper-wrapper">
                    <?php echo topBooks($departmentName); ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <!-- FEATURED/. -->

        <!-- ./ALL BOOKS  -->
        <section class="arrivals" id="allbooks">
            <h1 class="heading"> <span class="text-uppercase">All Books</span> </h1>
            <div class="swiper arrivals-slider">
                <div class="swiper-wrapper">
                <?php echo allBooks($departmentName); ?>
                </div>
            </div>
            <!-- ::REVERSE:: -->
            <div class="swiper arrivals-slider">
                <div class="swiper-wrapper">
                <?php echo allBooksRev($departmentName); ?>
                </div>
            </div>
        </section>
        <!-- ALL BOOKS/. -->

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