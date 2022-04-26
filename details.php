<?php

    include('header.php');
    if (isset($_POST['showMovie']))
    {
        // Set the variable $movie (used for SQL queries) equal to POST['showMovie']
        $movie = $_POST['showMovie'];
        
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // Attempt to connect. Return an error if not.
        if (!$connection)
        {
            die("Connection failed: " . $mysqli_connect_error);
        }

        // $movie is the value sent through POST
        $query = "SELECT title, release_date, runtime, tagline,
        overview, poster_path, revenue, vote_average,
        budget, genres, backdrop_path FROM movies WHERE movie_id = $movie";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);  
        
        $query2 = "SELECT cast, crew FROM credits WHERE movie_id = $movie";
        $result2 = mysqli_query($connection, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        
        echo '
        <h1 class="display-3">'.$row['title'].'</h1>
        </ul>
        <ul class="list-inline">
            <li class="list-inline-item h4">'.$row['release_date'].'</li>
            <li class="list-inline-item h4">'.$row['runtime'].' Minutes</li>
        </ul>
        <div class="card col-sm-6 col-md-3 col-lg-3">
            <img src="https://image.tmdb.org/t/p/original/'.$row['poster_path'].'" alt="movie poster" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">'.$row['tagline'].'</p>
                <p class="card-text">'.$row['overview'].'</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Budget: $'.$row['budget'].'</li>
                <li class="list-group-item">Revenue: $'.$row['revenue'].'</li>
                <li class="list-group-item">'.$row['vote_average'].'/10</li>';

                $moviegenre_query =  "SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(genres, CONCAT('$[', seq_0_to_100.seq, '].name'))) AS genre_name FROM movies JOIN seq_0_to_100 WHERE movie_id = $movie HAVING genre_name IS NOT NULL";
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
            
        echo'    </ul>
        </div>
        <br>
        <div class="card col-sm-6 col-md-3 col-lg-3">
            <div class="card-body">
                <h5 class="card-title">Cast & Crew Information</h5>
                <h6 class="card-title">Cast Members</h6>';

                $actor_query =  "SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(cast, CONCAT('$[', seq_0_to_100.seq, '].name'))) 
                AS actor_name, JSON_UNQUOTE(JSON_EXTRACT(cast, CONCAT('$[', seq_0_to_100.seq, '].character'))) AS actor_char FROM credits JOIN seq_0_to_100 WHERE movie_id = $movie HAVING actor_name IS NOT NULL";
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
                AS crew_job, JSON_UNQUOTE(JSON_EXTRACT(crew, CONCAT('$[', seq_0_to_100.seq, '].name'))) AS crew_name FROM credits JOIN seq_0_to_100 WHERE movie_id = $movie HAVING crew_name IS NOT NULL";
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
    


   }
   else { 
       echo 'No movie was selected'; 
   }
    include('footer.php');
    echo"</body></html>";

?>