<?php
// Include necessary files and set up the database connection
include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Order</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-int">
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" placeholder="Customer's Name">
                    </td>
                </tr>

                <tr>
                    <td>Total Amount:</td>
                    <td>
                        <input type="number" name="total_amount" placeholder="Total Amount">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Order" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $customer_name = $_POST['customer_name'];
            $total_amount = $_POST['total_amount'];
            $status = $_POST['status'];

            $sql = "INSERT INTO `order` (customer_name, total_amount, status) VALUES ('$customer_name', $total_amount, '$status')";

            $res = mysqli_query($conn, $sql);

            if ($res) {
                $_SESSION['add'] = "<div class='success'>Order Added Successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Order.</div>";
                header('location: ' . SITEURL . 'admin/add-order.php');
            }
        }
        ?>
    </div>
</div>

<?php
// Include the footer
include('partials/footer.php');
?>
