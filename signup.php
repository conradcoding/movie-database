<?php

include ('header.php');
include ('sanitise.php');

$username_errors = "";
$password_errors = "";
$errors = "";
$signup_form = false;
$signupMessage = "";

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
                        <h5>You have successfully in, please log out!</h5>
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
        $checkusername = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $checkusername);
        $n = mysqli_num_rows($result);
        if ($n > 0)
        {
            echo "Sorry the username $username is already taken.";
            $signup_form = true;
        } 
        else 
        {
            $query = "INSERT INTO users (username, password) 
            VALUES ('$username','$password')";
            $result = mysqli_query($connection, $query);
            if ($result)
            {
                $signupMessage = "Hello $username, your account has been created. Please <a href='login.php'>click here to login.</a>";
            }
            else
            {
                $signup_form = true;
                $message = "Sign up failed, please try again!";
            }

            mysqli_close($connection);
        }
    }
    else
    {
        echo "<b>Sign-up Failed";
        echo "$errors";
        $signup_form = true;
    }
}
else
{
    $signup_form = true;
}

if ($signup_form)
{
    echo <<<_END
            <h3>Create an account</h3>
            <form id="signupform" action="signup.php" method="POST">
            <div class="mb-3">
            <label for ="username" class="form-label">Username:</label>
            <input type="text" maxlength="16" minlength="1" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for ="password" class="form-label">Password:</label>
            <input type="password" maxlength="76" minlength="1" id="password" name="password" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Create Account">
            </form>
            _END;
            
}
            
echo $signupMessage;
                      
include('footer.php');
echo"</body> </html>";

?>
