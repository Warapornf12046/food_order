
<?php include('partials/menu.php')?>
<div class="main-content">
      <div class="wrapper">
            <h1>Change Password</h1><br><br>

            <!-- <?php 
                    if (isset($_GET['AdminID'])) 
                    {
                        $id = $_GET['AdminID'];
                    } 
                    

            
            ?> -->

            <form action="" method="POST">
                  <table class=".tbl-int">
                        <tr>
                              <td>Old Passwor:</td>
                              <td>
                                    <input type="password" name="oldpass" placeholder="Old password">

                              </td>
                        </tr>
                        

                        <tr>
                              <td>
                                    New Password:
                              </td>
                              <td><input type="password" name="newpass" placeholder="New Password"></td>
                              


                        </tr>

                        <tr>
                              <td>Confirm Password:</td>
                              <td><input type="password" name="confpass" placeholder="Confirm Password"></td>

                        </tr>

                        <tr>
                              <td colspan="2">
                              <input type="hidden" name="idadmin" value="<?php  echo $id; ?>">  
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
        $id = $_GET['idadmin'];
        $Oldpass = md5($_POST['oldpass']);
        $Newpass = md5($_POST['newpass']);
        $Confpass = md5($_POST['confpass']);

        $sql = "SELECT * FROM admin WHERE AdminID = $id AND Password = '$Oldpass'";
    
        // Debugging: Output the SQL query
        //echo "SQL Query: " . $sql . "<br>";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $count=mysqli_num_rows($res);
            

            if($count==1)
            {
                //echo "USER";
                if($Newpass==$Confpass)
                {
                    //echo"Match";
                    $sql2 = "UPDATE admin  SET
                    Password ='$Newpass' WHERE AdminID=$id
                
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2==TRUE)
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


