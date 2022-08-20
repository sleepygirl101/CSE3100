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

    <!--food-menu start  -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore foods</h2>

            <?php 
                $sql2 = "SELECT * FROM food WHERE active_category='Yes'";
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
        <!--
        <p class="see-all text-center">
            <a href="#">See All Foods</a>
        </p> -->
    </section>
  

    <!--food-menu end  -->

    <?php include('segment_frontend/footer.php'); ?>   