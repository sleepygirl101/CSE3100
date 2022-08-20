<?php

    include('../config/const.php');
    //get the id of admin to be deleted
    $admin_id = $_GET['admin_id'];

    //create sql query to dlt it
    $sql = "DELETE FROM admin WHERE admin_id = $admin_id";

    //query execution
    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['delete'] = "Admin deleted successfully";
        header('location:'.HOME_URL."admin/admin-manage.php");
    }
    else
    {
        $_SESSION['delete'] = "Failed to delete admin";
        header('location:'.HOME_URL."admin/admin-manage.php");
    }

    //redirect to the mng admin page with success/err msg
?>