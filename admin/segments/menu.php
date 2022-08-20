<?php
    include('../config/const.php');
    include('segments/login-check.php');

?>


<html>
    <head>
        <title>restaurant-home page</title>
        <link rel="stylesheet" href="../css/admin.css">
        
    </head>

    <body>
        <!-- menu start -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin-manage.php">Admin</a></li>
                    <li><a href="category-manage.php">Category</a></li>
                    <li><a href="food-manage.php">Food</a></li>
                    <li><a href="order-manage.php">Order</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>
        <!-- menu end -->