
<?php include('partials/menu.php')?>
<div class="main-content">
      <div class="wrapper">
            <h1>Change Password</h1><br><br>

            <?php 
                if(isset($_GET['id'])) 
                {
                    $id = $_GET['id'];
                } 
            ?>

            

            <form action="" method="POST">
                  <table class=".tbl-int">
                        <tr>
                              <td>Old Passwor:</td>
                              <td>
                                    <input type="password" name="current_password" placeholder="Old password">

                              </td>
                        </tr>
                        

                        <tr>
                              <td>
                                    New Password:
                              </td>
                              <td><input type="password" name="new_password" placeholder="New Password"></td>
                              


                        </tr>

                        <tr>
                              <td>Confirm Password:</td>
                              <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>

                        </tr>

                        <tr>
                              <td colspan="2">
                              <input type="hidden" name="id" value="<?php echo $id;?>">  
                              <input type="submit" name="submit" value="Change Password" class="btn-second">
                              </td>
                        </tr>

                  </table>

            </form>


      </div>
</div>


<?php
    if (isset($_POST['submit'])) 
    {
        $id = $_GET['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE id= $id AND password='$current_password'";
    
        // Debugging: Output the SQL query
        //echo "SQL Query: " . $sql . "<br>";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);
            

            if($count==1)
            {
                //echo "USER";
                if($new_password==$confirm_password)
                {
                    //echo"Match";
                    $sql2 = "UPDATE admin  SET
                    password ='$new_password' 
                    WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn,$sql2);
                    if($res2==true)
                    {
                        $_SESSION['change-pwd']="<div class='success'>Password  Change Successfully.</div>";
                        header('location:'.SITEURL.'admin/menage-admin.php');

                    }
                    else
                    {
                        $_SESSION['change-pwd']="<div class='error'>Failed to Change Password .</div>";
                        header('location:'.SITEURL.'admin/menage-admin.php');
                        
                        
                    }

                }
                else
                {
                    
                    $_SESSION['pdw-not-match']="<div class='error'>Password  did not Match.</div>";
                    header('location:'.SITEURL.'admin/menage-admin.php');


                }

            }
            else
            {
                $_SESSION['user-not-found']="<div class='error'>User not Found.</div>";
                header('location:'.SITEURL.'admin/menage-admin.php');

            }
        }
    }

    
?>

<?php include('partials/footer.php')?>


