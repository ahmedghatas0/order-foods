<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>

            <?php
            
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    header('location: manage-admin.php');
                }
            ?>

            <br><br><br>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password: </td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"> 
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php 
            if(isset($_POST['submit'])){
                // GEt the data from form
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                // check the exsist or not

                // make a sql query
                $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                $res =mysqli_query($conn,$sql);

                if($res == TRUE){

                    $count = mysqli_num_rows($res);

                    if($count == 1){
                        // echo "User Found";
                        if($new_password == $confirm_password)
                        {
                            $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            where id=$id";

                            $res2 = mysqli_query($conn,$sql2);

                            if($res2 == true)
                            {
                                $_SESSION['pwd-change'] = "<div class='success'>Password Changed Successfully</div>";
                                header('location:' . SITEURL . 'admin/mange-admin.php');
                            } else 
                            {
                                $_SESSION['pwd-change'] = "<div class='error'>Faild To Change Password</div>";
                                header('location:' . SITEURL . 'admin/mange-admin.php');
                            }
                        } else 
                        {
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Not Match</div>";
                            header('location:' . SITEURL . 'admin/mange-admin.php');
                        }
                    }else
                    {
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                        header('location:' . SITEURL . 'admin/mange-admin.php');
                    };
                };
            };
?>


<?php include('partials/footer.php'); ?>
