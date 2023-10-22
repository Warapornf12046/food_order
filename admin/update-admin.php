<!-- เปลี่ยนชื่อadmin -->
<?php include('partials/menu.php')?>

<div class="main-content">
      <div class="wrapper">

      <h1>Update Admin</h1><br><br>

      <?php 
            //1. get ID of select Admin
            $id = $_GET['AdminID'];
            //2.สร้าsqlรับข้อมูล
            $sql = "SELECT * FROM admin WHERE AdminID = $id";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                  $count = mysqli_num_rows($res);
                  if($count==1)
                  {
                        //echo "Admid Uplete Success";
                        $row=mysqli_fetch_assoc($res);

                        $full_name=$row['full_name'];
                        $username = $row['Username'];
                        

                  }
                  else{
                        header('location:'.SITEURL.'admin/menage-admin.php');
                  }

            }
      
      ?>

      <form action="" method="POST">
            <table class=".tbl-int">
                  <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" value="<?php  echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="Username" placeholder="Your Username" value="<?php  echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="AdminID" value="<?php  echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-second">
                    </td>
                </tr>


            </table>


      </form>
      </div>


</div>


<?php include('partials/footer.php')?>

<?php 
      //actionตอนคลิกปุ่มส่ง

      if(isset($_POST['submit']))
      {
            //echo "button clicked";
            $id =$_POST['AdminID']; //name
            $full_name = $_POST['full_name'];
            $username = $_POST['Username'];

            
            $sql = "UPDATE admin SET 
                  full_name = '$full_name',
                  Username = '$username'
                  WHERE AdminID='$id'
            ";

            $res =mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                  //success
                  //echo "Admid DElete Success";
                  //session diosplay message
                  $_SESSION['update'] = "<div class='success'>Admin update successfully.</div>";
                  header('location:'.SITEURL.'admin/menage-admin.php');
      
            }
            else
            {
                  //faild
                  //echo "faild Admid Delete Success";
                  $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
                  header('location:'.SITEURL.'admin/menage-admin.php');
            }
      }



?>
