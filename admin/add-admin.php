<?php include('partials/menu.php')?>

<div class="main-content"> 
    <div class="wrapper">
        <h1>Add Admin</h1> <br><br>

        <?php 
            if((isset($_SESSION['add'])))
            {
                  echo $_SESSION['add']; //display session message
                  unset($_SESSION['add']); //remove sessoin message
            }
        ?>

        <form action="" method="POST">

            <table class=".tbl-int">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="Username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="Password" id="" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-second">
                    </td>
                </tr>
            </table>



        </form>
    </div>
</div>

<?php include('partials/footer.php')?>

<?php
// include('../conn/connect.php'); // Include connect file with database credentials
// include('../conn/constant.php');

// Process the form and save data to the database
if(isset($_POST['submit']))
{
    // Get data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['Username'];
    $password = md5($_POST['Password']);

    // Create SQL query to insert data into the database
    // Create SQL query to insert data into the 'admin' table
//     $sql = "INSERT INTO admin (full_name, Username, Password) 
//     VALUES ('$full_name', '$username', '$password')";

      $sql = "INSERT INTO admin SET 
            full_name = '$full_name',
            Username = '$username',
            Password = '$password'

        ";


    echo $sql;

    //3.Executing Query and saving data into database 
    $res =mysqli_query($conn, $sql) or die(mysqli_error());


      //4.check ข้อมูลซ้ำ แทรก แสดงข้อความ
      if($res==TRUE)
      {
            // data insert
            // echo "Data inserted";
            // create a session 
            $_SESSION['add'] = "Admin Added Successfully";

            // redirect page to manage admin
            header("location:".SITEURL. 'admin/menage-admin.php');
      }

      else
      {
            // fail to insert data
            // echo "fail to insert data";

            $_SESSION['add'] = " Failed to Admin Added ";

            // redirect page to add admin
            header("location:".SITEURL. 'admin/add-admin.php');
      }
    
}
?>

