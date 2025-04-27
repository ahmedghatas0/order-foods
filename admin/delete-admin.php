<?php

    include('../config/constants.php');

    // get the id of the admin
    $id = $_GET['id'];

    // create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //excute query 
    $res = mysqli_query($conn, $sql);

    // check whether the query is executed or not
    if ($res == true) {
        // success
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        header("location:" . SITEURL . 'admin/mange-admin.php');
    } else {
        // failed
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
        header("location:" . SITEURL . 'admin/mange-admin.php');
    }


?>