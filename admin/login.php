<?php include('../config/const.php') ?>
<html>
    <head>
        <title>Login-restaurant project</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login']))
                {
                    echo $_SESSION['no-login'];
                    unset($_SESSION['no-login']);
                }
            ?>
            
            <form action="" method="POST">
                <h3>Username: </h3>
                <input type="text" name="username" placeholder="Enter your username">
                <br>
                <h3>Password: </h3>
                <input type="password" name="password" placeholder="Enter your password">
                <br>
                <input type="submit" name="submit" value="Login" class="btn-add">
                    
            </form>

        </div>
    </body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

        $res = mysqli_query($conn, $sql);
        
        $row_count = mysqli_num_rows($res);

        if($row_count==1)
        {
            $_SESSION['login'] = "successfully logged in.";
            $_SESSION['user'] = $username;

            header('location:'.HOME_URL."admin/index.php");
        }
        else
        {
            $_SESSION['login'] = "LOgin Failed. Try again.";
            header('location:'.HOME_URL."admin/login.php");
        }
    }        
?>