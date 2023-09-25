<?php 
 
    require('./session.php');
    require('./dbconn.php');
    require('./update.php');

    
    //if user access this page redirect to user portal
    if ($_SESSION['roleId'] == 1){
        header("location: home.php");
    };
    //read
    $queryBooks = "SELECT * FROM books";
    $sqlBooks = mysqli_query($conn,$queryBooks);

    $booksrowcount = mysqli_num_rows($sqlBooks);

    //create
    if(isset($_POST['bookCreate'])){
           
            $bookName = $_POST['bookName'];
            $author = $_POST['author'];
            $bookStatus = 1;

            $queryBooksCheck = "SELECT * FROM books WHERE bookName='$bookName' AND author='$author'";
            $sqlBooksConn = mysqli_query($conn,$queryBooksCheck);

             mysqli_fetch_array($sqlBooksConn);

            if(mysqli_num_rows($sqlBooksConn) > 0){
               
            } else{
                $queryCreateBook = "INSERT INTO books VALUES(null,'$bookName','$author','$bookStatus')";
                $sqlCreateBook = mysqli_query($conn,$queryCreateBook);
                header("location: admin.php");
            }
             
    }

    if(isset($_POST['bookId'])){


        $queryBookId = "SELECT * FROM books WHERE id = '".$_POST['bookId']."' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }


    //delete
    if(isset($_POST['deleteBook'])){

        $deleteID = $_POST['deleteID'];
        $deleteBook = "DELETE FROM books WHERE id='$deleteID'";
        mysqli_query($conn, $deleteBook);
        header("location: admin.php");

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
                                    <a href="admin.php" class="mm-active">
                                        Book List
                                    </a>
                                    <a href="users.php" class="">
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
                                                <div class="widget-heading">Total Number of Books</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success ml-3"><?php  echo "   ".$booksrowcount;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Book Lists
                                        <div class="btn-actions-pane-right">                                
                                                <!-- <button type="button" class="active btn btn-focus" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Book</button> -->
                                                <!-- Button trigger modal -->
                                                <button type="button" class="active btn btn-focus" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                                Add a Book
                                                </button>
                                                
                                              


                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Book Name</th>
                                                <th class="text-center">Author</th>
                                                <th class="text-center">Book Status</th>

                                                <!-- <th class="text-center">Status</th> -->
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           <?php while($results = mysqli_fetch_array($sqlBooks) ){?>
                                            <tr>
                                                <td class="text-center text-muted"><?php echo $results['id'];?></td>
                                                <td class="text-center"><?php echo $results['bookName'];?></td>
                                                <td class="text-center"><?php echo $results['author'];?></td>
                                                <td class="text-center"><?php
                                                if ($results['bookStatus'] == 0 || $results['bookStatus'] == 1){
                                                    echo 'Available';
                                                }else if($results['bookStatus'] == 2){
                                                    echo 'Borrowed';
                                                }else{
                                                    echo 'Returned';
                                                }
                                                ?></td>
 

                                                <!-- Update Books -->
                                                <td class="text-center">
                                                    <form action="/librarySystem/admin.php" method="post">
                                                         

                                                <button type="button" name="editBook" id="<?php echo $results['id'];?>" class="btn btn-warning btn-sm edit_data" data-bs-toggle="modal" data-bs-target="#exampleModal1">Update</button>
                                                <input type="hidden" name="editBookName" id="editBookName" value="<?php echo $results['bookName'] ?>">


                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="/librarySystem/admin.php" method="post">
                                                         <button type="submit" name="deleteBook" id="PopoverCustomT-1" class="btn btn-danger btn-sm">Delete</button>
                                                         <input type="hidden" name="deleteID" value="<?php echo $results['id'] ?>">

                                             
                                                    </form>
                                                </td>
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
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

                                
      <!-- updateModal -->

      
      <div class="modal fade edit-modal"  id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Book no # </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
      
                        <form action="/librarySystem/update.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id">
           
                                <div class="row">
                                    <div class="col-12">
                                        <label>Book Name</label>
                                    <input type="text" class="form-control" id="bookName" placeholder="" name="updateBookName" required>
                                    
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <label>Book Author</label>
                                    <input type="text" class="form-control" id="author" placeholder="Enter Book Author"  name="updateAuthor" required>
                                    </div>
                                </div>
                                <input type="hidden" name="updateBookId" id="updateBookId">            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="active btn btn-focus">Save changes</button>
                            
                        </div>
                    </form>
                    </div>
            </div>
        </div>  
        </form>
                                      
       <!-- Modal -->

                                            
       <div class="modal fade "  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add a Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/librarySystem/admin.php" method="post">
                                <div class="row">
                                    <div class="col-12">
                                        <label>Book Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Book Name" name="bookName" required>
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <label>Book Author</label>
                                    <input type="text" class="form-control" placeholder="Enter Book Author" name="author" required>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="bookCreate" class="active btn btn-focus">Save changes</button>
                        </div>
                        </form>
                    </div>
            </div>
        </div>  


       
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
</body>
</html>


<script>
                                       
$(document).ready(function(){   
    $(document).on('click', '.edit_data', function(){
        var bookId = $(this).attr("id");

        $('#updateBookId').val(bookId);
        console.log(bookId);
        $.ajax({
            url:'update.php',
            method:'post',
            data:{bookId:bookId},
            dataType:'JSON',
            success: function(data){
                console.log("data",data)
                $('#exampleModalLabel').text('Update Book #' + data.id);
                $('#bookName').val(data.bookName);
                $('#author').val(data.author);
                $('#updateBookId').val(data.id);
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