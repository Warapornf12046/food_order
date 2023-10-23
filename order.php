
<?php include('partials-front/menu.php'); ?>

    <?php 
        //check whether food id is set or not
        if(isset($_GET['food_id'])){
            //get the food id and details of the selected food
            $food_id = $_GET['food_id'];
            //get the detail of the selected food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count the rows
            $count = mysqli_num_rows($res);
            //check whether the data is available or not
            if($count == 1){
                //we have data
                //get the data from db
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }else{
                //food not available
                //redirect to home page
                header('location'.SITEURL);
            }
        }else{
            //redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            
            <form action="" method="POST" class="order">  
                
                <fieldset>
                    <legend>Selected Food</legend> 

                    <div class="food-menu-img">
                        <?php 
                        
                            //check whether the image is available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not Available.</div>";
                            }else
                            {
                                //image is available
                                ?>
                                <img src="<?php echo SITEURL; ?>images<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                       

                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                </fieldset>

            </form>

            <?php
            
                //cheack whether submit button is click or not
                if(isset($_POST["submit"]))
                {
                    //get all the detail from the form
                    $food = $_POST["food"];
                    $price = $_POST["price"];
                    $qty = $_POST["qty"];
                    $total = $price * $qty ; //total = price x qty

                    $order_date = date("Y-m-d H:i:sa"); //order date
                    $status = "Ordered"; //Ordered ,on delivery,delivered ,cancelled 

                    $customer_name = $_POST["full-name"];
                    $customer_contact = $_POST["contact"];
                    $customer_email = $_POST["email"];
                    $customer_address = $_POST["address"];

                    //save the order in db
                    //create sql to save the data
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_namer = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address '
                    ";
                    //echo $sql2; die();

                    //execute yhe query 
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether query executed successfully or not
                    if($res2 == true){
                        //query executed and order saved
                        $_SESSION['order'] = "<div class = 'success text-center'>Food Ordered Successfully.</div>";
                        header("location".SITEURL);

                    }else{
                        //Failed to save order
                        $_SESSION["order"] = "<div class = 'error text-center'>Failed to Order food.</div>";
                        header("location".SITEURL);
                    }
                    //video 11 time 40.50 edit file admin name manage-order
                    /*
                    <?php
                        if(isset($_SESSION['update'])){
                            echo $_SESSION['update'];
                            unset$_SESSION['update'];
                        }
                        <br><br>
                    ?>
                    <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
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
                            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //display the latest order at first
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
                                                //ordered,on Delivery,delivered,cancelled
                                                 if($status=="Ordered"){
                                                    echo "<label>$status</label>
                                                 }elseif($status=="On Delivery"){
                                                    echo "<label style ='color: orange';>$status</label>
                                                 }elseif($status=="Delivered"){
                                                    echo "<label style ='color: green';>$status</label>
                                                 }elseif($status=="Cancelled"){
                                                    echo "<label style ='color: red';>$status</label>
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
                    */
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>