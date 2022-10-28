<?php

/*  #   Library Management System
	#   Application by Saidul Mursalin
	#   Design & Developed by Saidul Mursalin
	#   Contact: facebook/itzmonir
*/

include 'connect.php';
// include 'functions/charts.php';
// include 'functions/counter.php';
include 'functions/dashboard.php';

session_start();
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
}
if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
}

if(isset($_COOKIE['lmsadmin'])) {
    $userid = $_COOKIE['user'];

    // Request
    if(isset($_POST['approve'])) {
        $book_id = $_POST['book_id'];
        $issued_date = Date('Y-m-d', time());
        $return_date = Date('Y-m-d', strtotime('+10 days'));

        $sql = "UPDATE 
                    `borrows` 
                SET 
                    `confirmed`='1', `borrowed_date` = '$issued_date', `return_date` = '$return_date' 
                WHERE 
                    `id` = '$book_id'";
        $result = $connect->query($sql);
        if($result) {
            $_SESSION['success'] = "Book Confirmed";
            header("Location: borrow-requests.php");
        } else {
            $_SESSION['error'] = "Error Confirming Book!";
            header("Location: borrow-requests.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Requests</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">

            <!-- OffCanvas Trigger -->
            <button class="navbar-toggler border-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><span class="me-1"><i class="bi bi-sliders2"></i></span></button>
            <!-- OffCanvas Trigger -->

            <a class="navbar-brand fw-bold text-uppercase me-auto" href="index.php">AdminSystem</a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="h3">
                <i class="bi bi-list"></i>
            </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Search -->
                <form class="d-flex ms-auto">
                    <div class="input-group my-3 my-lg-0">
                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <!-- Search -->

                <!-- Profile Options -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Profile Options -->

            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- OffCanvas -->
    <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <button type="button" class="text-reset ms-auto p-3 offcanvas-mobile-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-square"></i></button>

        <!-- OffCanvas Nav -->
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li class="px-3">
                        <a class="nav-link active" href="index.php">
                            <span class="me-2">
                        <i class="bi bi-speedometer2"></i>
                    </span>
                            <span>
                        Dashboard
                    </span>
                        </a>
                    </li>
                    <li class="my-2">
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3">
                            Management
                        </div>
                    </li>
                    <!-- Librarian List -->
                    <li>
                        <a class="nav-link px-3" href="librarians.php">
                            <span class="me-2"><i class="bi bi-person-circle"></i></span>
                            <span>Librarians</span>
                        </a>
                    </li>
                    <!-- Librarian List -->
                    <!-- Requests -->
                    <li>
                        <a class="nav-link active px-3 sidebar-link" data-bs-toggle="collapse" href="#requests" role="button" aria-expanded="false" aria-controls="requests">
                            <span class="me-2"><i class="bi bi-bell-fill"></i></span>
                            <span>Requests</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="requests">
                            <div>
                                <ul class="navbar-nav px-3">
                                    <li>
                                        <a class="nav-link active px-3" href="borrow-requests.php">
                                            <span class="me-2"><i class="bi bi-list-columns-reverse"></i></span>
                                            <span>Borrow Requests</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav px-3">
                                    <li>
                                        <a class="nav-link px-3" href="return-requests.php">
                                            <span class="me-2"><i class="bi bi-list-columns"></i></span>
                                            <span>Return Requests</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Requests -->
                    <!-- StudentList -->
                    <li>
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#studentList" role="button" aria-expanded="false" aria-controls="studentList">
                            <span class="me-2"><i class="bi bi-person-fill"></i></span>
                            <span>Students</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="studentList">
                            <div>
                                <ul class="navbar-nav px-3">
                                    <li>
                                        <a class="nav-link px-3" href="students.php">
                                            <span class="me-2"><i class="bi bi-list-columns-reverse"></i></span>
                                            <span>Students List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- StudentList -->
                    <!-- TeacherList -->
                    <li>
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#teacherList" role="button" aria-expanded="false" aria-controls="teacherList">
                            <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
                            <span>Teachers</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="teacherList">
                            <div>
                                <ul class="navbar-nav px-3">
                                    <li>
                                        <a class="nav-link px-3" href="teachers.php">
                                            <span class="me-2"><i class="bi bi-list-columns-reverse"></i></span>
                                            <span>Teachers List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- TeacherList -->
                    <!-- BookList -->
                    <li>
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#bookList" role="button" aria-expanded="false" aria-controls="bookList">
                            <span class="me-2"><i class="bi bi-book"></i></span>
                            <span>Books</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="bookList">
                            <div>
                                <ul class="navbar-nav px-3">
                                    <li>
                                        <a class="nav-link px-3" href="bookshelves.php">
                                            <span class="me-2"><i class="bi bi-bookshelf"></i></span>
                                            <span>Departments</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="addbookshelf.php">
                                            <span class="me-2"><i class="bi bi-plus-square"></i></span>
                                            <span>Add Department</span>
                                        </a>
                                    </li>
                                    <li class="mx-3">
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="books.php">
                                            <span class="me-2"><i class="bi bi-journal-richtext"></i></span>
                                            <span>Books List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="addbook.php">
                                            <span class="me-2"><i class="bi bi-plus-square"></i></span>
                                            <span>Add Book</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- BookList -->
                    <li class="my-2">
                        <hr class="dropdown-divider">
                    </li>
                    <!-- Others -->
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3">
                            Other Services
                        </div>
                    </li>
                    <!-- Top Books -->
                    <li>
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#topBooks" role="button" aria-expanded="false" aria-controls="topBooks">
                            <span class="me-2"><i class="bi bi-journals"></i></span>
                            <span>Top Books</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="topBooks">
                            <div>
                                <ul class="navbar-nav px-3">
                                    <li>
                                        <a class="nav-link px-3" href="topsearched.php">
                                            <span class="me-2"><i class="bi bi-journal-album"></i></span>
                                            <span>Top Searched Books</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="topbooks.php">
                                            <span class="me-2"><i class="bi bi-journal-bookmark"></i></span>
                                            <span>Top Borrowed Books</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Top Books -->
                    <!-- PreBooked -->
                    <li>
                        <a class="nav-link px-3" href="prebooked.php">
                            <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                            <span>Prebooked Books</span>
                        </a>
                    </li>
                    <!-- PreBooked -->
                    <li class="my-2">
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </nav>
        </div>
        <!-- OffCanvas Nav -->

    </div>
    <!-- OffCanvas -->

    <!-- Main Contents -->
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 fw-bold fs-3 my-2">Borrow Requests</div>

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

            </div>

            <!-- Librarian Notifications -->
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card text-dark bg-default h-100">
                        <div class="card-header fw-bold">Book Lending Requests</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class='table table-hover table-bordered cursor-pointer col-sm-12'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Book Code</th>
                                            <th class='px-3'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
                            $i = 1;

                            $sql = "SELECT * FROM `borrows` WHERE `confirmed` = 0 ORDER BY `id`";
                            $result = $connect->query($sql);
                            if($result->num_rows) {
                                while($row = $result->fetch_assoc()) {
                                    echo "
                                            <tr>
                                                <td>{$i}</td>
                                                <td>{$row['borrowed_by']}</td>
                                                <td class='text-uppercase'>{$row['book_code']}</td>
                                                <td class='text-center'>
                                                    <form action='' method='POST'>
                                                        <input type='hidden' name='book_id' value='{$row['id']}'>
                                                        <button class='btn btn-success' type='submit' name='approve'>Approve</button>
                                                    </form>
                                                </td>
                                            </tr>";
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No request found!</td></tr>";
                            }
                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Librarian Notifications -->

        </div>
    </main>
    <!-- Main Contents -->

    <!-- Footer -->
    <?php include './functions/footer.php'; ?>
    <!-- Footer -->

    <!-- JavaScripts -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>
<?php
} else {
    header("Location: login.php");
}