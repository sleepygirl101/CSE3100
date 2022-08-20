<?php include("segments/menu.php");?>

<?php
        if(isset($_GET['food_id']))
            {
                $food_id = $_GET['food_id'];
                $sql = "SELECT * FROM food WHERE food_id = $food_id";
                $res = mysqli_query($conn, $sql);
                $row_count = mysqli_num_rows($res);

                if($row_count == 1)
                {
                    
                    $row = mysqli_fetch_assoc($res);

                    $food_title = $row['food_title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['img_name'];
                    $current_category = $row['category_id'];
                    $featured_category = $row['featured_category'];
                    $active_category = $row['active_category'];
                }
                else
                {
                    $_SESSION['no-food-found'] = "food not found";
                    
                    header('location:'.HOME_URL.'admin/food-manage.php');
                }

            }
        else
            {
                    
                header('location:'.HOME_URL.'admin/food-manage.php');
            }
            ?>

<div class="main-content">
    <div class="wrapper">
    <h3>Update food</h3><br><br>

    

    <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Food-title:</td>
                    <td>
                        <input type="text" name='food_title' value="<?php echo $food_title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Food Description:</td>
                    <td>
                        <textarea name="description" id="" cols="25" rows="2" placeholder="<?php echo $description; ?>"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name='price' value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if ($current_image != "")
                                {
                                    ?>
                                    <img src="<?php echo HOME_URL; ?>images/food/<?php echo $current_image;?>" alt="" width="100px">
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
                    <td>New Image:</td>
                    <td>
                        <input type="file" name='image' >
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="">

                            <?php
                                $sql = "SELECT * FROM category where active_category like 'Yes'";

                                $res = mysqli_query($conn, $sql);

                                $row_count = mysqli_num_rows($res);

                                if($row_count > 0)
                                {
                                    //categories found
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_id = $row['category_id'];
                                        $category_name = $row['category_name'];
                                        ?>

                                        <option <?php if($current_category==$category_id){echo "selected";} ?>  value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>

                                        <?php
                                    }

                                }
                                else
                                {
                                    ?>
                                    //dont have categories
                                    <option value="0">None</option>
                                    <?php
                                }
                            ?>

                           
                        </select>
                    </td>
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
                            <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                            <input type="submit" name="submit" value="Update food" class="btn-add">
                        </td>
            </table>
        </form>

        <?php
                if(isset($_POST['submit']))
                {
                    $food_id = $_POST['food_id'];
                    $food_title =$_POST['food_title'];
                    $description =$_POST['description'];
                    $price =$_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured_category = $_POST['featured_category'];
                    $active_category = $_POST['active_category'];

                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        if($image_name != "")
                        {
                            //img available
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;

                            $upload = move_uploaded_file($source_path, $destination_path);

                            if($upload == false)
                            {
                                $_SESSION['upload'] = "Failed to upload image";
                                header('location'.HOME_URL.'admin/food-manage.php');
                                die();
                            }

                            if($current_image!="")
                            {
                                $remove_path = "../images/food/".$current_image;
                                $remove = unlink($remove_path);

                                if($remove==false)
                                {
                                    $_SESSION['remove-failed'] = "Failed to remove current Image.";
                                    header('location:'.HOME_URL.'admin/food-manage.php');
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
            

                    $sql2 = "UPDATE food SET
                        food_title = '$food_title',
                        description = '$description',
                        price = $price,
                        img_name = '$image_name',
                        category_id = '$category',
                        featured_category = '$featured_category',
                        active_category = '$active_category'
                        where food_id = $food_id
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2 == true)
                    {
                        //category updated
                        $_SESSION['update'] = 'Food updated successfully.';
                        header('location: '.HOME_URL.'admin/food-manage.php');

                    }
                    else
                    {
                        //failed to update category
                        $_SESSION['update'] = 'Failed to update food.';
                        header('location: '.HOME_URL.'admin/food-manage.php');

                    }

                }

                
            ?>

    </div>
</div>

<?php include('segments/footer.php') ?>