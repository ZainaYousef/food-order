<?php include("partials-front/menu.php"); ?>

<!-- Categories section starts here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Food</h2>
        <?php 
                //create sql query to display categories from DB
                $sql="SELECT * from tbl_categories WHERE  active='yes' ";
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

<?php include("partials-front/footer.php");?>