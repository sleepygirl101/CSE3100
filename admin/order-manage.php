<?php include('segments/menu.php') ?>

<!-- main content start -->
<div class="main-content">
    <div class="wrapper">
        <h3>Manage Category</h3><br> 
        
        <?php
        if(isset($_SESSION['update-order']))
        {
            echo $_SESSION['update-order'];
            unset($_SESSION['update-order']);
        }
        ?><br>
                
                <table class="tbl-full">
                    <tr>
                        <th>Serial No</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM `order` ";
                        $res = mysqli_query($conn, $sql);
                        $row_count = mysqli_num_rows($res);
                        $s_num = 1;
                        if($row_count > 0)
                        {
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                $id = $rows['id'];
                                $food_name=$rows['food_name'];
                                $price = $rows['price'];
                                $quantity = $rows['quantity'];
                                $total = $rows['total'];
                                $order_date = $rows['order_date'];
                                $status = $rows['status'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact = $rows['customer_contact'];
                                $customer_email = $rows['customer_email'];
                                $customer_address = $rows['customer_address'];
                                ?>
                                <tr>
                                    <td><?php echo $s_num++; ?></td>
                                    <td><?php echo $food_name; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo HOME_URL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-update">Update Order</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan=12>Orders not available</td></tr>";
                        }
                    ?>

                    

                    
                </table>
                </div>
</div>
<!-- main content end -->

<?php include('segments/footer.php') ?>