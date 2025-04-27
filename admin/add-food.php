<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($SESSION['error'])){
                echo $SESSION['error'];
                unset($SESSION['error']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="description" placeholder="Description of the food"></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                // Create PHP code to display categories from database
                                // 1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // 2. Execute the query
                                $res = mysqli_query($conn, $sql);
                                // 3. Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);
                                // 4. Create loop to get all the data from database
                                if($count > 0) {
                                    // We have categories
                                    while($row = mysqli_fetch_assoc($res)) {
                                        // Get the values like id, title, image_name
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $title ?></option>
                                        <?php
                                    }
                                } else {
                                    // We don't have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php           
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                // 1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No"; // Default Value
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No"; // Default Value
                }

                // 2. Upload the image if selected
                // Check whether the select image is clicked or not
                if(isset($_FILES['image']['name'])) {
                    // Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // Upload the image only if image is selected
                    if($image_name != "") {
                        // A. Rename the image
                        // Get the extension of selected image (jpg, png, gif, etc) eg. food1.jpg
                        $ext = end(explode('.', $image_name));

                        // Rename the image
                        $image_name = "Food_Name_".rand(000, 999).'.'.$ext; // New image name may be "Food_Name_834.jpg"

                        // B. Upload the image
                        // Get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        // Finally upload the image 
                        $upload = move_uploaded_file($src_path, $dest_path);

                            if($upload == false) {
                                // Failed to upload the image
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                                header("location:" . SITEURL . 'admin/add-food.php');
                                die();
                            }
                        }
                    }
                    else 
                    {
                        $image_name = ""; // Set image name as blank
                    }
                    $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether the query executed or not
                    if($res2 == true) {
                        // Query executed and food added
                        $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                        header("location:" . SITEURL . 'admin/mange-food.php');
                    } else {
                        // Failed to add food
                        $_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
                        header("location:" . SITEURL . 'admin/mange-food.php');
                    }
                }
            else {
                
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
