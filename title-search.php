<!DOCTYPE html>
<html>

<?php
    //Include header
    require_once "header.php";
?>

<br>
<form action="index.php" style="padding-left: 2%">
    <button class="btn btn-primary btn-sm">Return to previous page</button>
</form>

<?php if (isset($_POST['movietitle'])){
        $movie_title = $_POST['movietitle'];
} ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
        <form action="" method="GET">
                <div class="card shadow mt-3">
                    <div class="card-header">
                        <h3>Filter Data</h3>
                    </div>
                        <?//Create input for actor name ?>
                        <div class="card-body">
                            <h6>Movie Title</h6>
                            <hr>
                            <div>
                                <h9>(e.g Superman)</h9>
                                <input type="text" name="movie_title" value="<?php if(isset($_GET['movie_title'])){ echo $_GET['movie_title']; } ?>" >
                                <br>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="search" class="btn btn-primary btn-sm float-end">Search</button>
                        </div>
                </div>
            </form>
                <br>
            </div>

            <?//Create area to display results?>
            <div class="col-md-9 mt-3">
                <div class="card">
                    <div class="card-body row">
                        <h3>Results</h3>
                        <hr>
                        <?php

                            if(isset($movie_title))
                            {
                                filter_data();
                            }

                            //If user clicks Search...
                            if(isset($_GET['search']))
                            {
                                //Run this function
                                filter_data();
                            }

                            //Function that filters the data stored in database
                            function filter_data()
                            {
                                //Set connection
                                $conn = mysqli_connect("localhost", "root", "", "rbb");

                                //If actor name input is set, set the variables used in this function
                                if(isset($_GET['movie_title']) && $_GET['movie_title'] !='') {
                                    $movie_title = $_GET['movie_title'];
                                }
                                else {
                                    $movie_title = $_POST['movietitle'];
                                }

                                $query = "SELECT * FROM movies WHERE title LIKE '%$movie_title%' ORDER BY popularity";
                                $result = mysqli_query($conn, $query);
                                $n = mysqli_num_rows($result);

                                //If result..
                                if($n > 0)
                                {
                                    for($i=0; $i<$n; $i++){
                                        $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="col-md-4 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                <img src="https://image.tmdb.org/t/p/original<?= $row['poster_path']; ?>" class="card-img-top">
                                                <hr>
                                                    <h7 class="card-title">Rating: <?= $row['vote_average']; ?>/10</h7>
                                                    <hr>
                                                    <h5 class="card-title"><?= $row['title']; ?></h5>
                                                    <h7 class="card-title"><?= $row['tagline']; ?></h7>
                                                    <hr>
                                                    <?//Search button posts movie id to another page which displays full details of selected movie ?>
                                                    <form action="details.php" method="POST">
                                                        <button class="btn btn-primary btn-sm" name="showMovie" value="<?=$row['movie_id'];?>">See details</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                else
                                {
                                    echo "<br><br><h2>No results!</h2>";
                                }
                            }
                            ?>
                        </div>
                    ?>
        </div>
    </div>
    <br>
</div>