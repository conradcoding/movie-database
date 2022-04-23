<?php
include ('header.php');
if (isset($_SESSION['loggedIn']))
{
    $_SESSION = array();
    setcookie(session_name() , "", time() - 2592000, '/');
    session_destroy();
    echo "Now Logged out.<br>[<a href='index.php'>Return home</a>]";
}
else
{
    echo "You are not logged in.";
}
include ('footer.php');
?>
