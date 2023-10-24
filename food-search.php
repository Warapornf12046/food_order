<?php include('partial-front/menu.php'); ?>
    
    <!--10  fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        
            <!-- มาจาก13 -->
            <?php 
            //$search  = $_POST['search'];
            $search  = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Food on Your Search <a href="#" class = "text-white">"<?php echo $search; ?>"</a></h2>
            
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here  13จบ -->




    <!-- ค้นหา    fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">เมนูอาหาร</h2>
            <?php 
            //sql คีย์เวิด
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$earch%' or description LIKE '%$search%'";
            $res = mysqli_query($con ,$sql);
            $count = mysqli_num_rows($res);
            if ($count>0)
            {
                while ($row=mysqli_fetch_assoc($rec)){
                    //details
                    $id = $row['id'];
                    $title =$row['title'];
                    $price=$row['price'];
                    $description =$row['description']; // $มีคำอธิบายขึ้นมา 
                    $image_name =$row['mage_name'];
                    ?>
                                <div class="food-menu-box">
                            <div class="food-menu-img">
                              <?php  
                                if($image_name==""){
                                    echo "<div class ='error'>Image not Availble. </div>";

                                }else
                                {    ?>
                                    <img src= "<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" atl="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                              ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php  echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php

                }
            }
            else
            {
                echo" <div class = 'eroor'> Food not found. </div>"; 
            }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--10 fOOD Menu Section Ends Here -->
   
<?php include('partial-font/footer.php');?>
