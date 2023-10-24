<!-- เรียกไฟล์์php -->
<?php include('partials/menu.php')?>

      <!-- main-content -->
            
      <div class="main-content">
            <div class="wrapper">
                  <h1>MANAGE  FOOD</h1>
                   <br><br>

                   <?php 
                        if(isset($_SESSION['add']))
                        {
                              echo $_SESSION['add'];
                              unset($_SESSION['add']);
                        }
                        if(isset($_SESSION['delete']))
                        {
                              echo $_SESSION['delete'];
                              unset($_SESSION['delete']);
                        }
                        if(isset($_SESSION['upload']))
                        {
                              echo $_SESSION['upload'];
                              unset($_SESSION['upload']);
                        }
                        if(isset($_SESSION['unauthorize']))
                        {
                              echo $_SESSION['unauthorize'];
                              unset($_SESSION['unauthorize']);
                        }
                  ?>

                  <!-- button to add admin -->
                  <a href="<?php echo SITEURL;?>add-food.php" class="btn-primary">Add Food</a><br><br><br>
                  
                  <table class="tbl-full">
                        <tr>
                              <th>S.N.</th>
                              <th>title</th>
                              <th>Price</th>
                              <th>Image</th>
                              <th>featured</th>
                              <th>Active</th>
                              <th>Actions</th>
                              
                        </tr>

                        <?php
                              //Create a SQL Query to Get all the Food
                              $sql = "SELECT * FROM food";

                              //Execute the qUery
                              $res = mysqli_query($conn, $sql);

                              //Count Rows to check whether we have foods or not
                              $count = mysqli_num_rows($res);

                              $sn=1;

                              if($count>0)
                              {
                                    //We have food in Database
                                    //Get the Foods from Database and Display
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                          //get the values from individual columns
                                          $id = $row['id'];
                                          $title = $row['title'];
                                          $price = $row['price'];
                                          $image_name = $row['image_name'];
                                          $featured = $row[ 'featured'];
                                          $active = $row['active'];

                                          ?>
                                                <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo $title; ?></td>
                                                      <td>฿<?php echo $price; ?></td>
                                                      <td>
                                                            <?php 
                                                                  //CHeck whether we have image or not
                                                                  if($image_name == "")
                                                                  {
                                                                        //WE do not have image, DIslpay Error Message
                                                                        echo "<div class='error'>Image not Added .< /div>";
                                                                  }
                                                                  else{
                                                                        //WE Have Image, Display Image
                                                                        ?>
                                                                              <img src=" <?php echo SITEURL; ?>images/food/ <?php echo $image_name; ?>" width="100px">
                                                                        <?php   
                                                                  }
                                                                  
                                                            ?>
                                                      </td>
                                                      <td> <?php echo $featured; ?></td>
                                                      <td><?php echo $active; ?></td>
                                                      <td>
                                                      <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id ?>" class="btn-second ">Update food</a>
                                                      <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name;?>" class="btn-delete">Delete food</a>
                                                      </td>
                                                </tr>
                                          <?php
                                    }
                                    
                                  
                              }
                              else{
                                    //Food not Added in Database
                                    echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
                              }

                              
                        ?>

                  </table>
                  
                  
            </div>

      </div>
      <!-- main-content end -->


<?php include('partials/footer.php')?>