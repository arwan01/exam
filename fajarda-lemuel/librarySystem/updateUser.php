<?php 

require('./dbconn.php');


if (isset($_POST['updateId'])){

    $updateId = $_POST['updateId'];
    $getUser = "SELECT * FROM users WHERE id = '$updateId'";
    $queryGetUser = mysqli_query($conn,$getUser);
    $row = mysqli_fetch_array($queryGetUser);
    echo json_encode($row);
}


?>