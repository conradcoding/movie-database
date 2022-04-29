<?php

    include('header.php');

    $show_ratings_form = false;
    $show_comments_form = false;
    $show_favourites_form = false;
    $add_comments_form = false;
    $show_watchlist_form = false;
    $delete_comments_form = false;

    $username = $_SESSION['username'];

    if (isset($_SESSION['loggedIn']) && ($username != 'admin'))
    {
        $show_comments_form = true;
        $show_ratings_form = true;
        $show_favourites_form = true;
        $add_comments_form = true;
        $show_watchlist_form = true;
    }
    else if (isset($_SESSION['loggedIn']) && ($username == 'admin'))
    {
        $show_comments_form = true;
        $show_ratings_form = true;
        $show_favourites_form = true;
        $add_comments_form = true;
        $delete_comments_form = true;
        $show_watchlist_form = true;
    }
    else
    {
        $show_comments_form = true;
    }

    // If statement to be implemented once index page is completed.
    if (isset($_POST['showMovie']))
    {
        $movie = $_POST['showMovie'];
        //$username = $_SESSION['username'];
        
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // Attempt to connect. Return an error if not.
        if (!$connection)
        {
            die("Connection failed: " . $mysqli_connect_error);
        }

        $query = "SELECT title, release_date, runtime, tagline,
        overview, poster_path, revenue, vote_average,
        budget, genres, backdrop_path FROM movies WHERE movie_id = $movie";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);  
        
        $query2 = "SELECT cast, crew FROM credits WHERE movie_id = $movie";
        $result2 = mysqli_query($connection, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        
        echo '
        <div class="container">
        <div class="row">
        <div class="col-md-12 text-center">
        <h1 class="display-3">'.$row['title'].'</h1>
        </ul>
        <ul class="list-inline">
            <li class="list-inline-item h4">'.$row['release_date'].'</li>
            <li class="list-inline-item h4">'.$row['runtime'].' Minutes</li>';

            if ($show_ratings_form)
            {
                echo <<<_END
                <li class="list-inline-item h4">
                    <form action="rate_film.php" method="POST">
                        <input type="number" min="0" max="10" name="rating_value">
                        <input type="hidden" name="movie" value='$movie'>
                        <input type="submit" value="Submit Rating">
                    </form>
                </li>
                _END;
            }
            if ($show_favourites_form)
            {
                $check_existing_favourite_query = "SELECT movie_id, username FROM favourite_films WHERE movie_id = '$movie' AND username = '$username'";
                $check_existing_favourite_result = mysqli_query($connection, $check_existing_favourite_query);
                $n = mysqli_num_rows($check_existing_favourite_result);

                if ($n > 0)
                {
                    echo <<<_END
                    <li class="list-inline-item h4">
                        <form action="favourite_film.php" method="POST">
                            <input type="hidden" name="remove_film" value='$movie'>
                            <input type="submit" value="Remove from Favourites">
                        </form>
                    </li>
                    _END;
                }
                else
                {
                    echo <<<_END
                    <li class="list-inline-item h4">
                        <form action="favourite_film.php" method="POST">
                            <input type="hidden" name="favourite_film" value='$movie'>
                            <input type="submit" id="3" value="Add to Favourites">
                        </form>
                    </li>
                    _END;
                }
            }
            if ($show_watchlist_form)
            {
                $check_existing_watchlist_query = "SELECT movie_id, username FROM watchlist WHERE movie_id = '$movie' AND username = '$username'";
                $check_existing_watchlist_result = mysqli_query($connection, $check_existing_watchlist_query);
                $n = mysqli_num_rows($check_existing_watchlist_result);

                if ($n > 0)
                {
                    echo <<<_END
                    <li class="list-inline-item h4">
                        <form action="updatewatchlist.php" method="POST">
                            <input type="hidden" name="removeWatchList" value='$movie'>
                            <input type="submit" value="Remove from Watchlist">
                        </form>
                    </li>
                    _END;
                }
                else
                {
                    echo <<<_END
                    <li class="list-inline-item h4">
                        <form action="updatewatchlist.php" method="POST">
                            <input type="hidden" name="addWatchList" value='$movie'>
                            <input type="submit" id="3" value="Add to Watchlist">
                        </form>
                    </li>
                    _END;
                }
            }
        echo '
        <br>
            <div class="card mb-12">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://image.tmdb.org/t/p/original/'.$row['poster_path'].'" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">'.$row['tagline'].'</h3>
                            <h5 class="card-text">'.$row['overview'].'</h5>
                            <br><br>
                            <h5 class="card-text">Budget: $'.$row['budget'].'</h5>
                            <h5 class="card-text">Revenue: $'.$row['revenue'].'</h5>
                            <h5 class="card-text">'.$row['vote_average'].'/10</h5>
                            <ul class="list-group list-group-flush" style="color: rgb(252, 193, 56)">';

                            $moviegenre_query =  "SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(genres, CONCAT('$[', seq_0_to_100.seq, '].name'))) AS genre_name FROM movies JOIN seq_0_to_100 WHERE movie_id = 100 HAVING genre_name IS NOT NULL";
                            $moviegenre_result = mysqli_query($connection, $moviegenre_query);
                            $find_genres_n = mysqli_num_rows($moviegenre_result);
            
                            //If result...
                            if($find_genres_n > 0) {
            
                                //For each result...
                                foreach($moviegenre_result as $resultList)
                                {
            
                                ?>
                                <div>
                                    <?//Generates a list item for each genre the movie has?>
                                    <li class="list-group-item"><?= $resultList['genre_name']; ?></li>
                                </div>
                                <?php
                                }
            
                            }
                            else {
                                echo "No results!";
                            }
                            echo '

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        ';
        echo'
        </div>
        <br>
        <div class="card md-12">
            <div class="card-body">
                <h5 class="card-title">Cast & Crew Information</h5>
                <h6 class="card-title">Cast Members</h6>';

                $actor_query =  "SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(cast, CONCAT('$[', seq_0_to_100.seq, '].name'))) 
                AS actor_name, JSON_UNQUOTE(JSON_EXTRACT(cast, CONCAT('$[', seq_0_to_100.seq, '].character'))) AS actor_char FROM credits JOIN seq_0_to_100 WHERE movie_id = 100 HAVING actor_name IS NOT NULL";
                $actor_result = mysqli_query($connection, $actor_query);
                $find_actors_n = mysqli_num_rows($actor_result);

                //If result...
                if($find_actors_n > 0) {

                    //For each result...
                    foreach($actor_result as $resultList)
                    {

                    ?>
                    <div>
                        <?//Generates a list item for each actor the movie has?>    
                        <li class="list-group-item"><?= $resultList['actor_char']," - ", $resultList['actor_name']; ?></li>
                    </div>
                    <?php
                    }

                }
                else {
                    echo "No results!";
                }

                ?>
        <?php
        echo'
        <br>
        <h6 class="card-title">Crew Members</h6>';
        
                $crew_query =  "SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(crew, CONCAT('$[', seq_0_to_100.seq, '].job'))) 
                AS crew_job, JSON_UNQUOTE(JSON_EXTRACT(crew, CONCAT('$[', seq_0_to_100.seq, '].name'))) AS crew_name FROM credits JOIN seq_0_to_100 WHERE movie_id = 100 HAVING crew_name IS NOT NULL";
                $crew_result = mysqli_query($connection, $crew_query);
                $find_crew_n = mysqli_num_rows($crew_result);

                //If result...
                if($find_crew_n > 0) {

                    //For each result...
                    foreach($crew_result as $resultList)
                    {

                    ?>
                    <div>
                        <?//Generates a list item for each cast member the movie has?>
                        <li class="list-group-item"><?= $resultList['crew_name']," - ", $resultList['crew_job']; ?></li>
                    </div>
                    <?php
                    }

                }
                else {
                    echo "No results!";
                }

                ?>
        <?php

        
        echo'
            </div>
        </div>';

        if ($show_comments_form)
        {
            $show_comments_query = "SELECT * FROM comments JOIN users USING (username) WHERE movie_id = '$movie'";
            $show_comments_result = mysqli_query($connection, $show_comments_query);
            $n = mysqli_num_rows($show_comments_result);

            if ($add_comments_form)
            {
                echo <<<_END
                    <div class="col-md-12 text-center">
                        <form action="add_comment.php" method="POST">
                        <br>
                            <input type="text" minlength = "1" maxlength = "500" name="comment" placeholder="Enter comment here...">
                            <input type="hidden" name="movie" value='$movie'>
                            <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                        </form>
                    </div>
                _END;
            }

            echo <<<_END
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <br>
                        <div class="card shadow">
                            <div class="card-header text-center">
                                <h1>Comments</h1>
                            </div>
                _END;
                            if($n > 0)
                            {
                                for($i=0; $i<$n; $i++)
                                {
                                    $row = mysqli_fetch_assoc($show_comments_result);
                                    echo <<<_END
                                    <div class="card">
                                        <div class="card-body">
                                            <p>{$row['comment']}</p>
                                            <h5 class='card-title'>Posted by: {$row['username']}</h5>
                                            <h6 class='card-title'>{$row['comment_date']}</h6>
                                    _END;
                                        if($delete_comments_form)
                                        {
                                            echo <<<_END
                                            <form action="delete_comment.php" method="POST">
                                                <input type="hidden" name="movie" value="$movie">
                                                <input type="hidden" name="comment" value="{$row['comment']}">
                                                <button class="btn btn-primary btn-sm">Delete</button>
                                            </form>
                                            _END;
                                        }
                                        echo <<<_END
                                    </div>
                                </div>
                                _END;
                                }
                            }
                            else
                            {
                                echo <<<_END
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class='card-title'>No comments to show!</h5>
                                    </div>
                                </div>
                                _END;
                            }
                            echo <<<_END
                        </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                _END;
        }
    }
   else { echo 'No movie was selected'; }

    include('footer.php');
    echo"</body></html>";

?>