<?php 
    require 'connection.php';

    if(isset($_POST['id'])){
        $movie= $_POST['id'];
        $updateGames = "UPDATE movies SET games_played=games_played+1 WHERE id=$movie";
        mysqli_query($conn, $updateGames);
    }

    if(isset($_POST['last'])){
        $winner = $_POST['last'];
        $updateWinner = "UPDATE movies SET movie_wins=movie_wins+1, games_played=games_played+1 WHERE id=$winner";
        mysqli_query($conn, $updateWinner);
    }
?>