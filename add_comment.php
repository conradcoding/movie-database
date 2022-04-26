<?php

include 'header.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

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
        header('Location: details.php');
    }
    else
    {
        echo "<a href='details.php'>Please click here to return to the previous page</a>";
    }

}
//If user posts invalid input
else
{
    echo "Error!";
}

//Close connection
mysqli_close($connection);

?>