<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="<?php echo SITEURL; ?>admin/add-food.php" method="POST" enctype="multipart/form-data">

        <table class="tbl-int">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the Food">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Menu: </td>
                <td>
                    <select name="menu_id">
                        <?php
                        // Create PHP Code to display categories from the database
                        // 1. Create SQL to get all active categories from the database
                        $sql = "SELECT * FROM menu WHERE active='Yes'";
                        // Execute the query
                        $res = mysqli_query($conn, $sql);
                        // Count rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        // If count is greater than zero, we have categories; else we do not have categories
                        if($count > 0)
                        {
                            // We have categories
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // Get the details of categories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            // We do not have categories
                            ?>
                            <option value="0">No Menu Found</option>
                            <?php
                        }

                        // 2. Display on dropdown
                        ?>
                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-primary">
                </td>
            </tr>
        </table>

        </form>

        <?php
        // Check whether the Add Food Button is Clicked or not
        if(isset($_POST['submit']))
        {
            // Add the Food in the Database
            // 1. Get the Data from the Form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $menu_id = $_POST['menu_id'];

            // Check whether the radio button for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                // Get the value from form
                $featured = $_POST['featured'];
            }
            else
            {
                // Set the default value
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            // 2. Upload the Image if selected
            // Check whether the image is selected or not
            if(isset($_FILES['image']['name']))
            {
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // Check whether the image is selected or not and set the value for image_name accordingly
                if($image_name != "")
                {
                    // Image is selected
                    // A. Rename the image
                    // Get the extension of the selected image (jpg, jpeg, png, etc.)
                    $ext = end(explode('.', $image_name));

                    // Create a new name for the image
                    $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;

                    // B. Upload the image
                    // Get the source path and destination path
                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image to be uploaded
                    $dst = "../images/food/".$image_name;

                    // Finally upload the food image
                    $upload = move_uploaded_file($src, $dst);

                    // Check whether the image is uploaded or not
                    if($upload == false)
                    {
                        // Failed to upload the image
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        // Redirect to Add Food Page
                        header('location:'.SITEURL.'admin/add-food.php');
                        // Stop the process
                        die();
                    }
                }
            }
            else
            {
                // Don't upload the image and set the image_name value as blank
                $image_name = "";
            }

            // 3. Insert into Database
            // Create an SQL Query to Save or Add Food
            $sql2 = "INSERT INTO food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                menu_id = $menu_id,
                featured = '$featured',
                active = '$active'
            ";

            // Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            // 4. Redirect to Manage Food with a message
            // Check whether the query is executed or not
            if($res2 == true)
            {
                // Query Executed and Food Added
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                // Failed to Add Food
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
