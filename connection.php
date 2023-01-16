<?php
    //Connection to database
    $conn = mysqli_connect("localhost", "root", "", "movies_database");
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>