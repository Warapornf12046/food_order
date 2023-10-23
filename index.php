
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

    <?php 
        if(isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset( $_SESSION['order']);

        }
    ?>

    <!-- หน้า home -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">ตัวอย่างเมนู / เมนูยอดฮิต</h2>

            <?php 
                //create sql query is display categories from database
                $sql = "SELECT * FROM menu WHERE active='Yes' AND featured ='Yes' LIMIT 3";
                //Execute the query
                $res= mysqli_query($conn,$sql);
                //Count rows to check whether the category is available or not 
                $cont = mysqli_num_rows($res);   

                    if($cont> 0){
                        //categories available
                        while($row = mysqli_fetch_array($res))
                        {
                            //get the values like id, title, image_name
                            $id = $row["id"];
                            $title = $title['title'];
                            $image_name = $row['image'];
                            ?>

                            <a href="category-foods.html">
                                <div class="box-3 float-container">
                                    <?php 
                                        //check whether Image is available or not
                                        if($image_name=="")
                                        {
                                            //display message
                                            echo "<div class='error'>Image not Available</div>";
                                        }
                                        else
                                        {
                                            //Image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images <?php echo $image_name; ?>" alt="ข้าวหมูทอด" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                   
                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>
                                

                            <?php
                        }
                    }
                    else
                    {
                        //categories not available
                        echo "<div class = 'error '>category not Added.</div>";
                    }

            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- 9 fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php //อาหาร อิน ดาต้าเบส 
            $sql2="SELECT * FROM food WHERE active ='YES' AND featured ='YES' LIMIT 6";

            $res2= mysqli_query($conn,$sql2);
            $count2=mysqli_num_rows($res2);
            if($count2> 0){
                while ($row=mysqli_fetch_assoc($res2)){
                    $id=$row["foodID"];
                    $title=$row["title"];
                    $price=$row["price"];
                    $description=$row["description"];
                    $image_name="".$row["image_name"];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                        <?php 
                        // เช็คอิมเมด
                            if($image_name==""){
                                echo "<div class ='error'>image not avalable. </div>";

                            }
                            else {
                                ?>
                                <img src= "<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php 
                            }
                                ?>
                                <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                            <div class="food-menu-desc">
                                            <h4><?php echo $title;?></h4>
                                            <p class="food-price"><?php echo $price;?></p>
                                            <p class="food-detail">
                                                <?php echo $description;?>
                                            </p>
                                            <br>
                                            <a href="<?php echo SITEURL; ?> order.html?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                        </div>
                                </div>
                    <?php
                }
            }else{
                //food not available
            }
            ?>
            <div class="clearfix"></div>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- 9  fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>