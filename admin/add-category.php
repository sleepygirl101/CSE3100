<?php include('segments/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h3>Add Category</h3><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>

        <form action="" method="POST" enctype = "multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td>Category name: </td>
                        <td><input type="text" name="category_name" placeholder="Enter Category"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td><input type="radio" name="featured_category" value="Yes">Yes</td>
                        <td><input type="radio" name="featured_category" value="No">No</td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td><input type="radio" name="active_category" value="Yes">Yes</td>
                        <td><input type="radio" name="active_category" value="No">No</td>
                    </tr>
                        <td>
                            <input type="submit" name="submit" value="Add category" class="btn-add">
                        </td>
                        
                    </tr>
                </table>
            </form>

            <?php
            if(isset($_POST['submit']))
            {
                $category_name = $_POST['category_name'];

                if(isset($_POST['featured_category']))
                {
                    $featured_category = $_POST['featured_category'];
                }
                else
                {
                    $featured_category = 'Yes';
                }

                if(isset($_POST['active_category']))
                {
                    $active_category = $_POST['active_category'];
                }
                else
                {
                    $active_category = 'Yes';
                }


                if(isset($_FILES['image']['name']))
                {
                    //up the img, for this we need img name, src path, destination path
                    $img_name = $_FILES['image']['name'];

                    if($img_name != "")
                    {
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$img_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload == false)
                        {
                            $_SESSION['upload'] = "Failed to upload image";
                            header('location'.HOME_URL.'admin/add-category.php');
                            die();
                        }

                    }
                    
                   
                }
                else
                {
                    //dontt up and set img_name value null
                    $img_name = "";
                }



                $sql = "INSERT INTO category SET
                category_name = '$category_name',
                img_name = '$img_name',
                featured_category = '$featured_category',
                active_category = '$active_category'
                ";

                $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                    $_SESSION['add'] = "Category added";
                    header('location:'.HOME_URL.'admin/category-manage.php');
                }
                else
                {
                    $_SESSION['add'] = "failed to add Category";
                    header('location:'.HOME_URL.'admin/add-category.php');
                }
                
                


            }
            
            ?>
    </div>
</div>
<?php include('segments/footer.php') ?>