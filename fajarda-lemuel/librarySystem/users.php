<?php 
    
    require('./session.php');
    require('./dbconn.php');
    require('./update.php');
    
    //read

    $queryUsers = "SELECT * FROM users";
    $sqlUsers = mysqli_query($conn,$queryUsers);

    $usersrowcount = mysqli_num_rows($sqlUsers);

    if(isset($_POST['able'])){
        $userId = $_POST['userId'];
        
        $statusUser = "UPDATE users SET accountStatusId = '2' WHERE id = '$userId' ";
        mysqli_query($conn,$statusUser);
    }

    if(isset($_POST['disable'])){
        $userId = $_POST['userId'];
        $statusUser = "UPDATE users SET accountStatusId = '1' WHERE id = '$userId' ";
        mysqli_query($conn,$statusUser);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet"></head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <link rel="stylesheet" href="css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>


<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
        <h2 class="nav-title">Library Management System | ADMIN PORTAL</h2>
        </div>      
           <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                      <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading ml-4">Menu</li>
                                <li>
                                    <a href="admin.php" class="active">
                                        Book List
                                    </a>
                                    <a href="users.php" class="mm-active">
                                        Users
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
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Number of Users</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success ml-3"><?php  echo "   ".$usersrowcount;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">User Lists
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">First Name</th>
                                                <th class="text-center">Last Name</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Account Status Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                           <?php while($results = mysqli_fetch_array($sqlUsers) ){?>
                                            <tr>
                                                <td class="text-center text-muted"><?php echo $results['id'];?></td>
                                                <td class="text-center"><?php echo $results['first_name'];?></td>
                                                <td class="text-center"><?php echo $results['last_name'];?></td>
                                                <td class="text-center"><?php echo $results['username'];?></td>
                                                <td class="text-center"><?php echo $results['email'];?></td>
                                                <td class="text-center"><?php echo $results['address'];?></td>
                                                <td class="text-center"><?php echo $results['roleId'] == 1 ? 'user' : 'admin' ;?></td>
                                                    
                                                <form action="/librarySystem/users.php" method="post">
                                                    <td class="text-center">
                                                    <?php echo $results['accountStatusId']=='1'? '<button type="submit" class="btn btn-primary" name="able" value="1">Enable</button>':'<button type="submit" class="btn btn-dark" name="disable" value="2">Disable</button>' ;?>
                                                         <input type="hidden" name="userId" value="<?php echo $results['id'];?>">
                                                    </td>
                                                </form>
                                            </tr>
                                            <?php } ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
        </div>
    </div>

                            
       
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
</body>
</html>


<script>

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