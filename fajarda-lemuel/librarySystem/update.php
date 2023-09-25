<?php 
require('./dbconn.php');

if (isset($_POST['bookId'])){

    $bookId = $_POST['bookId'];
    $getBook = "SELECT * FROM books WHERE id = '$bookId'";
    $queryGetBook = mysqli_query($conn,$getBook);
    $row = mysqli_fetch_array($queryGetBook);
    echo json_encode($row);
}

    
if(isset($_POST['update'])){
   
    $updateId = $_POST['updateBookId'];
    $updateBookName = $_POST['updateBookName'];
    $updateAuthor = $_POST['updateAuthor'];
    $queryUpdate = "UPDATE books SET bookName = '$updateBookName', author = '$updateAuthor' WHERE id = '$updateId'";
    $sqlUpdate = mysqli_query($conn,$queryUpdate);
    header("location: admin.php");
}
?>