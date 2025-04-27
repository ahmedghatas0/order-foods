<?php
 ob_start();
 include('partials/menu.php');
  ?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['remove-failed'])){
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }

            
            //Get the id of the selected Food
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                //Create sql query to get the details
                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    
                //Execute the query
                $res2 = mysqli_query($conn, $sql2);
    
                $row2 = mysqli_fetch_assoc($res2);

                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_category = $row2['category_id'];
                    $current_image = $row2['image_name'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
            }
            else {
                //Redirect to manage food page
                header("location:" . SITEURL . 'admin/mange-food.php');
            }

            ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="description" value="<?php echo $description; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                                ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ?>" width="100px">
                        <?php
                            } else {
                                echo "<div class='error'>Image Not Added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                //Create PHP code to display categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $current_title = $row['title'];
                                        $current_id = $row['id'];
                                        ?>
                            <option <?php if($current_category == $current_id) { echo "selected"; } ?>
                             value="<?php echo $current_id; ?>"><?php echo $current_title; ?></option>
                            <?php
                                    }
                                } else {
                                        echo "<option value='0'>No Category Found</option>";
                                }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured"
                            value="Yes"> Yes
                        <input <?php if($featured == "No") { echo "checked"; } ?> type="radio" name="featured"
                            value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes">
                        Yes
                        <input <?php if($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No">
                        No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $current_image = $_POST['current_image'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                    $active = isset($_POST['active']) ? $_POST['active'] : "No";
                    echo $category;

                        echo "<pre>";
                        print_r($_POST);
                        echo "</pre>";



                    // Default: keep current image
                    $image_name = $current_image;

                    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
                    {
                        $image_name = $_FILES['image']['name'];
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Name_".rand(000, 999).'.'.$ext;

                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src_path , $dest_path);
                        if($upload == false){
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image</div>";
                            header("location:" . SITEURL . 'admin/update-food.php');
                            die();
                        }

                        if($current_image != "")
                        {
                            $remove_path = "../images/food/".$current_image;
                            if(file_exists($remove_path)) {
                                unlink($remove_path);
                            }
                        }
                    }

                    $sql3 = "UPDATE tbl_food SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";

                    // echo "<pre>$sql3</pre>";


                    $res3 = mysqli_query($conn, $sql3);

                    if($res3 == true)
                    {
                        $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                    }

                    header("location:" . SITEURL . 'admin/mange-food.php');
                }

            ?>
        </form>
    </div>
</div>
<?php ob_end_flush();
 include('partials/footer.php');
 ?>