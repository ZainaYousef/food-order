<?php include("partials-front/menu.php");?>
<!-- Food search section starts here -->

<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL;?>food-search.php" method="post">
            <input type="search" name="search" placeholder="Search for food.." required>
            <input type="submit" name="submit" value="search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- food Search section ends here-->

<!-- food menu section starts here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
            //get food from DB that is active
            $sql="SELECT * from tbl_food WHERE active='yes' ";
                $res=mysqli_query($conn,$sql);
                //chech whether category is availabe
                $count=mysqli_num_rows($res);

            //check if food is availabe
            if($count>0)
            {
                //food is availabe
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $desc=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">

                            <?php
                                //check whether img is availabe
                                if($image_name=="")
                                {
                                    //img not availabe
                                    echo "<div class='error'> Image not Availabe</div>";

                                }
                                else
                                {
                                    //img is availabe
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicken Pizza" class="img-responsive img-curve">
                                    <?php

                                }
                            ?>
                            
                        </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $desc;?>
                                </p>
                                <br />

                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                    </div>


                    <?php
                }
            }
            else
            {
                echo "<div class='error'> Food not Availabe</div>";
            }
        
        ?>

       
        <div class="clearfix"></div>

    </div>
</section>
<!-- food menu section ends here -->
<?php include("partials-front/footer.php");?>