<?php 

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'librarysystem';

$conn = mysqli_connect($host,$username,$password,$dbname);

if (mysqli_connect_error()){
    echo 'unsuccessful';
}else {
    //echo 'success';
}

?>