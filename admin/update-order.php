<?php include('segments/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h3>Update Order</h3><br>
        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $sql = "SELECT * FROM `order` WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $row_count = mysqli_num_rows($res);
                if($row_count==1)
                {
                    $rows = mysqli_fetch_assoc($res);

                    $food_name=$rows['food_name'];
                    $price = $rows['price'];
                    $quantity = $rows['quantity'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];

                }
                else
                {
                    header('location:'.HOME_URL.'admin/order-manage.php');
                }

            }
            else
            {
                header('location:'.HOME_URL.'admin/order-manage.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Food name</td>
                    <td><b><?php echo $food_name; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b><?php echo 'BDT '.$price; ?></b></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><b>
                        <input type="number" name="qty" value="<?php echo $quantity; ?>">
                    </b></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if($status=="Ordered"); ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On delivery"); ?> value="On delivery">On delivery</option>
                            <option <?php if($status=="Delivered"); ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"); ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer contact</td>
                    <td>
                        <input type="tel" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" id="" cols="20" rows="2"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update order" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $id=$_POST['id'];
                $price = $_POST['price'];
                $quantity = $_POST['qty'];
                $total = $price * $quantity;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $sql2 = "UPDATE `order` SET
                    
                    quantity = $quantity,
                    total= $total,
                    status= '$status',
                    customer_name= '$customer_name',
                    customer_contact= '$customer_contact',
                    customer_email= '$customer_email',
                    customer_address= '$customer_address'
                    WHERE id=$id
                ";
    
                $res2 = mysqli_query($conn, $sql2);

                if($res2== true)
                {
                    $_SESSION['update-order'] = "<h3><div class='text-center'>Order updated</div></h3>";
                    header('location:'.HOME_URL.'admin/order-manage.php');
                }
                else
                {
                    $_SESSION['update-order'] = "<div class='text-center'>Failed to update order</div>";
                    header('location:'.HOME_URL.'admin/order-manage.php');
                      
                }
            }
            
        
        ?>

    </div>
</div>
<?php include('segments/footer.php') ?>