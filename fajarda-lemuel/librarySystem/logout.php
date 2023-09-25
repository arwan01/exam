<?php 

session_start();



session_unset();
session_destroy();
$_SESSION['status']='invalid';
echo "<script>window.location.href = '/librarySystem/login.php'</script>";

?>