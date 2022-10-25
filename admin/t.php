<?php

include 'connect.php';

if(isset($_GET['a'])) {

    // Show Data
    if($_GET['a'] === 'showlist') {
        if(isset($_POST['displayData'])) {
            $i = 1;
            $sql = "SELECT * FROM `teachers`";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    echo "<tr class='text-center'>
                            <td class='fw-bold'>{$i}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['uid']}</td>
                            <td>".strtoupper($row["department"])."</td>
                            <td class='text-center'>
                                <form action='' method='POST'>
                                    <input type='hidden' name='uid' value='{$row['id']}'>
                                    <button class='btn btn-danger' type='submit' name='delete'><i class='bi bi-trash'></i></button>
                                </form>
                            </td>
                        </tr>";
                    $i++;
                }
            }
            else{
                echo "<tr><td colspan='5' class='text-center'>0 result's found</td></tr>";
            }
        }          
    }

    // Show Data
    if($_GET['a'] === 'search') {
        if(isset($_POST['name'])) {
            $i = 1;
            $sql = "SELECT * FROM `teachers` WHERE `name` LIKE '%".$_POST['name']."%' OR `uid` LIKE '%".$_POST['name']."%'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    
                    echo "<tr class='text-center'>
                            <td class='fw-bold'>{$i}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['uid']}</td>
                            <td>".strtoupper($row["department"])."</td>
                            <td class='text-center'>
                                <span class='me-1 btn btn-danger' onclick='deleteUser({$row['id']})'><i class='bi bi-trash'></i></span>
                            </td>
                        </tr>";
                    $i++;
                }
            }
            else{
                echo "<tr><td colspan='5' class='text-center'>0 result's found</td></tr>";
            }
        }          
    }

}