
<?php include('partials-front/menu.php'); ?>

    <!--10  fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL ?>food_search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!--10  fOOD sEARCH Section Ends Here -->


    

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 
            //Display active 9
            $sql = "SELECT * FROM food WHERE active = 'YES'";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count> 0){
                while($row=mysqli_fetch_assoc($res)){
                    $id=$row["foodID"];
                    $title=$row["title"];
                    $description=$row["description"];
                    $price=$row["price"];
                    $image_name="".$row["image_name"];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                              <?php  
                                if($image_name==""){
                                    echo "<div class ='error'>Image not Available. </div>";

                                }else{
                                    ?>
                                  <img src= "<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" atl="Pizza" class ="img-responsive img-curve">
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
                                <a href="<?php echo SITEURL; ?> order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "<div class ='error'>Food not found. </div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!--9 fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php'); ?>