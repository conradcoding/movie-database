<?php

require_once "header.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$username = $_SESSION['username'];

echo <<<_END

        <br><br>
        <div class="container">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1>{$username}'s profile</h1>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Ratings</h3>
                        <hr>
    _END;
                $no_films_rated_query = "SELECT COUNT(rating) AS rating_count FROM ratings WHERE username = '$username'";
                $no_films_rated_result = mysqli_query($connection, $no_films_rated_query);
                $no_films_rated_n = mysqli_num_rows($no_films_rated_result);

                if ($no_films_rated_n > 0)
                {
                    $row = mysqli_fetch_assoc($no_films_rated_result);
                    echo "<h5>Films rated: {$row['rating_count']}</h5>";
                }
                else
                {
                    echo "<h5>Films rated: 0</h5>";
                }

                $avg_films_rated_query = "SELECT AVG(rating) AS rating_avg FROM ratings WHERE username = '$username'";
                $avg_films_rated_result = mysqli_query($connection, $avg_films_rated_query);
                $avg_films_rated_n = mysqli_num_rows($avg_films_rated_result);

                if ($avg_films_rated_n > 0)
                {
                    $row = mysqli_fetch_assoc($avg_films_rated_result);
                    echo "<h5>Average rating: ". substr($row['rating_avg'], 0, 4)."</h5><hr>";
                }
                else
                {
                    echo "<h5>Average rating: 0.0</h5><hr>";
                }

                echo "</div>";

                echo "<div class='row'>";

                $find_films_rated_query = "SELECT DISTINCT * FROM movies INNER JOIN ratings USING(movie_id) WHERE ratings.username = '$username'";
                $find_films_rated_result = mysqli_query($connection, $find_films_rated_query);
                $find_films_rated_n = mysqli_num_rows($find_films_rated_result);

                if ($find_films_rated_n > 0)
                {
                    for ($i=0; $i<$find_films_rated_n; $i++)
                    {
                        $row = mysqli_fetch_assoc($find_films_rated_result);

                        echo <<<_END
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="https://image.tmdb.org/t/p/original{$row['poster_path']}" class="card-img-top">
                                                <hr>
                                                <h7 class="card-title">Your Rating: {$row['rating']}</h7>
                                                <hr>
                                                <h5 class="card-title">Your Rating: {$row['title']}</h5>
                                                <hr>
                                                <form action="details.php" method="POST">
                                                    <button class="btn btn-primary btn-sm" name="showMovie" value="{$row['movie_id']}">See details</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            _END;
                    }
                }

                echo <<<_END
                </div>
            </div>
        </div>
    </div>

<br><br><br><br><br>
_END;

require_once "footer.php";


?>