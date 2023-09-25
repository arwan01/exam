<?php 
    require('./dbconn.php');

    
   
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $roleId = 1;
        $accountStatusId = 1;
    
        $queryEmailCheck = "SELECT * FROM users WHERE email='$email'";
        $sqEmailCheck = mysqli_query($conn,$queryEmailCheck);    
    
        $queryUsersCheck = "SELECT * FROM users WHERE username='$username' OR password= md5('$password')";
        $sqlUsersCheck = mysqli_query($conn,$queryUsersCheck);
    
        mysqli_fetch_array($sqlUsersCheck);
    
        if(mysqli_num_rows($sqlUsersCheck) > 0){
            echo '<script>alert("Existing username or password")</script>';
          
        } else{
            $sqlCreate = "INSERT INTO users VALUES (null,'$firstname','$lastname','$username',md5('$password'),'$email','$address','$roleId','$accountStatusId')";
            $queryCreate = mysqli_query($conn,$sqlCreate);
        }
    
    



?>