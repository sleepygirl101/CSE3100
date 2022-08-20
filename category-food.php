<?php include('segment_frontend/menu.php'); ?>  

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        $sql = "SELECT category_name FROM category WHERE category_id = $category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_name = $row['category_name'];

    }
    else
    {
        header('location:'.HOME_URL);
    }
?>

     <!--food-search start  -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_name?></a></h2>

        </div>
    </section>
    <!--food-search end  -->


    <!--food-menu start  -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore foods</h2>

            <?php
                $sql2 = "SELECT * FROM food WHERE category_id = $category_id";
                $res2 = mysqli_query($conn, $sql2);
                $row_count2 = mysqli_num_rows($res2);

                if($row_count2 > 0)
                {
                    while($rows = mysqli_fetch_assoc($res2))
                    {
                        $food_id = $rows['food_id'];
                        $title = $rows['food_title'];
                        $price = $rows['price'];
                        $description = $rows['description'];
                        $image_name = $rows['img_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php 
                                    if($image_name=="")
                                    {
                                       echo "image not available"; 
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo HOME_URL; ?>images/food/<?php echo $image_name; ?>" alt="Burger" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>
                                
                            </div>
                            <div class="food-menu-desc">
                                <h2><?php echo $title ?></h2>
                                <p class="food-price">BDT <?php echo $price; ?></p>
                                <p class="food-details">
                                    <?php echo $description; ?>
                                </p><br>
                                <a href="<?php echo HOME_URL?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        

                        <?php
                    }
                }
                else
                {
                    echo "food not available";
                }
            ?>
            <div class="clearfix"></div>           
        </div> 
        <p class="see-all text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!--food-menu end  -->

    <?php include('segment_frontend/footer.php'); ?>   