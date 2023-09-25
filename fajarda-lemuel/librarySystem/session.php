<?php 
 session_start();
    
 if($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])){
     //set default invalid
     $_SESSION['status'] = 'invalid';

     echo "<script>window.location.href = '/librarySystem/login.php'</script>";
     
 }

?>