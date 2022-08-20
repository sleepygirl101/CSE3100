<?php
    //session
    session_start();

    define('HOME_URL', 'http://localhost/restaurant_project/');

//query execution and save in db
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    $db_select = mysqli_select_db($conn,'food-order') or die(mysqli_error());
?>