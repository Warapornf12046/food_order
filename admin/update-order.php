<?php include('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update order</h1>
        <br><br>

        <?php 
        
            //check whether id is set or not
            if(isset($_GET['id'])){
                //get the order detail\
                $id = $_GET['id'];

                //get all other detail is based on this id
                //sql query to get the order details 
                $sql="SELECT * FROM order WHERE id=$id";
                //execute query
                $res = mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                if($count> 1){
                    //detail available
                    $row = mysqli_fetch_assoc($res);

                    $food = $row["food"];
                    $price = $row["price"];
                    $qty = $row["qty"];
                    $status = $row["status"];
                    $customer_name =$row["customer_name"];
                    $customer_contact =$row["customer_contact"];
                    $customer_email = $row["customer_email"];
                    $customer_address =$row["customer_address"];


                }else{
                    //detail not available
                    //redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-order.php');

                }

            }else{
                //redirect to message order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
             

        ?>
        <form action ="" method="POST">
            <table class="tbl-30">
                    <tr>
                        <td>Food Name</td>
                        <td><b> <?php echo $food; ?></b></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><b> <?php echo $price; ?> bath</b></td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status=="On deliver"){echo "selected";} ?>value="On delivery">On Delivery</option>
                                <option <?php if($status=="delivered"){echo "selected";} ?>value="delivered">Delivered</option>
                                <option <?php if($status=="cancelled"){echo "selected";} ?>value="cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Name:</td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer contact:</td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Email:</td>
                        <td>
                            <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="customer_address" col="30" row="5"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td clospan ="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" name="submit" value="Update Order" class=btn-secondary>
                        </td>
                    </tr>
            </table>

            <?php
                //check whether update button is clicked or not
                if(isset($_POST["submit"])){
                    //echo "Clicked"
                    //get all the values from Form
                    $id = $_POST["id"];
                    $price = $_POST["price"];
                    $qty = $_POST["qty"];
                    $status = $_POST["status"];
                    $customer_name =$_POST["customer_name"];
                    $customer_contact =$_POST["customer_contact"];
                    $customer_email =$_POST["customer_email"];
                    $customer_address =$_POST["customer_address"];

                    //update the values
                    $sql2 = "UPDATE tbl_order SET 
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address ='$customer_address'
                        WHERE id=$id
                    ";
                    //execute the query 
                    $res2 = mysqli_query($conn,$sql2);
                    //check whether update or not
                    //and redirect to manage order with message
                    if($res2==true){
                        //updated
                        $_SESSION["update"] = "<div class = 'success'>Order Updated Successfully.</div>";
                        header("location".SITEURL.'admin/manage-order.php');

                    }else{
                        //failed yo update
                        $_SESSION['update'] = "<div class = 'error'>Failed to Update Order.</div>";
                        header("location".SITEURL.'admin/manage-order.php');

                    }
                }

            ?>
        </form>
    </div>
</div>


<?php include('partials-front/footer.php'); ?>