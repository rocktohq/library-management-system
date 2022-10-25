<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

// Required Files
require './includes/connect.php';
require './includes/functions-main.php';

session_start();
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
}
if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
}

if(isset($_COOKIE['user'])) {
    $userid = $_COOKIE['user'];


    if(isset($_GET['keywords'])) {
        $key = $_GET['keywords'];
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

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

    <!-- ./SEARCH RESULTS  -->
    <section class="search-results">
        <h1 class="heading"><span class="text-uppercase">Search Results</span></h1>

        <?php

            $sql = "SELECT * FROM `books` WHERE `book_name` LIKE '%".$key."%' OR `book_code` LIKE '%".$key."%' OR `department` LIKE '%".$key."%'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                echo '<ol class="p-3">';
                while($row = $result->fetch_assoc()) {

                    $bookPath = "./uploads/books/";
                    if($row['book_cover']) {
                        if (file_exists($bookPath.$row['book_cover'])) {
                            $bookCover = $row['book_cover'];
                        } else {
                            $bookCover = "book_cover.svg";
                        }
                    } else {
                        $bookCover = "book_cover.svg";
                    }
                    
                    echo "<li class='mb-2'>
                            <a href='book.php?id={$row['id']}'>
                            <img class='' width='50' src='{$bookPath}{$bookCover}'' alt=''> {$row['book_name']}
                            </a>
                        </li>";
                }
                echo '</ol>';
            }
            else{
                echo "<div class='text-center p-3'>No book found!</div>";
            }
        ?>
        

    </section>
    <!-- SEARCH RESULTS/. -->

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