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
        echo "This film is now added to your watch list!";
        echo <<<_END
        <form action="watchlist.php" method="post">
            <button type="submit" name="showMovie" value="$movie">Click here to view your Watch list</button>
        </form>
        _END;
    }
    else
    {
        echo "You already added this film to your watchlist!";
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
        echo "This film is now removed from your watch list!";
        echo <<<_END
        <form action="watchlist.php" method="post">
            <button type="submit" name="showMovie" value="$movie">Click here to view your Watch list</button>
        </form>
        _END;
    }
    else
    {
        echo "This film is not in your watchlist!";
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
        echo "This film is now marked as watched!";
        echo <<<_END
        <form action="watchlist.php" method="post">
            <button type="submit" name="showMovie" value="$movie">Click here to view your Watch list</button>
        </form>
        _END;
    }
    else
    {
        echo "This film is not in your watchlist!";
    }
} 

else
{
    echo "Fail";
}

?>