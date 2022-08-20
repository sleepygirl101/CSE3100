<?php include('segments/menu.php') ?>

        <!-- main content start -->
        <div class="main-content">
            <div class="wrapper">
                <h3>DASHBOARD</h3><br>
                <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <br>
                <div class="col text-center">
                    <?php
                        $sql = "SELECT * FROM category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1><br>
                    Categories
                </div>
                <div class="col text-center">
                    <?php
                        $sql2 = "SELECT * FROM food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1><br>
                    Foods
                </div>
                <div class="col text-center">
                    <?php
                        $sql3 = "SELECT * FROM `order`";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1><br>
                    Orders
                </div>
                <div class="col text-center">
                <?php
                        $sql4 = "SELECT SUM(total) AS Total FROM `order` where status='Delivered'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row = mysqli_fetch_assoc($res4);
                        $revenue = $row['Total'];
                    ?>
                    <h1><?php echo $revenue; ?></h1><br>
                    Revenue
                </div>
                <div class="clearfix"></div>              
            </div>
        </div>
        <!-- main content end -->

<?php include('segments/footer.php') ?>
