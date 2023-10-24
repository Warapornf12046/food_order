<?php 

      // session start
      session_start();

      define('SITEURL','http://localhost/FOOD%20ORDER/');
      define('LOCALHOST' ,'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD','12345678');
      define('DB_NAME', 'fooddb');


      $conn = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
      $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

      // mysqli_close($conn);

?>
