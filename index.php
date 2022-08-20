<?php include('segment_frontend/menu.php'); ?>


     <!--food-search start  -->
     <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo HOME_URL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for food" required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--food-search end  -->
    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!--categories start  -->
    <section class="categories">
        <div class="container">


            <h2 class="text-center">Categories</h2>
            <?php 
                $sql = "SELECT * FROM category WHERE featured_category='Yes' AND active_category='Yes' limit 3";
                $res = mysqli_query($conn, $sql);
                $row_count = mysqli_num_rows($res);

                if($row_count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $category_id = $row['category_id'];
                        $title = $row['category_name'];
                        $image_name = $row['img_name'];
                        ?>
                        <a href="<?php echo HOME_URL; ?>category-food.php?category_id=<?php echo $category_id; ?>">
                            <div class="box1 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                       echo "image not available"; 
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo HOME_URL; ?>images/category/<?php echo $image_name; ?>" alt="Burger" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>
                                
                                <h2 class="float-text text-white"><?php echo $title; ?></h2>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    echo "category not added";
                }
            ?>

            
            


            <div class="clearfix"></div>
        </div>
    </section>
    <!--categories end  -->

    <!--food-menu start  -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore foods</h2>

            <?php 
                $sql2 = "SELECT * FROM food WHERE featured_category='Yes' AND active_category='Yes' limit 4";
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
            <a href="<?php HOME_URL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!--food-menu end  -->

<?php include('segment_frontend/footer.php'); ?>   