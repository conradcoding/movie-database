<?php
include ('header.php');
if (isset($_SESSION['loggedIn']))
{
    $_SESSION = array();
    setcookie(session_name() , "", time() - 2592000, '/');
    session_destroy();

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
                        <h5>You have successfully logged out!</h5>
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
                        <h5>You are not logged in!</h5>
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
include ('footer.php');
?>
