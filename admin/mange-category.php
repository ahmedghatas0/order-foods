<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Starts -->
    <div class="main-content">

            <div class="wrapper">
            <h1>Mange Category</h1>

            <br><br>

                <?php
                if(isset($_SESSION['add'])) {
                    echo '<br>' . $_SESSION['add'] . '<br><br>';
                    unset($_SESSION['add']);
                };
                
                if(isset($_SESSION['remove'])) {
                    echo '<br>' . $_SESSION['remove'] . '<br><br>';
                    unset($_SESSION['remove']);
                };
                
                if(isset($_SESSION['delete'])) {
                    echo '<br>' . $_SESSION['delete'] . '<br><br>';
                    unset($_SESSION['delete']);
                };
                
                if(isset($_SESSION['update'])) {
                    echo '<br>' . $_SESSION['update'] . '<br><br>';
                    unset($_SESSION['update']);
                };
                
                if(isset($_SESSION['no-category-found'])) {
                    echo '<br>' . $_SESSION['no-category-found'] . '<br><br>';
                    unset($_SESSION['no-category-found']);
                };
                
                if(isset($_SESSION['upload'])) {
                    echo '<br>' . $_SESSION['upload'] . '<br><br>';
                    unset($_SESSION['upload']);
                };
                
                if(isset($_SESSION['failed-remove'])) {
                    echo '<br>' . $_SESSION['failed-remove'] . '<br><br>';
                    unset($_SESSION['failed-remove']);
                };
                ?>

                <a href="<?php echo SITEURL ?>/admin/add-category.php " class="btn-primary">Add Category</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>title</th>
                        <th>image name</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    // Get all Admin from Database
                    $sql = "SELECT * FROM tbl_category";

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
                                $image_name = $row['image_name'];
                                $title = $row['title'];
                                $fearured = $row['featured'];
                                $active = $row['active'];

                                if($fearured == "Yes") {
                                    $fearured = "Yes";
                                } else {
                                    $fearured = "No";
                                }

                                if($active == "Yes") {
                                    $active = "Yes";
                                } else {
                                    $active = "No";
                                }
                                ?>

                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $title ?></td>

                                    <td>
                                        <?php 
                                        if($image_name != "") {
                                            ?>
                                            <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" width="100px">
                                            <?php
                                        } else {
                                            echo "<div class='error'>Image Not Added</div>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $fearured ?></td>

                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>

                                    </td>
                                </tr>
                                
                                <?php
                            }
                        } else {
                            // We don't have data in database
                            ?>
                            <tr>
                                <td colspan="6"><div class="error">No Category Added</div></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>
