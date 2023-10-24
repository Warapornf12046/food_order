<?php 
include('../conn/constant.php');

      //1.get to the ID of admin to be delete
      $id = $_GET['id'];


      //2.create SQL QUERY to delete admin
      $sql = "DELETE FROM admin WHERE id= $id";

      //Execute the queryดำเนนิการค้นหา
      $res = mysqli_query($conn, $sql);

      //check query success
      if($res==TRUE)
      {
            //success
            //echo "Admid DElete Success";
            //session diosplay message
            $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
            header('location:'.SITEURL.'admin/menage-admin.php');

      }
      else
      {
            //faild
            //echo "faild Admid Delete Success";
            $_SESSION['delete'] = "<div class='error'>Failed to delete admin ID.</div>";
            header('location:'.SITEURL.'admin/menage-admin.php');
      }


      //REdirect to manage-admin page with message

?>