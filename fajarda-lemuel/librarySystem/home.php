<?php 
    require('./session.php');
    require('./dbconn.php');
    require('./update.php');
    

    //if user access this page redirect to user portal
    if ($_SESSION['roleId'] == 2){
        header("location: admin.php");
    };
    //fetch data from db
    $updateId = $_SESSION['id'];
    $queryUsers = "SELECT * FROM users WHERE id='$updateId'";
    $sqlUsers = mysqli_query($conn,$queryUsers);

    //updating user
    if(isset($_POST['updateProfile'])){
        
        $updateId = $_SESSION['id'];
        $updateFirstName = $_POST['firstname'];
        $updateLastName = $_POST['lastname'];
        $updateUserName = $_POST['username'];
        $updateEmail = $_POST['email'];
        $updateAddress = $_POST['address'];

        $queryUpdate = "UPDATE users SET first_name = '$updateFirstName', last_name = '$updateLastName', username = '$updateUserName', email = '$updateEmail',address = '$updateAddress' WHERE id = '$updateId'";

        $sqlUpdate = mysqli_query($conn,$queryUpdate);
         header("location: home.php");
    }



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet"></head>

    <!-- bootstrap cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!--  google fonts cdn-->
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>


    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-header header-shadow">
            <h2 class="nav-title">Library Management System | USER PORTAL</h2>
            </div>      
            <div class="app-main">
                    <div class="app-sidebar sidebar-shadow">
                        <div class="scrollbar-sidebar">
                            <div class="app-sidebar__inner">
                                <ul class="vertical-nav-menu">
                                    <li class="app-sidebar__heading ml-4">Menu</li>
                                    <li>
                                        <a href="home.php" class="mm-active">
                                            User Profile
                                        </a>
                                        <a href="borrowbooks.php" >
                                            Borrow Books
                                        </a>
                                        <button class="btn btn-dark mt-3 ml-5" onclick="logout()">
                                            Logout
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>    
                    <div class="app-main__outer">
                        <div class="app-main__inner">
                
                        <?php while($results = mysqli_fetch_array($sqlUsers) ){?>

                            <div class="row">
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading"><?php echo 'Username: '.$results['username'] ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                            <div class="card-header">
                                                    <?php echo $results['first_name'].' '.$results['last_name']?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Email: '.$results['email']?></h5>
                                                <h5 class="card-title"><?php echo 'Address: '.$results['address']?></h5>
                                                <h5 class="card-title"><?php echo 'Role: '.$results['roleId']?'User':'Admin' ?></h5>                                                
                                                <form action="/librarySystem/disable.php" method="post">

                                                    <button type="button" class="btn btn-primary update-profile" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="<?php echo $_SESSION['id']?>">
                                                    Update Profile
                                                    </button>
                                                    
                                                    <button class="btn btn-dark" name="disable" type="submit">Disable Account</button>
                                                    </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>

                    </div>
                    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>

        <form action="/librarySystem/home.php" method="post">
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-12">
                            <Label>First Name: </Label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name"  ?>
                            </div>

                            <div class="col-12 mt-4">
                            <Label>Last Name: </Label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name"  ?>
                            </div>

                            <div class="col-12 mt-4">
                            <Label>Username: </Label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username"  ?>
                            </div>

                            <div class="col-12 mt-4">
                            <Label>Email </Label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" ?>
                            </div>

                            <div class="col-12 mt-4">
                            <Label>Address: </Label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address"?>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updateProfile" class="btn btn-primary">Save</button>
                    </div>
                    
                    </div>
                </div>
            </div>
            </form>
        <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
    </body>
</html>



<script>
                                       

$(document).ready(function(){   
    $(document).on('click', '.update-profile', function(){
        var updateId = $(this).attr("id");
        console.log(updateId);
        $.ajax({
            url:'updateUser.php',
            method:'post',
            data:{updateId:updateId},
            dataType:'JSON',
            success: function(data){
                console.log("data",data)
                $('#firstname').val(data.first_name);
                $('#lastname').val(data.last_name);
                $('#username').val(data.username);
                $('#address').val(data.address);
                $('#email').val(data.email);            
            }
        })
    })
})

        
function logout(){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Logout',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php";

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
               
            }
            })
    }
</script>