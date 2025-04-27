<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) {

    // get the id of the admin
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != ""){

        // remove the image
        $path = "../images/category/".$image_name;

        $remove = unlink($path);

        if($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Image</div>";
            header("location:" . SITEURL . 'admin/mange-category.php');
            die();
        }
    }

        // create sql query to delete admin
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //excute query 
        $res = mysqli_query($conn, $sql);

    // check whether the query is executed or not
        if ($res == true) {
            // success
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            header("location:" . SITEURL . 'admin/mange-category.php');
        } else {
            // failed
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
            header("location:" . SITEURL . 'admin/mange-category.php');
        }
    } else {
        header("location:" . SITEURL . 'admin/mange-category.php');
    };  


?>