<?php include('segments/menu.php') ?>

<!-- main content start -->
<div class="main-content">
    <div class="wrapper">
        <h3>Manage Food</h3><br> 
        <?php
        if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['remove-failed']))
            {
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }
        ?> <br><br>          
    

        <a href="add-food.php" class="btn-add">Add Food</a><br><br>
                
                <table class="tbl-full">
                    <tr>
                        <th>Serial No</th>
                        <th>Food title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM food";

                        $res = mysqli_query($conn, $sql);

                        $row_count = mysqli_num_rows($res);
                        $s_num = 1;

                        if($row_count > 0)
                        {   
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                $food_id = $rows['food_id'];
                                $food_title =$rows['food_title'];
                                $price =$rows['price'];
                                $food_image = $rows['img_name'];
                                $featured_category = $rows['featured_category'];
                                $active_category = $rows['active_category'];

                                ?>
                                <tr>
                                    <td><?php echo $s_num++; ?>. </td>
                                    <td><?php echo $food_title; ?></td>
                                    <td><?php echo $price.' tk'; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($food_image=="")
                                            {
                                                echo "Image not Added";
                                            }
                                            else
                                            {  
                                                ?>
                                                <img src="<?php echo HOME_URL; ?>images/food/<?php echo $food_image; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured_category; ?></td>
                                    <td><?php echo $active_category; ?></td>
                                    <td>
                                        <a href="<?php echo HOME_URL; ?>admin/update-food.php?food_id=<?php echo $food_id; ?>" class="btn-update">Update Food</a>
                                        <a href="<?php echo HOME_URL; ?>admin/delete-food.php?food_id=<?php echo $food_id; ?>&img_name=<?php echo $food_image; ?>" class="btn-dlt">Delete Food</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                            
                        }
                        else
                        {
                            echo 'Food not added yet';
                        }

                       

                       
                    ?>

                    

                    
                </table>
                </div>
</div>
<!-- main content end -->

<?php include('segments/footer.php') ?>