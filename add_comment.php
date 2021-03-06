<?php

include 'header.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_SESSION['loggedIn']))
{
    $movie = $_POST['movie'];
    $comment = $_POST['comment'];
    $comment_date = date("Y/m/d");
    $username = $_SESSION['username'];
    
    //If user attempts to submit
    if (isset($_POST['comment']))
    {
        //Define query and result
        $add_comment_query = "INSERT INTO comments (comment, comment_date, movie_id, username) VALUES ('$comment', '$comment_date', '$movie', '$username')";
        $add_comment_result = mysqli_query($connection, $add_comment_query);

        //If there is a result..
        if($add_comment_result)
        {
            echo <<<_END
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="card shadow">
                            <div class="card-header">
                                <h1>System Message</h1>
                            </div>
                            <div class="card-body">
                                <h5>You have successfully commented on this movie!</h5>
                                <form action="details.php" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit" name="showMovie" value="$movie">Click here to return</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br>
            _END;
        }
        else
        {
            echo <<<_END
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="card shadow">
                            <div class="card-header">
                                <h1>System Message</h1>
                            </div>
                            <div class="card-body">
                                <h5>Your comment was unable to be posted!</h5>
                                <form action="details.php" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit" name="showMovie" value="$movie">Click here to return</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br>
            _END;
        }

    }
    //If user posts invalid input
    else
    {
        echo <<<_END
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="card shadow">
                        <div class="card-header">
                            <h1>System Message</h1>
                        </div>
                        <div class="card-body">
                            <h5>Your comment was unable to be posted!</h5>
                            <form action="details.php" method="post">
                                <button class="btn btn-primary btn-sm" type="submit" name="showMovie" value="$movie">Click here to return</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
        _END;
    }
}
else
{
    echo <<<_END
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="card shadow">
                    <div class="card-header">
                        <h1>System Message</h1>
                    </div>
                    <div class="card-body">
                        <h5>You're not supposed to be here!</h5>
                        <form action="index.php" method="post">
                            <button class="btn btn-primary btn-sm" type="submit">Click here to return</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
    _END;
}

//Close connection
mysqli_close($connection);

?>