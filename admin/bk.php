<?php

include '../includes/connect.php';

if(isset($_GET['a'])) {

    // Show Data
    if($_GET['a'] === 'showlist') {
        if(isset($_POST['displayData'])) {
            $i = 1;
            $sql = "SELECT * FROM `books`";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    echo "<tr>
                            <td class='fw-bold'>{$i}</td>
                            <td>{$row['book_name']}</td>
                            <td class='text-center'>".strtoupper($row["book_code"])."</td>
                            <td class='text-center'>".strtoupper($row["department"])."</td>
                            <td class='text-center'>{$row['book_quantity']}</td>
                            <td class='text-center'>
                                <form action='' method='POST'>
                                    <input type='hidden' name='uid' value='{$row['id']}'>
                                    <button class='btn btn-danger' type='submit' name='delete'><i class='bi bi-trash'></i></button>
                                    <button class='btn btn-primary' type='submit' name='update'><i class='bi bi-pencil'></i></button>
                                </form>
                            </td>
                        </tr>";
                    $i++;
                }
            }
            else{
                echo "<tr><td colspan='6' class='text-center'>0 result's found</td></tr>";
            }
        }          
    }

    // Show Data
    if($_GET['a'] === 'search') {
        if(isset($_POST['name'])) {
            $i = 1;
            $sql = "SELECT * FROM `books` WHERE `book_name` LIKE '%".$_POST['name']."%' OR `book_code` LIKE '%".$_POST['name']."%' OR `department` LIKE '%".$_POST['name']."%'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    
                    echo "<tr>
                            <td class='fw-bold'>{$i}</td>
                            <td>{$row['book_name']}</td>
                            <td class='text-center'>".strtoupper($row["book_code"])."</td>
                            <td class='text-center'>".strtoupper($row["department"])."</td>
                            <td class='text-center'>{$row['book_quantity']}</td>
                            <td class='text-center'>
                                <form action='' method='POST'>
                                    <input type='hidden' name='uid' value='{$row['id']}'>
                                    <button class='btn btn-danger' type='submit' name='delete'><i class='bi bi-trash'></i></button>
                                    <button class='btn btn-primary' type='submit' name='update'><i class='bi bi-pencil'></i></button>
                                </form>
                            </td>
                        </tr>";
                    $i++;
                }
            }
            else{
                echo "<tr><td colspan='6' class='text-center'>0 result's found</td></tr>";
            }
        }          
    }

}