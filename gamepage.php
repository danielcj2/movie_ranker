<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/game.js" defer></script>
    <title>Game On!</title>
    <link rel="icon" href="img/clapperboard.png">
</head>
<body>    
    <header class="header">
        <button class="home col-sm-1 btn">Leaderboard</button>
    </header>
    <h1 class="text-center"><div class="round d-block text-center" id="game-rounds"></div></h1>
    <div class="row justify-content-center container-fluid">
        <?php
            require 'connection.php';
            $query = "SELECT * FROM movies";
            //array
            $result= mysqli_query($conn, $query);
            $movies_array = array(array());
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $movies_array[] = $row;
                }
            }
        ?>
        <section class="section movie-section text-center d-block col-sm-6">
            <div class="movie-title" id="left-movie-title"></div>
            <div class="movie-image-container">
                <!-- <img src="#" id="left-movie" alt="Movie Img" class="game-img img-responsive d-lg-block rounded mx-auto"> -->
                <iframe src="#" id="left-movie"></iframe>
            </div>
            <div class="button-container">
                <button type="button" id="left-button" class="choose-movie btn btn-secondary">CHOOSE</button>
            </div>
        </section>
        <section class="section movie-section text-center align-middle d-block col-sm-6" id="section">
            <div class="movie-title" id="right-movie-title"></div>
            <div class="movie-image-container">
                <!-- <img src="#" id="right-movie" alt="Movie Img" class="game-img img-responsive rounded mx-auto"> -->
                <iframe src="#" id="right-movie"></iframe>
            </div>
            <div class="button-container">
                <button type="button" id="right-button" class="choose-movie btn btn-secondary">CHOOSE</button>
            </div>
        </section>
    </div>
    <footer class="footer text-center">Made by Daniel Cojocea</footer>
    <div class="modal fade" id="game-modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close-modal btn btn-secondary" data-bs-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-title text-center">Winner</h3>
                        <div class="text-center">
                            <img src="#" id="winnerMovie" alt="Movie Img" class="img-responsive rounded mx-auto">
                            <p id="movieSelections"></p>
                            <h4 id="winnerTitle"></h4>
                            <p>was your winner!!</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            const movies = <?php echo json_encode($movies_array); ?>;
        </script>    
</body>
</html>