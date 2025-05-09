<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
            <div class="wrapper">
                <h1>Mange Order</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    };
                ?>


                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    // Get all Admin from Database
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; ;

                    // Execute Query
                    $res = mysqli_query($conn, $sql);

                    // Count Rows
                    $count = mysqli_num_rows($res);

                    // Create Serial Number Variable
                    $sn = 1;

                    // Check whether we have admin data or not
                    if($count > 0) {
                        // We have admin data
                        // Get the values and display
                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                        ?>
                        <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $food ?></td>
                        <td>$<?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td>$<?php echo $total ?></td>
                        <td><?php echo $order_date ?></td>
                        <td>
                            <?php
                                if($status == "Ordered")
                                {
                                    echo "<label>$status</label>";
                                } elseif($status == "On Delivery")
                                {
                                    echo "<label style='color: orange;'>$status</label>";
                                }
                                elseif($status == "Delivered")
                                {
                                    echo "<label style='color: green;'>$status</label>";
                                }
                                elseif($status == "Cancelled")
                                {
                                    echo "<label style='color: red;'>$status</label>";
                                }
                            ?>
                        </td>
                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $customer_contact ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address ?></td>
                        <td>
                            <a href="<?php echo SITEURL ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr>
                    <?php
                        }
                    } 
                    else 
                    {
                        // We do not have admin data
                        // We'll display the message inside table
                        ?>
                        <tr>
                            <td colspan="12"><div class="error">No Orders Available.</div></td>
                        </tr>
                        <?php
                    }
                    ?>


                </table>
            </div>
        </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>
