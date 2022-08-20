<?php
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login'] = "Please login first";
        header('location: '.HOME_URL.'admin/login.php');
    }
?>