<?php include('segments/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h3>Add Admin</h3><br>

        <?php
            if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
         ?>

        <form action="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add admin" class="btn-add">
                    </td>
                    
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include('segments/footer.php'); ?>

<?php
    //form theke data niye db te save

    //checking if submit btn is clicked
    if(isset($_POST['submit']))
    {
        //get data from form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']);//md5 diye password encryption


       //sql to save data into db
       $sql= "INSERT INTO admin set
       full_name = '$full_name',
       username =  '$username',
       password = '$password'
       ";

       //query execution and save in db
       //$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
       //$db_select = mysqli_select_db($conn,'food-order') or die(mysqli_error());
       $res = mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn));
       if($res == true)//data inserted
       {
            //create session var to display message
            $_SESSION['add'] = 'Admin added successfully';
            header('location:'.HOME_URL.'admin/admin-manage.php');
       }
       else
       {
            //create session var to display message
            $_SESSION['add'] = 'Failed to add admin';
            header('location:'.HOME_URL.'admin/add-admin.php');
       }
    }

    


?>