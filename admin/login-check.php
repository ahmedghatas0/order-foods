<?php

if(!$_SESSION['user']){

    $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access Admin Panel</div>";
    header("location:".SITEURL.'admin/login.php');
}

?>