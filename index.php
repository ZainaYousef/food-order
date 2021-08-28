<?php include('partials-front/menu.php'); ?>


    <!-- food search section starts here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="post">
                <input type="search" name="search" placeholder="Search for food..">
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- food search section ends here-->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
            if(isset($_SESSION['total']))
            {
                echo $_SESSION['total'];
                unset($_SESSION['total']);
            }
        }
    
    ?>


    <!-- categories section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Food</h2>
            <?php 
                //create sql query to display categories from DB
                $sql="SELECT * from tbl_categories WHERE featured='yes' AND active='yes' LIMIT 3";
                $res=mysqli_query($conn,$sql);
                //chech whether category is availabe
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    //categories availabe
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL;?>categories-food.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //check whether img is available
                                    if($image_name=="")
                                    {
                                        //display msg
                                        echo "<div class='error'> Image not Available </div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php  echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php

                                    }
                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }

                }
                else
                {
                    //categories not availabe
                    echo "<div class='error'> Category Not Adeed</div>";
                }
            ?>
            
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories section ends here-->
    
    
    <!-- food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                //get food from DB that are active and featured
                $sql2="SELECT * from tbl_food wHERE featured='yes' AND active='yes' LIMIT 6";
                $res2=mysqli_query($conn,$sql2);
               

                $count= mysqli_num_rows($res2);
                //check whether food availabe or not
                if($count>0)
                {
                    //food availabe
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get data from DB
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $desc=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check whether img availabe or not
                                    if($image_name!="")
                                    {
                                        //img availabe
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="chicken hawain pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='error'> Image Not Availabe</div>";
                                    }
                                ?>
                            
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">$<?php echo $price;?></p>
                                <p class="food-detail">
                                <?php echo $desc;?>
                                </p>
                                <br />
                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <?php
                        
                    }
                }
                else
                {
                    //food not availabe
                    echo "<div class='error'> Food not Availabe</div>";
                }
            ?>

            
           
            
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="<?php SITEURL;?>food.php">View All Food</a>
        </p>

        
        
    </section>
    <!-- food menu section ends here-->

    <?php include('partials-front/footer.php'); ?>