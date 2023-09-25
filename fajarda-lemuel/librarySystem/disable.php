<?php 
require('./dbconn.php');
require('./session.php');


        if(isset($_POST['disable'])){
            
            $disableId = $_SESSION['id'];
    
            // $queryBorrow = "SELECT * FROM books WHERE bookStatus = '$'"
            $returnStatus = "UPDATE users SET accountStatusId = '2' WHERE id = '$disableId' ";
            mysqli_query($conn,$returnStatus);   

            echo '<script>alert("Your account has been disabled"); window.location.href="login.php";</script>';
            

        }

?>