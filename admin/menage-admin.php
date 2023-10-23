<!-- เรียกไฟล์์php -->
<?php include('partials/menu.php')?>

      <!-- main-content -->
            
      <div class="main-content">
            <div class="wrapper">
                  <h1>MANAGE ADMIN</h1>
                  <br><br>
                  <?php 
                        if(isset($_SESSION['add']))
                        {
                              echo $_SESSION['add']; //display session message
                              unset($_SESSION['add']); //remove sessoin message
                        }

                        if(isset($_SESSION['delete']))
                        {
                              echo $_SESSION['delete']; //display session message
                              unset($_SESSION['delete']); //remove sessoin message
                        }

                        if(isset($_SESSION['update']))
                        {
                              echo $_SESSION['update']; //display session message
                              unset($_SESSION['update']); //remove sessoin message
                        }


                        if(isset($_SESSION['user-not-found']))
                        {
                              echo $_SESSION['user-not-found']; //display session message
                              unset($_SESSION['user-not-found']); //remove sessoin message
                        }

                        
                        if(isset($_SESSION['pdw-not-match']))
                        {
                              echo $_SESSION['pdw-not-match']; //display session message
                              unset($_SESSION['pdw-not-match']); //remove sessoin message
                        }

                        if(isset($_SESSION['change-pwd'])) {
                              echo $_SESSION['change-pwd'];
                              unset($_SESSION['change-pwd']);
                        }

                  ?><br><br>

                  <!-- button to add admin -->
                  <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br><br>
                  
                  <table class="tbl-full">
                        <tr>
                              <th>Number</th>
                              <th>Full Name</th>
                              <th> Username</th>
                              <th>Actions</th>
                              
                        </tr>

                        <?php 
                        //display admin
                        $sql = 'SELECT * FROM admin';
                        //execute the query หา
                        $res = mysqli_query($conn ,$sql);
                        //check whether the qery is execute of not
                        if ($res==TRUE)
                        {
                              // count row to check we have data
                              $count = mysqli_num_rows($res); //function to get all of row
                              $number = 1;

                              //check the num of rows
                              if($count>0)
                              {
                                    //we have data in database
                                    
                                    while($rows =mysqli_fetch_assoc($res))
                                    {
                                          //using while loop get al the dat from DB

                                          //get individaul data
                                          $id =$rows['AdminID'];
                                          $full_name =$rows['full_name'];
                                          $username =$rows['Username'];
                                          

                                          //display value
                                    
                                          ?>
                                          <tr>
                                                <td> <?php echo $number++; ?> </td>
                                                <td> <?php echo $full_name;?></td>
                                                 <td><?php echo $username; ?></td>  
                                                 <td>
                                                      <a href="<?php echo SITEURL; ?>admin/change-pass.php?AdminID=<?php echo $id;?>" class="btn-primary">Change Password </a>
                                                      <a href="<?php echo SITEURL; ?>admin/update-admin.php?AdminID=<?php echo $id;?>" class="btn-second">Update Admin </a>
                                                      <a href="<?php echo SITEURL; ?>admin/delete-admin.php?AdminID=<?php echo $id;?>" class="btn-delete">Delete Admin</a>
                                    
                                    
                                                </td>

                                          </tr>
                                          
                                          <?php 

                                          
                                          

                                    }
                              }
                              else
                              {
                                    //we do not have data
                              }

                        }
                        
                        ?>
                        
                        

                  </table>

            </div>

      </div>
      <!-- main-content end -->


<?php include('partials/footer.php')?>
