<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

require_once '../includes/dbCon.php';

// If Already Logged In
if(isset($_COOKIE['lmsadmin'])) {
    header("Location: index.php");
}

// If Login Button is Pressed
if(ISSET($_POST['login'])) {
    if($_POST['username'] != "" || $_POST['password'] != "") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to Match the Login Credentials
        $sql = "SELECT `password` FROM `admins` WHERE `name` = ?";
        $query = $conn->prepare($sql);
        $query->execute(array($username));
        $userExists = $query->rowCount();
        $fetch = $query->fetch();

        if($userExists) {
            if(password_verify($password, $fetch->password)) {
                // Set Cookie
                $cookie_name = "lmsadmin";
                $cookie_value = $username;
                setcookie($cookie_name, $cookie_value, time() + (60*60*24*30), "/");
                
                // Redirect to Main Section
                header("Location: index.php");
            } else{
                $errorMessage = "Invalid Password!";
            }
        } else {
            $errorMessage = "Invalid UserName!";
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
    <title>Admin Dashboard</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>

<body>

    <!-- Main Contents -->
    <div class="admin-login">
        <main class="mt-5 pt-3">
            <div class="container">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="my-5 text-center">Admin Login</h1>
                    <?php
                        if(isset($errorMessage)) {
                            echo "<div><div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <span class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i></span> <span>{$errorMessage}</span>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div></div>";
                        }
                    ?>
                    <form action="login.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Admin" required>
                            <label for="username">UserName</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-3">
                            <button class="btn btn-success text-uppercase btn-login" name="login"><i class="bi bi-box-arrow-in-right"></i> Admin Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <!-- Main Contents -->

    <!-- Footer -->
    <div class="admin-login">
        <?php include '../includes/footer.php' ?>
    </div>
    <!-- Footer -->

    <!-- JavaScripts -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- JavaScripts -->

</body>

</html>