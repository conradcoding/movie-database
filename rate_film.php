<?php

include 'header.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$rating = $_POST['rating_value'];
$rating_date = date("Y/m/d");
$movie = $_POST['movie'];
$username = $_SESSION['username'];

if (isset($_POST['rating_value']))
{
    $check_existing_rating_query = "SELECT * FROM ratings WHERE movie_id = '$movie' AND username = '$username'";
    $check_existing_rating_result = mysqli_query($connection, $check_existing_rating_query);
    $n = mysqli_num_rows($check_existing_rating_result);

    if ($n > 0)
    {
        $update_user_rating_query = "UPDATE ratings SET rating = '$rating', rating_date = '$rating_date' WHERE movie_id = '$movie' AND username = '$username'";
        $update_user_rating_result = mysqli_query($connection, $update_user_rating_query);

        $update_vote_average_query = "UPDATE movies SET vote_average = (SELECT SUM(rating) FROM ratings WHERE movie_id = '$movie') / vote_count WHERE movie_id = '$movie'";
        $update_vote_average_result = mysqli_query($connection, $update_vote_average_query);
        
        if ($update_user_rating_result && $update_vote_average_result)
        {
            echo "You have successfully changed your rating for this movie!";
            echo <<<_END
                <form action="details.php" method="post">
                    <button type="submit" name="showMovie" value="$movie">Click here to return</button>
                </form>
            _END;
        }
        else
        {
            echo "Error!";
        }
    }
    
    else
    {
        $add_rating_query = "INSERT INTO ratings (movie_id, rating, rating_date, username) VALUES ('$movie', '$rating', '$rating_date', '$username')";
        $add_rating_result = mysqli_query($connection, $add_rating_query);

        $update_vote_count_query = "UPDATE movies SET vote_count = (vote_count + 1) WHERE movie_id = '$movie'";
        $update_vote_count_result = mysqli_query($connection, $update_vote_count_query);

        $update_vote_average_query = "UPDATE movies SET vote_average = (SELECT SUM(rating) FROM ratings WHERE movie_id = '$movie') / vote_count WHERE movie_id = '$movie'";
        $update_vote_average_result = mysqli_query($connection, $update_vote_average_query);

        if($add_rating_result && $update_vote_count_result && $update_vote_average_result)
        {
            echo "You have successfully rated this movie!";
            echo <<<_END
                <form action="details.php" method="post">
                    <button type="submit" name="showMovie" value="$movie">Click here to return</button>
                </form>
            _END;
        }
        else
        {
            echo "You already rated this film!";
        }
    }
}
else
{
    echo "Error!";
}

?>