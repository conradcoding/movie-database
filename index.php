<?php

    include('header.php');

    #SQL STUFF

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connection_error);
    }

    $queryNR = "SELECT title, poster_path, vote_average, release_date, movie_id FROM movies WHERE status='Released' LIMIT 3";
    $resultNR = mysqli_query($connection, $queryNR);
    $nNR = mysqli_num_rows($resultNR);

    echo <<<_END
    <div>
    <h1>New releases</h1>
    </div>
    _END;

    if ($nNR > 0)
    {
        while($rows = mysqli_fetch_assoc($resultNR))
        {
            $imageDIR = "https://image.tmdb.org/t/p/original" . "{$rows['poster_path']}";
            //echo posts?
            echo <<<_END
            <div>
            <form action="details.php" method="post">
                <button type="submit" name="showMovie" value="{$rows['movie_id']}" style="border:none;outline:none;background:none;"><img src="$imageDIR" width="180" height="270" style="border-radius: 5%;"/></button>
            </form>
            <h2>{$rows['vote_average']}</h3>
            <h2>{$rows['title']}</h3>
            <h3>{$rows['release_date']}</h4>
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

    $queryPP = "SELECT title, poster_path, vote_average, release_date, movie_id FROM movies WHERE vote_average > 7 ORDER BY vote_count DESC LIMIT 3";
    $resultPP = mysqli_query($connection, $queryPP);
    $nPP = mysqli_num_rows($resultPP);

    echo <<<_END
    <div>
    <h1>Popular</h1>
    </div>
    _END;

    if ($nPP > 0)
    {
        while($rows = mysqli_fetch_assoc($resultPP))
        {
            $imageDIR = "https://image.tmdb.org/t/p/original" . "{$rows['poster_path']}";
            //echo posts?
            echo <<<_END
            <div>
            <form action="details.php" method="post">
                <button type="submit" name="showMovie" value="{$rows['movie_id']}" style="border:none;outline:none;background:none;"><img src="$imageDIR" width="180" height="270" style="border-radius: 5%;"/></button>
            </form>
            <h2>{$rows['vote_average']}</h3>
            <h2>{$rows['title']}</h3>
            <h3>{$rows['release_date']}</h4>
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