<?php
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        // get the id of the food
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ""){
    
            // remove the image
            $path = "../images/food/".$image_name;
    
            $remove = unlink($path);
    
            if($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Image</div>";
                header("location:" . SITEURL . 'admin/mange-food.php');
                die();
            }
        }

        // create sql query to delete foood
        $sql = "DELETE FROM tbl_food WHERE id=$id";
    
        //excute query 
        $res = mysqli_query($conn, $sql);
    
        // check whether the query is executed or not
        if ($res == true) {
            // success
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header("location:" . SITEURL . 'admin/mange-food.php');
        } else {
            // failed
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
            header("location:" . SITEURL . 'admin/mange-food.php');
        }
    } else {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header("location:" . SITEURL . 'admin/mange-food.php');
    }

?>