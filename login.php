<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

require_once './includes/dbCon.php';

// If Already Logged In
if(isset($_COOKIE['user'])) {
    header("Location: index.php");
}

// If Login Button is Pressed
if(ISSET($_POST['login'])) {
    if($_POST['userid'] != "" || $_POST['password'] != "") {
        $userid = $_POST['userid'];
        $password = $_POST['password'];

        // Query to Match the Login Credentials
        $sql = "SELECT `password` FROM `students` WHERE `uid` = ?";
        $query = $conn->prepare($sql);
        $query->execute(array($userid));
        $userExists = $query->rowCount();
        $fetch = $query->fetch();

        if($userExists) {
            if(password_verify($password, $fetch->password)) {
                // Set Cookie
                $cookie_name = "user";
                $cookie_value = $userid;
                setcookie($cookie_name, $cookie_value, time() + (60*60*24*30), "/");
                
                // Redirect to Main Section
                header("Location: index.php");
            } else{
                $errorMessage = "Invalid Password!";
            }
        } else {
            $errorMessage = "Invalid UserID!";
        }
    } else {
        $errorMessage = "All Fields are Required!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libray - Login</title>
    <meta property="og:title" content="Login to SFMU Library">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Login to SFMU Library">
    <!-- <meta property="og:image" content="https://bdt.netlify.app/assets/images/og-img.png"> -->
    <meta property="og:url" content="http://library.test">

    <!-- ./CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- CSS/. -->

        <!-- ./FAVICON -->
        <link rel="shortcut icon" href="./assets/img/book-icon.svg" type="image/x-icon">
    <!-- FAVICON/. -->
</head>

<body>
    <!-- ./Main -->
    <main>
        <div class="container">
            <div class="text-center h1 text-uppercase mt-4">"There is no friend as loyal as a book"</div>
            <img class="wave" src="./assets/img/wave.png">
            <div class="login-container">
                <div class="col-12 image-part">
                    <div class="libray-image mt-5">
                        <img src="./assets/img/bookshelf.svg">
                    </div>

                </div>
                <div class="col-12 login-content">
                    <div class="login-main mt-5">
                        <div class="login-icon text-center mb-4">
                            <img src="./assets/img/avatar.svg">
                            <h3 class="mt-4 text-center text-uppercase">Login Here</h3>
                        </div>
                        <!-- ./Error Message -->
                        <?php
                        if(isset($errorMessage)) {
                            echo "<div class='p-3 bg-danger text-light'><span class='text-center'>{$errorMessage}</span></div>";
                        }
                        ?>
                        <!-- Error Message/. -->
                        <form action="login.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control input-userid" name="userid" id="userid" placeholder="741810005101001" required>
                                <label for="userid">UserID</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-success text-uppercase btn-login" name="login"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Main/. -->
    <!-- ./LOADER -->
    <div id="pre-loader">
        <div class="loader"></div>
        <div class="loader-text">LOADING</div>
    </div>
    <!-- LOADER./ -->

    <!-- ./JS -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <!-- JS./ -->
</body>

</html>