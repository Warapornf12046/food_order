<?php
// Include the necessary files and setup the database connection
include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ORDERS</h1>
        <br><br>

        <!-- Display a link to Add New Order in add-order.php -->
        <a href="<?php echo SITEURL; ?>admin/add-order.php" class="btn-primary">Add New Order</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            // Fetch and display orders from the database
            $sql = "SELECT * FROM `order`";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $order_id = $row['id'];
                    $customer_name = $row['customer_name'];
                    $total_amount = $row['total_amount'];
                    $status = $row['status'];
                    ?>

                    <tr>
                        <td><?php echo $order_id; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $total_amount; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $order_id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                // No orders found in the database
                ?>
                <tr>
                    <td colspan="5" class="error">No Orders Found</td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>

<?php
// Include the footer
include('partials/footer.php');
?>
