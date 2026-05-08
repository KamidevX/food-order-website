<?php include('partials-font/menu.php')?>

<?php
 // check whether id is passed or not 
 if(isset($_GET['category_id']))
    {
        // category id is set and get the id
        $category_id = $_GET['category_id'];

        //get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        //get the value from database
        $row = mysqli_fetch_assoc($res);

        //get the title
        $category_title = $row['title'];
    }
    else
      {
        // category not passed
        // redierct to home page
        header('location:'.SITEURL);
      }  

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            // craete sql querry to get food on the bases of selected category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";


            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count the rows
            $count2 = mysqli_num_rows($res2);

            // ceck whether the food is avvailble or not
            if($count2>0)
                {
                    // food is avvailable
                    while($row = mysqli_fetch_assoc($res2))
                        {
                            $title = $row['title'];
                            $price = $row['price'];
                            $description = $row['description'];
                            $image_name =  $row['image_name'];
                            ?>

                           <div class="food-menu-box">
                <div class="food-menu-img">

                   <?php
                   // check whether the image is avvailabel or not
                   if($image_name=="")
                    {
                        // image not avaialble
                        echo "<div class='error'> Image not available.</div?";
                    }
                    else
                     {
                        // image is available
                        ?>
                     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        

                        <?php
                     }   
                   
                   
                   ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div> 

                            <?php


                        }
                }
                else
                  {
                    //food is not elligable
                    echo "<div class='error'> food is not available.</div>";
                  }  
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-font/footer.php')?>