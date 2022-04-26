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
        header('Location: details.php');
    }
    else
    {
        echo "You already favourited this film!";
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
        header('Location: details.php');
    }
    else
    {
        echo "Error!";
    }
}

else
{
    echo "You're not supposed to be here";
}

?>