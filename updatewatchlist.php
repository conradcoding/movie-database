<?php

include 'header.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['addWatchList']))
{
    $movie = $_POST['addWatchList'];
    $username = $_SESSION['username'];

    $add_to_watchlist_query = "INSERT INTO watchlist (movie_id, username, status) VALUES ('$movie', '$username', 'Planned')";
    $add_to_watchlist_result = mysqli_query($connection, $add_to_watchlist_query);

    if ($add_to_watchlist_result)
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
                            <h5>You have successfully added this movie to your watchlist!</h5>
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
                            <h5>You have already added this movie to your watchlist!</h5>
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


else if (isset($_POST['removeWatchList']))
{
    $movie = $_POST['removeWatchList'];
    $username = $_SESSION['username'];

    $remove_from_watchlist_query = "DELETE FROM watchlist WHERE movie_id = '$movie' AND username = '$username'";
    $remove_from_watchlist_result = mysqli_query($connection, $remove_from_watchlist_query);

    if ($remove_from_watchlist_result)
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
                            <h5>You have successfully removed this movie from your watchlist!</h5>
                            <form action="watchlist.php" method="post">
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
                            <h5>This movie is not in your watchlist!</h5>
                            <form action="watchlist.php" method="post">
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


else if (isset($_POST['setWatched']))
{
    $movie = $_POST['setWatched'];
    $username = $_SESSION['username'];

    $update_status_query = "UPDATE watchlist SET status = 'Watched' WHERE movie_id = '$movie' AND username = '$username'";
    $update_status_result = mysqli_query($connection, $update_status_query);

    if ($update_status_result)
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
                            <h5>You have successfully marked this movie as watched!</h5>
                            <form action="watchlist.php" method="post">
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
                            <h5>This movie is not in your watchlist!</h5>
                            <form action="watchlist.php" method="post">
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
    echo "Fail";
}

?>