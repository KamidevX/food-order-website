<?php include('partials-font/menu.php')?>

<?php
// cehcek whether good id is set or not 
if(isset($_GET['food_id']))
    {
        // get the food id and details
        $food_id = $_GET['food_id'];

        //get the deatails of selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // count the rows
        $count = mysqli_num_rows($res);

        // check whether the data is avavialble or not
        if($count=='1')
            {
                // we have data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
              {
                // food not available redierct to homepage
                header('location:'.SITEURL);
              }  
    }
    else
      {
        // redierct to homepage
          header('location:'.SITEURL);
      }  



?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                    <?php
                    
                     // check whether the iamge is available or not
                     if($image_name=="")
                        {
                            // image not avaiable
                            echo "<div class='error'> Image is not avaiable.</div>";
                        }
                         else
                          {
                        // image is availble
                          ?>
                           <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                       
                           <?php

                          } 
                    ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Kamran Ali" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0348xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. kamransamejo4455@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

           <?php

// check whether submit button is clicked or not
if (isset($_POST['submit'])) {

    $food  = $_POST['food'] ?? '';
    $price = $_POST['price'] ?? 0;
    $qty   = $_POST['qty'] ?? 1;

    // total = price * qty 
    $total = $price * $qty;

    $order_date = date("Y-m-d H:i:s");

    $status = "ordered"; // ordered / on delivery / delivered / canceled

    $customer_name    = $_POST['full-name'] ?? '';
    $customer_contact = $_POST['contact'] ?? '';
    $customer_email   = $_POST['email'] ?? '';
    $customer_address = $_POST['address'] ?? '';

    // create SQL to save data
    $sql2 = "INSERT INTO tbl_order SET 
        food =  '$food',
        price = $price,
        qty = $qty,
        total = $total,
        order_date = '$order_date',
        
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
    ";

    // execute the query
    $res2 = mysqli_query($conn, $sql2);

    // check whether query executed successfully
    if ($res2 == true) {
        $_SESSION['order'] = "<div class='success'>Food Ordered successfully.</div>";
        header('location:' . SITEURL);
    } else {
        $_SESSION['order'] = "<div class='error'>Failed to order.</div>";
        header('location:' . SITEURL);
    }

}
?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-font/footer.php')?>