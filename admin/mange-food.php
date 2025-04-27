<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Mange Food</h1>
        <br /><br>


        <a href="<?php echo SITEURL ?>/admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>
        <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    };
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    };
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    };
                    if(isset($_SESSION['unauthorize'])){
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    };
                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    };
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    };



                ?>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>title</th>
                <th>Description</th>
                <th>Price</th>
                <th>image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                    // Get all Admin from Database
                    $sql = "SELECT * FROM tbl_food";

                    // Execute Query
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;

                    // Check Query
                    if($res == true) {
                        // Count Rows
                        $count = mysqli_num_rows($res);

                        // Check whether we have admin data or not
                        if($count > 0) {
                            // We have data in database
                            while($row = mysqli_fetch_assoc($res)) {
                                // Get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category_title = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                if($featured == "Yes") {
                                    $featured = "Yes";
                                } else {
                                    $featured = "No";
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
                                    <td><?php echo $description ?></td>
                                    <td>$<?php echo $price ?></td>
                                    <td>
                                        <?php 
                                        if($image_name != "") {
                                            ?>
                                            <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" width="100px">
                                            <?php
                                            } else {
                                                echo "<div class='error'>Image Not Added</div>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $featured ?></td>
                                        <td><?php echo $active ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>"
                                                class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                    <?php
                            }
                        } else {
                            // We don't have data in database
                            ?>
            <tr>
                <td colspan="8">
                    <div class="error">No Food Added</div>
                </td>
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