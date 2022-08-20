<?php include('segment_frontend/menu.php'); ?> 



<?php
    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];

                $sql2 = "SELECT * FROM food WHERE food_id = $food_id";
                $res2 = mysqli_query($conn, $sql2);
                $row_count2 = mysqli_num_rows($res2);

                if($row_count2 == 1)
                {
                    $rows = mysqli_fetch_assoc($res2);
                    //$food_id = $rows['food_id'];
                    $title = $rows['food_title'];
                    $price = $rows['price'];
                    $image_name = $rows['img_name'];                
                }
                else
                {
                    header('location:'.HOME_URL);
                }
            
    }
    else
    {
        header('location:'.HOME_URL);
    }
?>

     <!--form start  -->
     <section class="food-order">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    
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
                        <h2><?php echo $title; ?></h2>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">BDT <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                                    
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                                    
                    </div>
                  

                    

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    $food_name=$_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['qty'];
                    $total = $price * $quantity;
                    $order_date = date('Y-m-d h:i:sa');
                    $status = 'Ordered';
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql = "INSERT INTO `order` SET
                        food_name = '$food_name',
                        price = $price,
                        quantity = $quantity,
                        total= $total,
                        order_date= '$order_date',
                        status= '$status',
                        customer_name= '$customer_name',
                        customer_contact= '$customer_contact',
                        customer_email= '$customer_email',
                        customer_address= '$customer_address'
                    ";
        
                    $res = mysqli_query($conn, $sql);

                    if($res== true)
                    {
                        $_SESSION['order'] = "<h3><div class='text-center'>Order placed</div></h3>";
                        header('location:'.HOME_URL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='text-center'>Failed to order food</div>";
                        header('location:'.HOME_URL);
                          
                    }
                }
                
            ?>

        </div>
    </section>
     
    <?php include('segment_frontend/footer.php'); ?>   