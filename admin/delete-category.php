<?php
    include('../config/const.php');
     

     if(isset($_GET['category_id']) AND isset($_GET['image_name']))
     {
        $category_id = $_GET['category_id'];
        $image_name = $_GET['image_name'];

        if($image_name != '')
        {
            $path = "../images/category/".$image_name;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "failed to remove category image from folder";
                header('location: '.HOME_URL.'admin/category-manage.php');
                die();
            }
        }
            
                $sql = "DELETE FROM category WHERE category_id = '$category_id'";
     
                $res = mysqli_query($conn,$sql);

                if($res == TRUE)
                {
                    $_SESSION['delete'] = "Category deleted succesfully";
                    header('location: '.HOME_URL.'admin/category-manage.php');
                }
                else
                {
                    $_SESSION['delete'] = "Failed to delete category.";
                    header('location: '.HOME_URL.'admin/category-manage.php');
                }
           
     }
     else
        {
            header('location: '.HOME_URL.'admin/category-manage.php');

        }
?>