<?php 
session_start();
require('./dbconn.php');

if(isset($_POST['login'])){
    //getting the data for username and password from the input box
    $loginUsername = trim($_POST['login-username']);
    $loginPassword = trim($_POST['login-password']);

    //checking Whether username and password matches the one in the database
    $queryValidate = "SELECT * FROM users where username ='$loginUsername' AND password = md5('$loginPassword')";
    $sqlValidate = mysqli_query($conn,$queryValidate);
    $rowValidate = mysqli_fetch_array($sqlValidate);

    mysqli_num_rows($sqlValidate);

    if(mysqli_num_rows($sqlValidate) > 0){
        $_SESSION['status'] = 'valid';
        $_SESSION['id'] = $rowValidate['id'];
        $_SESSION['username'] = $rowValidate['username'];
        $_SESSION['roleId'] = $rowValidate['roleId'];
        $_SESSION['accountStatusId'] = $rowValidate['accountStatusId'];



        if($_SESSION['accountStatusId'] == '1'){
            if($_SESSION['roleId'] == '1'){
                header("location: home.php");
    
            }else {
                header("location: admin.php");
            }    
        }else {
            echo "<script>alert('Your account has been disabled')</script>";

        } 

        
    }else {
        $_SESSION['status'] = 'invalid';
        echo "<script>alert('Invalid Password')</script>";
    }
}


// signup
if(isset($_POST['sign_up'])){
   
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
         echo "<script>alert('Registered Succesfully')</script>";
        echo "<script src='https://code.jquery.com/jquery-1.8.2.min.js'></script>";
        echo "<script src='https://code.jquery.com/ui/1.9.2/jquery-ui.js'></script>";

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Library Management System</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <script type="text/javascript">
        (function() {
            // https://dashboard.emailjs.com/admin/account
            emailjs.init('user_niEXpL4JnroqcxLTZcbWb');
        })();
    </script>


    <script type="text/javascript">
        window.onload = function() {
            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault();
                // generate a five digit number for the contact_number variable
                this.contact_number.value = Math.random() * 100000 | 0;
                // these IDs from the previous steps
                emailjs.sendForm('service_u10m351', 'template_4alsino', this)
                    .then(function() {
                        console.log('SUCCESS!');
                    }, function(error) {
                        console.log('FAILED...', error);
                    });
            });
        }
    </script>


</head>
        <body class="bg">
        <!-- Login Form-->
                <div class="wrapper">
                    <form 
                     action="/librarySystem/login.php" method="post">
                    
                        <h1 class="header">Login</h1>
                        <h5 class="header text-center">Library Management System</h5>
                        <div class="input-box">
                            <input type="text" name="login-username" placeholder="Username" required>
                            <i class='bx bxs-user'></i>
                        </div>
                    
        
                        <div class="input-box">
                            <input type="password" name="login-password" placeholder="Password" required>
                            <i class='bx bxs-lock-alt' ></i>
                        </div>
                        
                        <button type="submit" name="login" class="btn">Login</button>
                    </form>
                </div>



        <!-- Sign Up form -->
                <div class="wrapperSignup">
                    <form  action="/librarySystem/login.php" method="post">

                    <input type="hidden" name="contact_number">
                        <h1 class="header">Sign Up</h1>
                        <div class="input-box-signup">
                            <input type="text" name="first_name" placeholder="First Name" required>
                            <i class='bx bxs-user'></i>
                        </div>
                    
                        <div class="input-box-signup">
                            <input type="text" name="last_name" placeholder="Last Name" required>
                            <i class='bx bxs-user'></i>
                        </div>

                        <div class="input-box-signup">
                            <input type="text" name="user_name" placeholder="Username" required>
                            <i class='bx bxs-user-circle'></i>
                        </div>

                        <div class="input-box-signup">
                            <input type="password" name="password" placeholder="Password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>

                        <div class="input-box-signup">
                            <input type="email" id="email" name="email" placeholder="Email Address" required>
                            <i class='bx bxs-envelope'></i>
                        </div>

                        <div class="input-box-signup">
                            <input type="text" name="address" placeholder="Address" required>
                            <i class='bx bxs-map'></i>
                        </div>
                        
                        <button  type="submit" id="submit" name="sign_up" class="btn" onclick="myFunction()">Submit</button>

                    </form>

                    <form id="contact-form">
                    <input type="hidden" name="contact_number">
                        <input type="hidden" name="email" id="emailcontact">
                        <button id="sub" type="submit" value="Send"></button>
                    </form>
                
                </div>
        </body>
</html>

<script>


    function myFunction(){
        var email = $('#email').val();
        $('#emailcontact').append($email);
        $('#sub').click();
       console.log("email",email) 
    }


</script>