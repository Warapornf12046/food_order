<?php include('partials/menu.php')?>

      <!-- main-content -->
            
      <div class="main-content">
            <div class="wrapper">
                  <h1>MANAGE ORDER</h1>
                   <br><br>
                   <?php
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    ?>
                    <br><br>

                    <table class="tbl-full">
                        <tr>
                            <th></th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Customer Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>

                        <tr>
                            <td>1. </td>
                            <td>Vijay thapa</td>
                            <td>vijaythapa</td>
                            <td>
                                <a href="=" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>

                        <?php 
                            //get all the orders from db
                            $sql = "SELECT * FROM `order` ORDER BY id DESC";//display the latest order at first
                            //execute query
                            $res = mysqli_query($conn,$sql);
                            //count the rows
                            $count = mysqli_num_rows($res);

                            $sn = 1; //create a serial number and set its initail value as 1
                            if($count> 0){
                                //order available
                                while($row=mysqli_fetch_assoc($res)){
                                   //grt all the order detail
                                   $id = $row["id"];
                                   $food = $row["food"];
                                   $price = $row["price"];
                                   $qty = $row["qty"];
                                   $total = $row["total"];
                                   $order_date = $row["order_date"];
                                   $status = $row["status"];
                                   $customer_name =$row["customer_name"];
                                   $customer_contact =$row["customer_contact"];
                                   $customer_email = $row["customer_email"];
                                   $customer_address =$row["customer_address"];
                                   ?>
                                        <tr>
                                            <td><?php echo $sn++; ?>.</td>
                                            <td><?php echo $food; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php echo $qty; ?> </td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $order_date; ?></td>

                                            <td>
                                            <?php
                                            //ordered, on Delivery, delivered, cancelled
                                            if ($status == "Ordered") {
                                                echo "<label>$status</label>";
                                            } elseif ($status == "On Delivery") {
                                                echo "<label style='color: orange;'>$status</label>";
                                            } elseif ($status == "Delivered") {
                                                echo "<label style='color: green;'>$status</label>";
                                            } elseif ($status == "Cancelled") {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                            ?>

                                            </td>

                                            <td><?php echo $customer_name; ?></td>
                                            <td><?php echo $customer_contact ?> </td>
                                            <td><?php echo $customer_email ?></td>
                                            <td><?php echo $customer_address ?> </td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?> " class="btn-secondary">Update Order</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                //order not available
                                echo "<tr><td colspan='12' class='error'>Order not Available</td></tr>";
                            }
                        ?>
                    </table>
                  
            </div>

      </div>
      <!-- main-content end -->


<?php include('partials/footer.php')?>