<?php include("partials-front/menu.php"); ?>

<?php 
    //check whether food id is set
    if(isset($_GET['food_id']))
    {
        //get the food details
        $food_id=$_GET['food_id'];
        $sql="SELECT * FROM tbl_food WHERE id=$food_id ORDER BY id DESC";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //data available
            while($row=mysqli_fetch_assoc($res))
            {
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
            }

        }
        else
        {
            //data not availabe
            header("location:".SITEURL);
        }
    }
    else
    {
        header("location:".SITEURL);
    }
?>
<!-- Food search section starts here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill The Form To Confirm Order.</h2>

        <form action="" class="order" method="post">

        <fieldset>
            <legend>Selected Food</legend>
            <div class="food-menu-img">
                <?php 
                    //check whether img is availabe
                    if($image_name=="")
                    {
                        //img not availabe
                        echo "<div class='error'> Image not Availabe</div>";
                    }
                    else
                    {?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="" class="img-responsive img-curve">
                        <?php

                    }
                ?>
                
            </div>

            <div class="food-menu-desc">
                <h3><?php echo $title;?></h3>
                <input type="hidden" name="food" value="<?php echo $title;?>">
                <input type="hidden" name="price" value="<?php echo $price;?>">
                <p class="food-price">$<?php echo $price; ?></p>

                <div class="order-label">Quantity</div>
                <input type="number" name="qty" class="input-responsive" value="1" required>
            </div>
        </fieldset>
        

        <fieldset>
            <legend>Delivery Details</legend>
            <div class="order-label">Full Name</div>
            <input type="text" name="full-name" placeholder="E.g. Henrry Thapa" class="input-responsive" required>
            <div class="order-label">Phone Number</div>
            <input type="tel" name="contact" placeholder="E.g. 9962xxxxxxxxx" class="input-responsive" required>
            <div class="order-label">Email</div>
            <input type="email" name="email" placeholder="E.g. henryThapa@gmail.com" class="input-responsive" required>
            <div class="order-label">Address</div>
            <textarea name="address" id="" placeholder="E.g. Street, City, Country" rows="10" class="input-responsive" required></textarea>
            <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
        </fieldset>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                //get data from form 
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty; 
                $order_date=date("y.m.d h:i:sa"); //get current date and time
                $status= "Ordered"; //ordered, on dilvery, delivered, cancelled
                $customer_name= $_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $Customer_email=$_POST['email'];
                $customer_address=$_POST['address'];

                //save order in DB
                $sql2="INSERT INTO tbl_order SET 
                food='$food',
                price=$price,
                quantity=$qty,
                total=$total,
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$Customer_email',
                customer_address='$customer_address'";

           

                $res2=mysqli_query($conn,$sql2);
                if($res2==TRUE)
                {
                    $_SESSION['order']="<br /><div class='success text-center'> Order Placed Successfully. </div>";
    
                    header("location:".SITEURL);

                }
                else
                {
                    $_SESSION['order']="<br /><div class='error text-center'> Failed To Place Order, Try Again! </div>";
                    header("location:".SITEURL);

                }
            }
        ?>
        
    </div>
</section>
<!-- Food search section ends here -->
<?php include("partials-front/footer.php"); ?>