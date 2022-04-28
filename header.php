<?php
    require_once "credentials.php";
    session_start();

    echo <<<_END

        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Movie Database</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel='stylesheet' id='stylesheet' href='css/stylesheet.css'">
        </head>
    
        <body>

            <header>
                <h1>Revived Blockbuster</h1>
            </header>
    _END;
    $navigation = "";
    
    if(isset($_SESSION['loggedIn']))
    {
        if ($_SESSION['username'] == 'admin')
            {
                //Admin prviledges
                /*
                *manage users
                */
                $navigation = 
                "
                <body>
                    <nav class='navbar navbar-expand-sm bg-warning justify-content-center'>
                            <ul class='navbar-nav'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='index.php'>Home</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='search.php'>Search</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='.php'>Create Movie</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='.php'>Manage All Movies</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='.php'>Manage Users</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='.php'>Sign-Out ({$_SESSION['username']})</a>
                                </li>
                            </ul>
                    </nav>
                ";

            }
            else
            {
                $navigation = 
                "
                <body>
                    <nav class='navbar navbar-expand-sm bg-dark justify-content-center'>
                        <div class='container-fluid'>
                        <ul class='navbar-nav'>
                            <li class='nav-item'>
                                <a class='nav-link' href='index.php'>Home</a>
                            </li>            
                            <li class='nav-item'>
                                <a class='nav-link' href='search.php'>Search</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='my-profile.php'>My Profile</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='watchlist.php'>Watchlist</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='logout.php'>Log Out ({$_SESSION['username']})</a>
                            </li>
                    </ul>
                </div>
            </nav>
                ";

            }

    }
    else
    {
        $navigation = 
        "
        <body>
        <nav class='navbar navbar-expand-sm bg-dark justify-content-center'>
            <div class='container-fluid'>
                <ul class='navbar-nav'>
                    <li class='nav-item'>
                        <a class='nav-link' href='index.php'>Home</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link' href='search.php'>Search</a>
                   </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='signup.php'>Sign Up</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='login.php'>Log In</a>
                    </li>
                </ul>
            </div>
        </nav>
        ";

    }
    echo $navigation;

?>