<?php
    include('../config/const.php');
     

     if(isset($_GET['food_id']) and isset($_GET['img_name']))
     {
        $food_id = $_GET['food_id'];
        $food_image = $_GET['img_name'];

        if($food_image != '')
        {
            $path = "../images/food/".$food_image;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "failed to remove food image from folder";
                header('location: '.HOME_URL.'admin/food-manage.php');
                die();
            }
        }
            
                $sql = "DELETE FROM food WHERE food_id = '$food_id'";
     
                $res = mysqli_query($conn,$sql);

                if($res == TRUE)
                {
                    $_SESSION['delete'] = "food item deleted succesfully";
                    header('location: '.HOME_URL.'admin/food-manage.php');
                }
                else
                {
                    $_SESSION['delete'] = "Failed to delete food item.";
                    header('location: '.HOME_URL.'admin/food-manage.php');
                }
           
     }
     else
        {
            header('location: '.HOME_URL.'admin/food-manage.php');

        }
?>