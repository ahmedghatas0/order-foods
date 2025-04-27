<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        
        <?php
            
            //Get the id of the selected admin
            $id = $_GET['id'];
            
            //Create sql query to get the details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

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

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                    //Redirect to manage admin page
                    header("location:" . SITEURL . 'admin/mange-category.php');
                }
            }

            ?>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Cuurent Image:</td>
                    <td>
                        <?php 
                        if($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL ?>images/category/<?php echo $current_image ?>" width="150px">
                            <?php
                        } else {
                            echo "<div class='error'>Image Not Added</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") { echo "checked"; } ?> <?php //echo ($featured == "Yes") ?>  type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            //Check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name'])){

                    //Get the image details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != ""){

                        //Image Available
                        //Upload the New image

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //New Image name may be "Food_Category_657.jpg"

                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/category/" . $image_name;

                        //Finally upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //Check whether the image is uploaded or not
                        if($upload == false){
                            //Failed to Upload
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image</div>";
                            header("location:" . SITEURL . 'admin/mange-category.php');
                            //Stop the Process
                            die();
                        }

                        //Remove the Current Image if available
                        if($current_image != ""){
                            $remove_path = "../images/category/" . $current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove == false){
                                //Failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image</div>";
                                header("location:" . SITEURL . 'admin/mange-category.php');
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                //Update the Database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = '$id'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether the query is executed or not
                if($res2 == true){
                    //Query Executed and Category Updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header("location:" . SITEURL . 'admin/mange-category.php');
                } else {
                    //Failed to Update Category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                    header("location:" . SITEURL . 'admin/mange-category.php');
                }
            }
            ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>