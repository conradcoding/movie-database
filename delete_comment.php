<?php

include "header.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_SESSION['loggedIn']) && ($_SESSION['username'] == 'admin'))
{
    if (isset($_POST['movie']) && (isset($_POST['comment'])))
    {
        $movie = $_POST['movie'];
        $comment = $_POST['comment'];

        $delete_comment_query = "DELETE FROM comments WHERE movie_id = '$movie' AND comment = '$comment'";
        $delete_comment_result = mysqli_query($connection, $delete_comment_query);

        if ($delete_comment_result)
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
                                <h5>You have successfully deleted this comment!</h5>
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
                                <h5>You were unable to delete this comment!</h5>
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
                            <h5>You were unable to delete this comment!</h5>
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

?>