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


session_start();
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
}
if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
}



if(isset($_COOKIE['user'])) {
   
    $userid = $_COOKIE['user'];


    if(isset($_POST['change'])) {

        // print_r($_POST);
    
        $oldpass = $connect->real_escape_string($_POST['old']);
        $newpass = $connect->real_escape_string($_POST['new']);
        $newhpass = password_hash($newpass, PASSWORD_DEFAULT);

        $sql = "SELECT `password` FROM `students` WHERE `uid` = '$userid'";
        $result = $connect->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mainpass = $row['password'];

            // Compare the Passwords
            if(password_verify($oldpass, $mainpass)) {
                
                $sql = "UPDATE
                        `students`
                    SET
                        `password` = '$newhpass'
                    WHERE 
                        `uid` = '$userid'";
                $result = $connect->query($sql);
                if($result) {
                    $_SESSION['success'] = "Password Has Been Changed.";
                    header("Location: profile-update.php");
                } else {
                    $_SESSION['error'] = "Something Went Wrong!";
                }

            } else { 
                $_SESSION['error']  = 'Incorrect Old Password!';
            }
        }

    }

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
            <a href="/" class="logo"> <i class="fas fa-book"></i> LIBRARY </a>
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
                <h1 class="text-light py-2">Update Profile</h1>
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
    <section class="profile-update">
        <div class="col-sm-6 offset-sm-3">
             <!-- ./NOTIFICATION -->
        <?php
        if(isset($success)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <span class='text-success'><i class='bi bi-check-circle-fill'></i></span> <span>{$success}</span>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            unset($_SESSION['success']);
        }
        ?>
        <?php
        if(isset($error)) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <span class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i></span> <span>{$error}</span>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            unset($_SESSION['error']);
        }
        ?>
        <!-- NOTIFICATION/. -->

            <form action="profile-update.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="old" id="old" placeholder="Old Password" required>
                    <label for="old">Old Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="new" id="new" placeholder="New Password" required>
                    <label for="new">New Password</label>
                </div>
                <div class="form-floating mt-3">
                    <button class="btn btn-success" name="change">Change Password</button>
                </div>
            </form>
        </div>
    </section>
    <!-- PROFILE/. -->

    <!-- ./FOOTER -->
    <footer class="p-5 bg-dark text-light">
        <div class="dev">
            <p class="text-center fs-5">Design & Developed by <span class="highlight">Saidul Mursalin</span>. Supervised by <span class="highlight">Fazle Rabbi Rushu</span></p>
        </div>
    </footer>
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