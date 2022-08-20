<?php include('segments/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>

        <?php
            $admin_id = $_GET['admin_id'];
        
        ?>

        <form action="" method="POST">
        <table class="tbl-full">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Enter your current password"></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="Enter your new password"></td>
                </tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                <tr>
                    
                <tr>
                    <td colspan="2">
                        <input type="hidden" name='admin_id' value="<?php echo $admin_id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-add">
                        
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
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE admin_id = $admin_id AND password = '$current_password'";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            //usser exists
            $row_count = mysqli_num_rows($res);
            if($row_count == 1)
            {
                if($new_password == $confirm_password)
                {
                    //update
                    $sql2 = "UPDATE admin SET
                    password = $new_password
                    WHERE admin_id = $admin_id";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res == true)
                    {
                        $_SESSION['change_password'] = "Password changed";
                        header('location:'.HOME_URL.'admin/admin-manage.php');
                        
                    }
                    else
                    {
                        $_SESSION['change_password'] = "Failed to change password";
                        header('location:'.HOME_URL.'admin/admin-manage.php');
                    }

                }
                else
                {
                    $_SESSION['Password_not_match'] = "Password did not match";
                    header('location:'.HOME_URL.'admin/admin-manage.php');
                }
            }
            else
            {
                $_SESSION['user_not_found'] = "User not Found";
                header('location:'.HOME_URL.'admin/admin-manage.php');
            }
        }
    }

?>

<?php include('segments/footer.php') ?>