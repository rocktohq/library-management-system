<?php

require_once './includes/connect.php';
if(isset($_POST['keywords'])) {
if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];
}

    if($_POST['keywords']) {

        $sql = "SELECT * FROM `books` WHERE `book_name` LIKE '%".$_POST['keywords']."%' OR `book_code` LIKE '%".$_POST['keywords']."%' OR `department` LIKE '%".$_POST['keywords']."%' ORDER BY `id` LIMIT 5";
        $result = $connect->query($sql);
        if($result->num_rows > 0){
            echo '<ol class="p-3">';
            while($row = $result->fetch_assoc()) {
                
                echo "<li class='mb-2'>
                        <a class='text-light' href='search-book.php?id={$row['id']}&uid={$userid}'>{$row['book_name']}</a>
                    </li>";
            }
            echo '</ol>';
        }
        else{
            echo "<div class='text-center p-3'>No book found!</div>";
        }
    } else {
    }
}