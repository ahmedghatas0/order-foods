
<?php include('partials/menu.php'); ?>

    <!-- menu for update admin -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <?php
            
            //Get the id of the selected admin
            $id = $_GET['id'];
            
            //Create sql query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res == true){

                // Check whether the query is executed or not
                $count = mysqli_num_rows($res);

                // Check whether we have admin data or not
                if($count == 1){

                    // Get the details
                    //echo "Admin Available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name']; 
                    $username = $row['username'];
                } else {
                    //Redirect to manage admin page
                    header("location:" . SITEURL . 'admin/mange-admin.php');
                }
            }

            ?>

            <br><br>
                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>    
                            <td>Full Name:</td>
                            <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                        </tr>

                        <tr>    
                            <td>Username:</td>
                            <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                        </tr>  

                        <tr>    
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Update Admin" class="btn btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
        </div>
    </div>

    <?php

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){

        // Get the value from form
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create sql query to update admin
        $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',    
            username = '$username'
            WHERE id='$id'
        ";
        // Execute the query    
        $res = mysqli_query($conn, $sql);

        // Check whether the query is executed or not
        if($res == true){
            // Query executed and admin updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            header("location:" . SITEURL . 'admin/mange-admin.php');
        } else {
            // Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            header("location:" . SITEURL . 'admin/mange-admin.php');
        }
    };


    ?>


<?php include('partials/footer.php'); ?>