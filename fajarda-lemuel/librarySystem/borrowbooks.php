<?php 
 
    require('./session.php');
    require('./dbconn.php');
    require('./update.php');
    
    //if user access this page redirect to admin portal
    if ($_SESSION['roleId'] == 2){
        header("location: admin.php");
    };
    $queryBooks = "SELECT * FROM books";
    $sqlBooks = mysqli_query($conn,$queryBooks);

    $booksrowcount = mysqli_num_rows($sqlBooks);

    
    //count Available
    $queryBooksAvailable = "SELECT * FROM books WHERE bookStatus = 0 OR bookStatus = 1 ";
    $sqlBooksAvailable = mysqli_query($conn,$queryBooksAvailable);

    $booksrowcountAvailable = mysqli_num_rows($sqlBooksAvailable);
    
    //count Borrowed
     
    $queryBooksBorrowed = "SELECT * FROM books WHERE bookStatus = 2";
    $sqlBooksBorrowed = mysqli_query($conn,$queryBooksBorrowed);

    $booksrowcountBorrowed = mysqli_num_rows($sqlBooksBorrowed);

    // count returned
    $queryBooksReturned = "SELECT * FROM books WHERE bookStatus = 3";
    $sqlBooksReturned = mysqli_query($conn,$queryBooksReturned);

    $booksrowcountReturned = mysqli_num_rows($sqlBooksReturned);


    //borrow or return books
    if(isset($_POST['borrow'])){
        $bookStatusId = $_POST['bookStatusId'];

        // $queryBorrow = "SELECT * FROM books WHERE bookStatus = '$'"
    $borrowStatus = "UPDATE books SET bookStatus = '2' WHERE id = '$bookStatusId' ";
    mysqli_query($conn,$borrowStatus);
    }

    if(isset($_POST['return'])){
        $bookStatusId = $_POST['bookStatusId'];

        // $queryBorrow = "SELECT * FROM books WHERE bookStatus = '$'"
    $returnStatus = "UPDATE books SET bookStatus = '3' WHERE id = '$bookStatusId' ";
    mysqli_query($conn,$returnStatus);   
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
            <h2 class="nav-title">Library Management System | USER PORTAL</h2>
            </div>      
            <div class="app-main">
                    <div class="app-sidebar sidebar-shadow">
                        <div class="scrollbar-sidebar">
                            <div class="app-sidebar__inner">
                                <ul class="vertical-nav-menu">
                                    <li class="app-sidebar__heading ml-4">Menu</li>
                                    <li>
                                        <a href="home.php" >
                                            User Profile
                                        </a>
                                        <a href="borrowbooks.php" class="mm-active" >
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
                            <div class="row">
                            <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Total Books</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-numbers text-success ml-3"><?php  echo "   ".$booksrowcount;?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Available Books</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-numbers text-success ml-3"><?php  echo "   ".$booksrowcountAvailable;?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Borrowed Books</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-numbers text-success ml-3"><?php  echo "   ".$booksrowcountBorrowed;?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Returned Books</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-numbers text-success ml-3"><?php  echo "   ".$booksrowcountReturned;?></div>
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
                                        
                                        </div>
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Book Name</th>
                                                    <th class="text-center">Author</th>
                                                    <th class="text-center">Book Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                            <?php while($results = mysqli_fetch_array($sqlBooks) ){?>
                                                <tr>
                                                    <td class="text-center text-muted"><?php echo $results['id'];?></td>
                                                    <td class="text-center"><?php echo $results['bookName'];?></td>
                                                    <td class="text-center"><?php echo $results['author'];?></td>
                                                    <td class="text-center"><?php
                                                    
                                                    //0-1 Available
                                                    //2 Borrowed
                                                    //3 Returned 
                                                
                                                    if ($results['bookStatus'] == 0 || $results['bookStatus'] == 1 ){
                                                        echo 'Available';
                                                    }else if($results['bookStatus'] == 2){
                                                        echo 'Borrowed';
                                                    }else{
                                                        echo 'Returned';
                                                    }
                                                    ?></td>
                                                    <td>
                                                    
                                                        <form action="/librarySystem/borrowbooks.php" method="post">
                                                            <input type="hidden" name="bookStatusId" value="<?php echo $results['id'];?>">
                                                            <?php
                                                                if ($results['bookStatus'] == 0 || $results['bookStatus'] == 1){
                                                                    echo '<button type="submit" name="borrow" class="btn btn-warning">Borrow</button>';
                                                                }else if($results['bookStatus'] == 2){
                                                                
                                                                    echo '<button type="submit" name="return" class="btn btn-dark">Return</button>';

                                                                }else if($results['bookStatus'] == 3){
                                                                    echo '<strong>Returned</strong>';

                                                                }
                                                            ?>
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
                                        
        <!-- Modal for Adding Book-->                       
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