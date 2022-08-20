<?php include('config/const.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant website</title>
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
     <!--navbar start  -->
     <section class="navbar sticky">
        <div class="container">
            <div class="logo">
                <a href="index.html"><img src="images/logoedit.jpeg" alt="Restaurant logo" class="img-responsive"></a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo HOME_URL; ?>">Home</a></li>
                    <li><a href="<?php echo HOME_URL; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo HOME_URL; ?>foods.php">Food</a></li>
                   <!-- <li><a href="#">Contact</a></li> -->
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
     </section>
    <!-- navbar end  -->

     <style>
        .navbar{
    background-color: bisque;
}
        .categories{

    background-color: bisque ;
}
     </style>