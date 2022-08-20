<?php include("segments/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update admin</h1><br><br>

        <?php
            $admin_id = $_GET['admin_id'];

            $sql = "SELECT * FROM admin WHERE admin_id = $admin_id";
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $row_count = mysqli_num_rows($res);
                if($row_count == 1)
                {
                    
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    
                    header('location:'.HOME_URL.'admin/admin-manage.php');
                }
            }

        ?>

        <form action="" method="POST">
        <table class="tbl-full">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter your username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-add">
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $admin_id = $_POST['admin_id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //sql to update admin
        $sql = "UPDATE admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE admin_id = '$admin_id'";

        //execution
        $res = mysqli_query($conn, $sql);
        if($res == true)
        {
            $_SESSION['update'] = "Admin updated successfully";
            header('location:'.HOME_URL.'admin/admin-manage.php');
        }
        else
        {
            $_SESSION['update'] = "Failed to update admin";
            header('location:'.HOME_URL.'admin/admin-manage.php');
        }
    }
    
?>


<?php include("segments/footer.php"); ?>