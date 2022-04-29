<?php

include ('header.php');
include ('sanitise.php');

$login_form = false;
$loginMessage = "";
$username_errors = "";
$password_errors = "";
$errors = "";
if (isset($_SESSION['loggedIn']))
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
                        <h5>You are already logged in! Please log out first!</h5>
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
elseif (isset($_POST['username']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
    $username = sanitise($username, $connection);
    $password = sanitise($password, $connection);

    $username_errors = validateString($username, 1, 16);
    $password_errors = validateString($password, 1, 76);
    $errors = $username_errors . $password_errors;

    if ($errors == "")
    {

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result);
        if ($n > 0)
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;

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
                                <h5>Hello $username, you have successfully logged in!</h5>
                                <form action="index.php" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit">Click here to enter</button>
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
            $login_form = true;
            $loginMessage = "Sign in failed, please try again<br>";
        }

        mysqli_close($connection);
    }
    else
    {
        echo "Login failed $errors";
        $login_form = true;
    }
}

else
{
    $login_form = true;
}

if ($login_form)
{
    echo <<<_END
     <h3>Login</h3>
     <form id="loginform" action="login.php" method="POST">
     <div class="mb-3">
     <label for ="username" class="form-label">Username:</label>
     <input type="text" maxlength="16" minlength="1" id="username" name="username" class="form-control" required>
     </div>
     <div class="mb-3">
     <label for ="password" class="form-label">Password:</label>
     <input type="password" maxlength="76" minlength="1" id="password" name="password" class="form-control" required>
     </div>
     <input type="submit" class="btn btn-primary" value="Login">
     </form>
_END;
    

    
}

echo $loginMessage;

include ('footer.php');
echo "</body></html>";

?>

