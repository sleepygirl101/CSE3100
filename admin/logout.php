<?php
    include('../config/const.php');
    session_destroy();
    header('location: '.HOME_URL.'admin/login.php')
?>