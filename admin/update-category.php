<?php include("segments/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h3>Update category</h3>

        <?php
            if(isset($_GET['category_id']))
            {
                $category_id = $_GET['category_id'];
                $sql = "SELECT * FROM category WHERE category_id = $category_id";
                $res = mysqli_query($conn, $sql);
                $row_count = mysqli_num_rows($res);

                if($row_count == 1)
                {
                    
                    $row = mysqli_fetch_assoc($res);

                    $category_name = $row['category_name'];
                    $current_image = $row['img_name'];
                    $featured_category = $row['featured_category'];
                    $active_category = $row['active_category'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "Category not found";
                    
                    header('location:'.HOME_URL.'admin/category-manage.php');
                }

            }
            else
            {
                    
                header('location:'.HOME_URL.'admin/category-manage.php');
            }

            
        

        ?>
        

        <form action="" method="POST" enctype = "multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td>Category name: </td>
                        <td><input type="text" name="category_name" placeholder="Enter Category" value="<?php echo $category_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if ($current_image != "")
                                {
                                    ?>
                                    <img src="<?php echo HOME_URL; ?>images/category/<?php echo $current_image;?>" alt="" width="100px">
                                    <?php
                                }
                                else
                                {
                                    echo "No Images Found";
                                }
                            
                            ?>
                        </td>
                        
                    </tr>
                    <tr>
                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured_category=='Yes'){echo "checked";}?> type="radio" name="featured_category" value="Yes">Yes
                            <input <?php if($featured_category=='No'){echo "checked";}?> type="radio" name="featured_category" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active_category=='Yes'){echo "checked";}?> type="radio" name="active_category" value="Yes">Yes
                            <input <?php if($active_category=='No'){echo "checked";}?> type="radio" name="active_category" value="No">No
                        </td>
                    </tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                            <input type="submit" name="submit" value="Update category" class="btn-add">
                        </td>
                        
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //echo "yippee";
                    $category_id = $_POST['category_id'];
                    $category_name =$_POST['category_name'];
                    $current_image = $_POST['current_image'];
                    $featured_category = $_POST['featured_category'];
                    $active_category = $_POST['active_category'];

                    //img select hoise kina chk
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        if($image_name != "")
                        {
                            //img available
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;

                            $upload = move_uploaded_file($source_path, $destination_path);

                            if($upload == false)
                            {
                                $_SESSION['upload'] = "Failed to upload image";
                                header('location'.HOME_URL.'admin/category-manage.php');
                                die();
                            }

                            if($current_image!="")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);

                                if($remove==false)
                                {
                                    $_SESSION['remove-failed'] = "Failed to remove current Image.";
                                    header('location:'.HOME_URL.'admin/category-manage.php');
                                    die();
                                }
                            }
                        }
                        else{
                            $image_name = $current_image;
                        }
                    }
                    else{
                        $image_name = $current_image;
                    }


                    $sql2 = "UPDATE category SET
                        category_name = '$category_name',
                        img_name = '$image_name',
                        featured_category = '$featured_category',
                        active_category = '$active_category'
                        where category_id = $category_id
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2 == true)
                    {
                        //category updated
                        $_SESSION['update'] = 'category updated successfully.';
                        header('location: '.HOME_URL.'admin/category-manage.php');

                    }
                    else
                    {
                        //failed to update category
                        $_SESSION['update'] = 'Failed to update category.';
                        header('location: '.HOME_URL.'admin/category-manage.php');

                    }

                }
            ?>
    </div>
</div>

<?php include('segments/footer.php') ?>