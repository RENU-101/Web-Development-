<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"
        integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <title>iDiscuss Coding Forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>

<!--start insert into comment into db -->
    <?php
        $showAlert = false;
        $id = $_GET['threadid'];
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST')
        {
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;",  $comment);
            $comment = str_replace(">", "&gt;",  $comment);
            $sno =$_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
            VALUES ('$comment', '$id', '$sno', current_timestamp())";
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
<!--end insert into comment into db -->

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id= $id" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        //query the user table to find out the name of op
        $sql2 = "SELECT user_email FROM `user` WHERE sno='$thread_user_id'"; 
        $result1 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result1);
        $posted_by = $row2['user_email'];
    }
   ?>

<!-- category container start here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title;?> </h1>
            <p class="lead"> <?php echo $desc;?> </p>
            <hr class="my-4">
            <p>This world is ready to sharing the knowledge with each other.</p>
            <p>Posted by: <em><?php echo $posted_by;?> </em></p>
        </div>
    </div>
<!-- category container end here -->


<!-- post comment form start here -->
<?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
            echo '<div class="container">
            <h2 class="my-3">Post a Comment</h2>
            <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Post your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                     <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
                    </div>
                <button type="submit" class="btn btn-success">Comment Post</button>
            </form>
        </div>';
        }
        else {
            echo '<div class="container">
                    <h2 class="my-3">Start a Discussions</h2>
                    <p class="lead">you are not logged in. Please login to start a post comment.</p>
                </div>';
        }
   ?>
<!-- post comment form end here -->

<!-- comments store into database from here -->
    <div class="container">
        <h2 class="py-2">Discussions</h2>
        <?php
        $id = $_GET['threadid'];
        $sql = $sql = "SELECT * FROM `comments` WHERE thread_id= $id";
        $result = mysqli_query($conn,$sql);
          $noResult= true;
          while($row = mysqli_fetch_assoc($result)){
          $noResult= false;
          $id = $row['comment_id'];
          $content = $row['comment_content'];
          $comment_time = $row['comment_time'];
          $thread_user_id= $row['comment_by'];
          $sql2 = "SELECT user_email FROM `user` WHERE sno='$thread_user_id'"; 
          $result1 = mysqli_query($conn, $sql2);
          $row2 = mysqli_fetch_assoc($result1);


          echo  '<div class="media my-4">
                  <img src="img/userdefault.jpg" width="54px" class="mr-3" alt="...">
                   <div class="media-body">
                   <p class= "font-weight-bold my-0"> ' . $row2['user_email'] . ' at ' .$comment_time. '</p>
                   ' . $content . '
                   </div>
                </div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                           <h1 class="display-4">No Result Found</h1>
                           <p class="lead">Be the first person to ask a questions.</p>
                        </div>
                    </div>';
            }
        ?>
</div>
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