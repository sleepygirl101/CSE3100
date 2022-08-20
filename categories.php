<?php include('segment_frontend/menu.php'); ?>
<style>
    .categories
    {
        background-color: rgb(187, 180, 171);
    }
</style>



    <!--categories start  -->
    <section class="categories">
        <div class="container">


            <h2 class="text-center">Categories</h2>
            <?php 
                $sql = "SELECT * FROM category WHERE active_category='Yes'";
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


    <?php include('segment_frontend/footer.php'); ?>   >