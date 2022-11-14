<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"
        integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <!-- style sheet -->
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <!-- style sheet end -->

    <title>iDiscuss Coding Forum</title>
</head>

<!-- statr body -->

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>


    <!-- start post the thread into database -->
    <?php
    $showAlert = false;
    $id = $_GET['catid'];
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        //inerst into thread into db
        $th_title =$_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;",  $th_title);
        $th_title = str_replace(">", "&gt;",  $th_title);

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);

        $sno =$_POST['sno'];
        $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`,
         `thread_user_id`, `dt`) 
         VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
         if($showAlert){
             echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
         }
    }
?>
    <!-- end  post the thread into the database -->

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id= $id" ;
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <!-- category container start here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> World</h1>
            <p class="lead"> <?php echo $catdesc;?>.</p>
            <hr class="my-4">
            <p>This world is ready to sharing the knowledge with each other.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <!-- category container end here -->

    <!-- Disscussion form start here -->
    <?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
            echo '<div class="container">
                        <h2 class="my-3">Start a Discussions</h2>
                        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Problem Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">keep your title short as and crisp as possible else.</small>
                            </div>
                            <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Elleborate Your Concern</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>';
        }
        else {
            echo '<div class="container">
                    <h2 class="my-3">Start a Discussions</h2>
                    <p class="lead">you are not logged in. Please login to start a discussion.</p>
                </div>';
        }
   ?>
    
    <!-- Disscussion form end here -->

    <!-- threadlist database container start here -->
    <div class="container" id="ques">
        <h2 class="py-2">Discussions</h2>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id= $id" ;
        $result = mysqli_query($conn, $sql);
          $noResult= true;
          while($row = mysqli_fetch_assoc($result)){
          $noResult= false;
          $id = $row['thread_id'];
          $title = $row['thread_title'];
          $desc = $row['thread_desc'];
          $thread_time = $row['dt'];
          $thread_user_id= $row['thread_user_id'];
          $sql2 = "SELECT user_email FROM `user` WHERE sno='$thread_user_id'"; 
          $result1 = mysqli_query($conn, $sql2);
          $row2 = mysqli_fetch_assoc($result1);
        
          echo  '<div class="media my-4">
                  <img src="img/userdefault.jpg" width="54px" class="mr-3" alt="...">
                   <div class="media-body">'.
                   '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' .$id. '">'. $title .' </a></h5>
                   ' . $desc . '</div>'.'<div class="font-weight-bold my-0">Asked by:  ' . $row2['user_email'] . ' at ' . $thread_time .'</div>'.
                   
                '</div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                           <p class="display-4">No Result Found</p>
                           <p class="lead">Be the first person to ask a questions.</p>
                        </div>
                    </div>';
            }
         ?>

    </div>
    <!-- threadlist database container end here -->


    <?php include 'partials/_footer.php';?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"
        integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous">
    </script>
</body>

</html>