<?php

include('header.php');

#SQL STUFF

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection) {
  die("Connection failed: " . $mysqli_connection_error);
}

$queryNR = "SELECT title, poster_path, vote_average, release_date, movie_id FROM movies WHERE status='Released' LIMIT 20";
$resultNR = mysqli_query($connection, $queryNR);
$nNR = mysqli_num_rows($resultNR);

echo <<<_END
    <div>
    <h1>New releases</h1>
    </div>
_END;

if ($nNR > 0) {
  echo '<div class="new-releases">';
  echo '<div class="movie-container">';
  while ($rows = mysqli_fetch_assoc($resultNR)) {
    $imageDIR = "https://image.tmdb.org/t/p/original" . "{$rows['poster_path']}";
    //echo posts?
    echo <<<_END
            <div class="movie-box">
                <form action="details.php" method="post">
                    <button type="submit" name="showMovie" value="{$rows['movie_id']}" style="border:none;outline:none;background:none;"><img src="$imageDIR" width="180" height="270" style="border-radius: 5%;"/></button>
                </form>
                <div class="movie-details">
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <p class="vote-avg">{$rows['vote_average']}</p>
                  </div>
                  <div class="title">
                    <p>{$rows['title']}</p>
                  </div>
    _END;
    $date = date_create($rows['release_date']);
    echo "<p>" . date_format($date, "d M Y") . "</p>";
    echo '</div>';
    echo "</div>";
  }
  echo '</div>';
  echo "</div>";
} else {
  echo <<<_END
        <h3>No posts found</h3>
  _END;
}

$queryPP = "SELECT title, poster_path, vote_average, release_date, movie_id FROM movies WHERE vote_average > 7 ORDER BY vote_count DESC LIMIT 20";
$resultPP = mysqli_query($connection, $queryPP);
$nPP = mysqli_num_rows($resultPP);

echo <<<_END
    <div>
    <h1>Popular</h1>
    </div>
_END;

if ($nPP > 0) {
  echo '<div class="new-releases">';
  echo '<div class="movie-container">';
  while ($rows = mysqli_fetch_assoc($resultPP)) {
    $imageDIR = "https://image.tmdb.org/t/p/original" . "{$rows['poster_path']}";
    //echo posts?
    echo <<<_END
            <div class="movie-box">
                <form action="details.php" method="post">
                    <button type="submit" name="showMovie" value="{$rows['movie_id']}" style="border:none;outline:none;background:none;"><img src="$imageDIR" width="180" height="270" style="border-radius: 5%;"/></button>
                </form>
                <div class="movie-details">
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <p class="vote-avg">{$rows['vote_average']}</p>
                  </div>
                  <div class="title">
                    <p>{$rows['title']}</p>
                  </div>
    _END;
    $date = date_create($rows['release_date']);
    echo "<p>" . date_format($date, "d M Y") . "</p>";
    echo '</div>';
    echo "</div>";
  }
  echo '</div>';
  echo '</div>';
} else {
  echo <<<_END
        <h3>No posts found</h3>
  _END;
}

include('footer.php');
echo "</body></html>";
