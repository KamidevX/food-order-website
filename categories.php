<?php include('partials-font/menu.php')?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            // display all the categories that are active
            // sql query
            $sql = "SELECT * FROM tbl_category WHERE active='yes'";

            //execute the query
            $res = mysqli_query($conn, $sql);

            // count thhe rows
            $count = mysqli_num_rows($res);

            // check whether the row is avavilable or not
            if($count>0)
                {
                    // category is avvailable
                    while($row = mysqli_fetch_assoc($res))
                        {
                         // get the values   
                         $id = $row ['id'];
                         $title = $row['title'];
                         $image_name = $row ['image_name'];

                         ?>
                         
                         <a href="<?php echo SITEURL; ?>category_foods.php? category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                        
                        <?php
                        if($image_name=="")
                            {
                                // image is not available
                              echo "<div class='error'> Image not found.</div>";
                            }
                            else
                             {
                               // image is avaialble
                               ?>
                                <img src="<?php echo SITEURL; ?>admin/images/category/<?php echo $image_name; ?> " alt="Pizza" class="img-responsive img-curve">
                               <?php
                             }   


                        ?>


                       

                        <h3 class="float-text text-white"><?php //echo SITEURL; ?></h3>
                        </div>

                        </a>



                         <?php
                        }
                       

                }
                else
                  {
                    // not avvaolable
                    echo "<div class='error'> Categories not found.</div>";
                  }  


            ?>

            


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-font/footer.php'); ?>