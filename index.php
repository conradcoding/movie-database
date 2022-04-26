<?php

    include('header.php');

    #SQL STUFF

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connection_error);
    }

    $query = "SELECT title, poster_path, vote_average, release_date, movie_id FROM movies WHERE status='Released' LIMIT 3";
    $result = mysqli_query($connection, $query);
    $n = mysqli_num_rows($result);

    echo <<<_END
    <div>
    <h2>Newly released</h2>
    </div>
    _END;

    if ($n > 0)
    {
        while($rows = mysqli_fetch_assoc($result))
        {
            $imageDIR = "https://image.tmdb.org/t/p/original" . "{$rows['poster_path']}";
            //echo posts?
            echo <<<_END
            <div class="post-container index-page ">
            <form action="movie_Detail.php" method="post">
                <button type="submit" name="showMovie" value="{$rows['movie_id']}" style="border:none;outline:none;background:none;"><img src="$imageDIR" width="180" height="270" style="border-radius: 5%;"/></button>
            </form>
            <h3>{$rows['vote_average']}</h3>
            <h3>{$rows['title']}</h3>
            <h4>{$rows['release_date']}</h4>
            </div>
            _END;
        }
    }
    else
    {
        echo <<<_END
        <h3>No posts found</h3>
        _END;
    }

    include('footer.php');
    echo"</body></html>";
?>