<?php

include 'header.php';

if (isset($_SESSION['loggedIn'])) {

    $username = $_SESSION['username'];
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $view_watchlist_query = "SELECT * FROM watchlist WHERE username = '$username'";
    $view_watchlist_result = mysqli_query($connection, $view_watchlist_query);
    $view_watchlist_n = mysqli_num_rows($view_watchlist_result);
    $view_watchlist_row = mysqli_fetch_assoc($view_watchlist_result);  
    
    if ($view_watchlist_n > 0){
        foreach($view_watchlist_result as $resultList)
        {
            $status = $resultList['status'];
            $movie = $resultList['movie_id'];
            $selectmovie_query = "SELECT title, release_date, runtime, poster_path, movie_id FROM movies WHERE movie_id = $movie";
            $selectmovie_result = mysqli_query($connection, $selectmovie_query);
            $selectmovie_row = mysqli_fetch_assoc($selectmovie_result);  
                echo '
                <div class="card" style="width: 18rem;">
                        <img src="https://image.tmdb.org/t/p/original/'.$selectmovie_row['poster_path'].'" class="card-img-top" alt="movie poster">
                        <div class="card-body">
                            <h5 class="card-title">'.$selectmovie_row['title'].'</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">'.$selectmovie_row['release_date'].'</li>
                            <li class="list-group-item">'.$selectmovie_row['runtime'].'</li>
                            <li class="list-group-item">'.$status.'</li>
                        </ul>
                        <div class="card-body">
                            <form action="updatewatchlist.php" method="POST">
                            <input type="hidden" name="removeWatchList" value='.$selectmovie_row['movie_id'].'>
                            <input type="submit" value="Remove from watchlist">
                            </form>
                            ';

                    if ($status == "Planned") {
                        echo '<form action="updatewatchlist.php" method="POST">
                        <input type="hidden" name="setWatched" value='.$selectmovie_row['movie_id'].'>
                        <input type="submit" value="Set as watched">
                        </form>';
                    }  
                        
                echo'</div>
                </div>';

            } 
     } else {
         echo 'no results';
     }

    } 
     else {
    echo 'You are not logged in.';
}
?>