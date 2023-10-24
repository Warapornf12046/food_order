<?php include('../conn/constant.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
      <div class="login">
            <h1 class="text-center">Login</h1> <br>

            <?php 
                  if(isset($_SESSION['login']))
                  {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                  }


                  if(isset($_SESSION['no-login-message']))
                  {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                  }
            
            ?> <br>
                  <!-- start form -->

            <form action="" method="POST" class="text-center">
                  USERNAME: <br>
                  <input type="text" name="username" placeholder="Enter Username"><br><br>
                  PASSWORD: <br>
                  <input type="password" name="password" placeholder="Enter password">  <br><br>

                  <input type="submit" name="submit" value="login" class="btn-primary"> <br>

            </form>
            <!-- end form -->
            <p class="text-center"> </p>

      </div>
      
</body>
</html>



<?php 
if(isset($_POST['submit']))
{
      // login
      //get data
      $username = $_POST['username'];
      $password = md5($_POST['password']);

      //2.SQL
      $sql = "SELECT * FROM admin WHERE username ='$username' AND password='$password'";

      $res = mysqli_query($conn,$sql);

      //4 count rows
      $count = mysqli_num_rows($res);
      if($count==1)
      {
            //login success
            $_SESSION['login']="<div class='success'>login successfully.</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');

      }
      else
      {
            $_SESSION['login']="<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');

      }

}

?>