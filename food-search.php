

<?php include("partials-front/menu.php"); ?>
<!-- Food Search section starts here -->
<section class="food-search text-center">
    <div class="container">
        <?php 
            //get the search keyword
            $search=mysqli_real_escape_string($conn,$_POST['search']);

        ?>
        <h2>Food On Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>
    </div>
</section>
<!-- Food Search section ends here -->

<!-- food menu seaction starts here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        

        //sql query to get the food based on search keyword

        $sql="SELECT * from tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
        //execute the query
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                //get the details
                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $desc=$row['description'];
                $image_name=$row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //check if image is availabe
                        if($image_name=="")
                        {
                            //image not availabe
                            echo "<div class='error'> Image not Availabe </div>";

                        }
                        else
                        {
                            //img availabe
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

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>


                <?php
            }
            

        }
        else
        {
            //empty search result
            echo "<div class='error'> No Search Result.</div>";
        }
        
        ?>

        

        
        <div class="clearfix"></div>

    </div>
</section>
<!-- Food Menu section ends here -->
<?php include("partials-front/footer.php");?>