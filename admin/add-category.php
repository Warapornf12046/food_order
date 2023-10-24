<?php include('partials/menu.php');?>
<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Category</h1>

        <br /><br/>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>
        <br><br>

        <!-- Add Category Form Starts-->
        <from action = "" method= "POST" entype="multipart/form-data">
        
            <table class = "thl-int" > <!--thl-30 -->
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured"value="YES">Yes
                        <input type="radio" name="featured"value="NO">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active"value="YES">Yes
                        <input type="radio" name="active"value="NO">No

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-second"><!--btn-secondary-->
                    </td>
                </tr>
            </table>

        </from>
        <!-- Add Category Form Ends-->

        <?php
            //Check whelher the Submit Button is Clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked"

                //1. get the value form cayegory form
                $title = $_POST['featured'];
                
                //for raddio input, we need to check whrther the button is selected or not
                if(isset($_POST['featured']))
                {
                    //get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set the Default value
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
                //Check whether the image is selected or not and set the value for image name accoridingly 
                //print_r($_FILES['image']);

                //die();//Break the Code Here

                if(isset($_FILES['image']['name'])) 
                {
                    //Upload the Image
                    //To upload image we need image name, source path and destination path 
                    $image_name = $_FILES['image']['name'];

                    //upload the image only if image is selected
                    if($image_name != "")
                    {
                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1. jpg"
                        $ext = end(explode('.', $image_name));
                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999) . ' . ' .$ext; // e.g. Food_Category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;
                        

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload == false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add Category Page
                            header('location:' .SITEURL. 'admin/add-category.php');
                            //Stop the Process
                            die();
                        }
                    }
                   
                } 
                else
                {
                    //Don't Upload Image and set the image name value as blank
                    $image_name="";
                }
                //2. Create SQL Query to Insent Category into Database
                $sql = "INSERT INTO menu SET
                    title = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                
                
                ";

                //3.eXCUTE THE qUERY AND sAVE IN dATABASE
                $res =mysqli_query($conn, $sql);

                //4.check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Quesry Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL."admin/manage-category.php");
                }
                else
                {
                    //failed to add category
                    $_SESSION['add'] = "<div class='error'>failed to add category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL."admin/add-category.php");
                }
            }    

        ?>


    </div>
</div>

<?php include('partials/footer.php');?>