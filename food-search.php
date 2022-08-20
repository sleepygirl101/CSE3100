<?php include('segment_frontend/menu.php'); ?>   

          <!--food-search start  -->
          <section class="food-search text-center">
            <div class="container">
                <!--<form action="food-search.html" method="post">     
                    <input type="search" name="search" placeholder="search for food" required>
                    <input type="submit" name="submit" value="search" class="btn btn-primary">     
                </form> -->
                <?php 
                    $search = $_POST['search'];
                ?>
                <h2>Foods on your search :<?php echo $search; ?></h2>
            </div>
        </section>
        <!--food-search end  -->

        <!--food-menu start  -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore foods</h2>

            <?php 
                $search = $_POST['search'];
                $sql = "SELECT * FROM food WHERE food_title like '%$search%' OR description LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);
                $row_count = mysqli_num_rows($res);

                if($row_count > 0)
                {
                    while($rows = mysqli_fetch_assoc($res))
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
                    echo 'Food not found';
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