<?php include('partials/menu.php'); ?>


    <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Mange Admin</h1>
                <br/>

                <?php
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                };

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                };

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                };

                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                };

                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                };

                if(isset($_SESSION['pwd-change'])){
                    echo $_SESSION['pwd-change'];
                    unset($_SESSION['pwd-change']);
                };

                ?>

                <br/><br/><br/>
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Fullname</th>
                        <th>username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    // Get all Admin from Database
                    $sql = "SELECT * FROM tbl_admin";

                    // Execute Query
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;

                    // Check Query
                    if($res == true) {
                        // Count Rows
                        $count = mysqli_num_rows($res);

                        if($count > 0) {
                            // We have data in database
                            while($row = mysqli_fetch_assoc($res)) {
                                // Get the values from individual columns
                                $id = $row['id'];
                                $full_name = $row['full_name'];
                                $username = $row['username'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $full_name ?></td>
                                    <td><?php echo $username ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            // We don't have data in database
                            echo "<tr><td colspan='5'><div class='error'>Admin Not Added Yet.</div></td></tr>";
                        }
                    }   
                    ?>
                </table>
            </div>
        </div>
    <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>
