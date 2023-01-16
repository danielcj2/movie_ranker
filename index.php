<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/main.js" defer></script>
    <title>Best Movie of All Time</title>
    <link rel="icon" href="img/clapperboard.png">
</head>
<body>    
    <header class="header"><h1 class="text-center">Best Movie of All Time</h1></header>
    <button type="button" class="btn rounded-circle btn-floating btn-lg" onclick="scrollUp()" id="scrollBtn"></button>
    <div class="row justify-content-center container-fluid">
        <section class="section movies-section row col-xl-9">
            <h2 class="leaderboard d-flex align-items-center">Leaderboard</h2>
            <div class="display-movies col">
                <h2>Display #:</h2>
                <div class="dropdown">
                    <button type="button" class="leaderboard-list dropdown-toggle" data-bs-toggle="dropdown" id="dropdownMenu" aria-haspopup="true" aria-expanded="false"></button>
                    <span class="arrow d-block"></span>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <div class="dropdown-item" onclick="changeList($(this))">10</div>
                        <div class="dropdown-item" onclick="changeList($(this))">15</div>
                        <div class="dropdown-item" onclick="changeList($(this))">25</div>
                        <div class="dropdown-item" onclick="changeList($(this))">50</div>
                    </div>
                </div>
            </div>
            <div class="col-md-auto"></div>
            <button type="button" class="btn play-game col-sm-3" data-bs-toggle="modal" data-bs-target="#myModal">Play</button>
            <div id="refresh" class="row">
                <?php
                    //Connection
                    require 'connection.php';
                    if (isset($_COOKIE["cookie"])) 
                        $default =  $_COOKIE["cookie"]; 
                    else 
                        $default = 10;

                    $query = "SELECT * FROM movies ORDER BY movie_wins DESC, games_played ASC, movie_name ASC LIMIT $default";
                    //array
                    $data = mysqli_query($conn, $query);
                    $checkRows = mysqli_num_rows($data);
                    //movie rank
                    $rank = 0;

                    if($checkRows > 0){
                        foreach($data as $row){
                            $rank = $rank + 1;
                            ?>
                                <div class="movie-container d-flex col-xl-4">
                                    <div class="rank text-center align-self-start rounded-circle d-flex align-items-center justify-content-center"><?= $rank; ?></div>
                                    <div class="d-flex flex-column well rounded">
                                        <div class="d-flex flex-row">
                                            <img src="<?= $row['img_dir'] ?>" alt="Movie Img" class="movie-img img-fluid img-responsive">
                                            <div class="extend d-flex flex-column align-items-start">
                                                <h3 class="movie-title mb-auto"><?= $row['movie_name'] ?>  (<?= $row['movie_year'] ?>)</h3>
                                                <h3 class="wins-number">Wins: <?= $row['movie_wins'] ?></h3>
                                                <h3 class="win-rate-header">Win Rate</h3>
                                                <div class="progress">
                                                    <?php 
                                                        if($row['movie_wins'] == 0 || $row['games_played'] == 0){
                                                            $winrate = 0;
                                                        } else {
                                                            $winrate = round(($row['movie_wins'] / $row['games_played']) * 100, 2);
                                                        }
                                                    ?>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $winrate ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h3 class="win-rate-percent"><?= $winrate ?>%<h3>
                                            </div>
                                        </div>
                                        <div class="movie-info-flex d-flex flex-column">
                                            <p class="movie-info"><?= $row['movie_info'] ?></p>
                                            <input class="expand align-self-center rounded text-center" type="checkbox" data-toggle="movie-info">
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </section>
        <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close-modal" data-bs-dismiss="modal"> <!--onclick="$('#myModal').modal('hide'); -->
                            <span class="d-flex align-items-center" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center row">
                        <h3 class="modal-title">Choose Round #</h3>
                        <div class="btn-group-vertical">
                            <input type="radio" class="btn-check" name="radiobtn" id="btnchoice1" value="2" autocomplete="off">
                            <label for="btnchoice1" class="btn round-number-label">Final Two - 1 vs 1</label>
                            <input type="radio" class="btn-check" name="radiobtn" id="btnchoice2" value="4" autocomplete="off">
                            <label for="btnchoice2" class="btn round-number-label">Semifinals - Last 4</label>
                            <input type="radio" class="btn-check" name="radiobtn" id="btnchoice3" value="8" autocomplete="off">
                            <label for="btnchoice3" class="btn round-number-label">Quarterfinals - Last 8</label>
                            <input type="radio" class="btn-check" name="radiobtn" id="btnchoice4" value="16" autocomplete="off" checked>
                            <label for="btnchoice4" class="btn round-number-label">Round of 16</label>
                            <input type="radio" class="btn-check" name="radiobtn" id="btnchoice5" value="32" autocomplete="off">
                            <label for="btnchoice5" class="btn round-number-label">Round of 32</label>
                            <input type="radio" class="btn-check" name="radiobtn" id="btnchoice6" value="64" autocomplete="off">
                            <label for="btnchoice6" class="btn round-number-label">Round of 64</label>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="start-game btn">start</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center">Made by Daniel Cojocea</footer>
</body>
</html>