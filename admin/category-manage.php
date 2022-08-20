<?php include('segments/menu.php') ?>

<!-- main content start -->
<div class="main-content">
    <div class="wrapper">
        <h3>Manage Category</h3><br> 
        
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
        
            if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
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
        ?><br><br>


    

        <a href="add-category.php" class="btn-add">Add Category</a><br><br>
                
        <table class="tbl-full">
            <tr>
                <th>Serial No</th>
                <th>Category Name</th>
                <th>Image name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            
            <?php
                $sql = "SELECT * FROM category";

                $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                    $row_count = mysqli_num_rows($res);
                    $s_num=1;
                    if($row_count > 0)
                    {
                        while($rows= mysqli_fetch_assoc($res))
                        {
                            $category_id = $rows['category_id'];
                            $category_name =$rows['category_name'];
                            $image_name = $rows['img_name'];
                            $featured_category = $rows['featured_category'];
                            $active_category = $rows['active_category'];
                        
                        ?>

                        <tr>
                            <td><?php echo $s_num++ ?></td>
                            <td><?php echo $category_name ?></td>

                            <td>
                                <?php
                                    if($image_name!="")
                                    {
                                        ?>
                                        
                                        <img src="<?php echo HOME_URL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                        <?php
                                    }
                                
                                    
                                    else
                                    {
                                        
                                        echo 'no images found';
                                        
                                    }
                                    ?>
                                

                            </td>

                            <td><?php echo $featured_category ?></td>
                            <td><?php echo $active_category ?></td>
                            <td>
                                <a href="<?php echo HOME_URL;?>admin/update-category.php?category_id=<?php echo $category_id; ?>" class="btn-update">Update category</a>
                                <a href="<?php echo HOME_URL;?>admin/delete-category.php?category_id=<?php echo $category_id; ?>&image_name=<?php echo $image_name; ?>" class="btn-dlt">Delete category</a>
                            </td>
                        </tr>
                        <?php
                            
                       
                    
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="6">No Category Added.</td>
                        </tr>
                        
                        //there iis no category
                        <?php
                    }
                }
                ?>
                


            
            
        </table>
    </div>


</div>
<!-- main content end -->


<?php include('segments/footer.php') ?>