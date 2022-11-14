<?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
            echo '<div class="container">
            <h2 class="my-3">Post a Comment</h2>
            <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Post your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Comment Post</button>
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