<?php include('segments/menu.php') ?>

        <!-- main content start -->
        <div class="main-content">
            <div class="wrapper">
                <h3>Manage Admin</h3><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user_not_found']))
                    {
                        echo $_SESSION['user_not_found'];
                        unset($_SESSION['user_not_found']);
                    }
                    if(isset($_SESSION['Password_not_match']))
                    {
                        echo $_SESSION['Password_not_match'];
                        unset($_SESSION['Password_not_match']);
                    }
                    if(isset($_SESSION['change_password']))
                    {
                        echo $_SESSION['change_password'];
                        unset($_SESSION['change_password']);
                    }
                ?>
                <br><br>
                
                <a href="add-admin.php" class="btn-add">Add admin</a><br><br>
                
                <table class="tbl-full">
                    <tr>
                        <th>Serial No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>


                <?php
                    $sql = "SELECT * FROM admin";
                    $res = mysqli_query($conn,$sql);

                    if($res == true)
                    {
                        $row_count = mysqli_num_rows($res);
                        $s_num = 1;
                        if($row_count>0)
                        {
                           while($rows= mysqli_fetch_assoc($res))
                           {
                                $admin_id = $rows['admin_id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];
                           ?>

                           <tr>
                                <td><?php echo $s_num++;?></td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                    <a href="<?php echo HOME_URL;?>admin/update-password.php?admin_id=<?php echo $admin_id; ?>" class="btn-add" method='GET'>Change Password</a>
                                    <a href="<?php echo HOME_URL;?>admin/update-admin.php?admin_id=<?php echo $admin_id; ?>" class="btn-update" method='GET'>Update admin</a>
                                    <a href="<?php echo HOME_URL;?>admin/delete-admin.php?admin_id=<?php echo $admin_id; ?>" class="btn-dlt" method='GET'>Delete admin</a>
                                </td>
                            </tr>
                           

                        <?php
                            }
                        }
                        
                        else
                        {
                            //db te tbl e kono data nai

                        }
                    }
                
                ?>
                </table>
            </div>
        </div>
        <!-- main content end -->

<?php include('segments/footer.php') ?>
