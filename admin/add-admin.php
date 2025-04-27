<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        
        
        <?php
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                };
                ?>

        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>    
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Full Name"></td>
                </tr>

                <tr>    
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>   

                <tr>    
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>

                <tr>    
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>

<?php 

    // 
    if(isset($_POST['submit'])) {
        // 1. Get data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        // 2. SQL query to insert data
        $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name', 
            username = '$username', 
            password = '$password'
        ";
    
        // 3. Execute and check
        $res = mysqli_query($conn, $sql);
    
        if ($res == true) {
            // 4. Success
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            header("location:" . SITEURL . 'admin/mange-admin.php');
        } else {
            // 4. Failed
            $_SESSION['add'] = "Failed to Add Admin";
            header("location:" . SITEURL . 'admin/add-admin.php');
        }
    
        // 5. Close connection
        mysqli_close($conn);
    }

?>