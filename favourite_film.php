<?php

include 'header.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['favourite_film']))
{
    $movie = $_POST['favourite_film'];
    $username = $_SESSION['username'];

    $add_to_favourites_query = "INSERT INTO favourite_films (movie_id, username) VALUES ('$movie', '$username')";
    $add_to_favourites_result = mysqli_query($connection, $add_to_favourites_query);

    if ($add_to_favourites_result)
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
                            <h5>You have successfully favourited this movie!</h5>
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
                            <h5>You have already favourited this movie!</h5>
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

else if (isset($_POST['remove_film']))
{
    $movie = $_POST['remove_film'];
    $username = $_SESSION['username'];

    $remove_from_favourites_query = "DELETE FROM favourite_films WHERE movie_id = '$movie' AND username = '$username'";
    $remove_from_favourites_result = mysqli_query($connection, $remove_from_favourites_query);

    if ($remove_from_favourites_result)
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
                            <h5>You have successfully removed this movie from your favourites!</h5>
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
                            <h5>There was an error removing this movie from your favourites!</h5>
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
                        <h5>You are not supposed to be here!</h5>
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

?>