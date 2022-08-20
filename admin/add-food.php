<?php include('segments/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add food</h3><br><br>
        <?php
        if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Food-title:</td>
                    <td>
                        <input type="text" name='food_title' placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Food Description:</td>
                    <td>
                        <textarea name="description" id="" cols="25" rows="2" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name='price' placeholder="">
                    </td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name='food_image' placeholder="">
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

                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>

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
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name='featured_category' value="Yes">Yes
                        <input type="radio" name='featured_category' value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name='active_category' value="Yes">Yes
                        <input type="radio" name='active_category' value="No">No
                    </td>
                </tr>

                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-add">

                </td>

            </table>


        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $food_title = $_POST['food_title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured_category']))
                {
                    $featured_category = $_POST['featured_category'];
                }
                else
                {
                    $featured_category = 'No';
                }

                if(isset($_POST['active_category']))
                {
                    $active_category = $_POST['active_category'];
                }
                else
                {
                    $active_category = 'No';
                }

                if(isset($_FILES['food_image']['name']))
                {
                    //up the img, for this we need img name, src path, destination path
                    $food_image = $_FILES['food_image']['name'];

                    if($food_image != "")
                    {
                        $source_path = $_FILES['food_image']['tmp_name'];
                        $destination_path = "../images/food/".$food_image;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload == false)
                        {
                            $_SESSION['upload'] = "Failed to upload image";
                            header('location'.HOME_URL.'admin/add-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    //dontt up and set img_name value null
                    $img_name = "";
                }

                $sql2 = "INSERT INTO food SET
                    food_title = '$food_title',
                    description = '$description',
                    price = $price,
                    img_name = '$food_image',
                    category_id = $category,
                    featured_category = '$featured_category',
                    active_category = '$active_category'
                    ";

                $res2 = mysqli_query($conn, $sql2);
                if($res2 == true)
                {
                    $_SESSION['add'] = 'Food added successfully';
                    header('location:'.HOME_URL.'admin/food-manage.php');
                }
                else
                {
                    $_SESSION['add'] = 'Failed to add food';
                    header('location:'.HOME_URL.'admin/food-manage.php');
                }

            }
        ?>
    </div>
</div>


<?php include('segments/footer.php'); ?>