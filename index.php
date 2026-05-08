
      <?php
include('partials/menu.php');

?>
      <!-- main content section start -->

       <div class="main-content">
         <div class="wraper">
              <h1>DASHBOARD</h1> 

              <br><br>

               <?php
           if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
           
           ?>

           <br><br>




              <div class="col-4">
               <?php
            $sql = "SELECT * FROM tbl_category";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // count the rows
            $count = mysqli_num_rows($res);
               ?>
                 <h1><?php echo $count; ?></h1>
                 <br>
                 Categories
                 </div>

              
              <div class="col-4">

              <?php
            $sql2 = "SELECT * FROM tbl_food";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count the rows
            $count2 = mysqli_num_rows($res2);
               ?>

                 <h1><?php echo $count2?></h1>
                 <br>
                 Foods
              </div>

              
              <div class="col-4">
               <?php
            $sql3 = "SELECT * FROM tbl_order";

            // execute the query
            $res3 = mysqli_query($conn, $sql3);

            // count the rows
            $count3 = mysqli_num_rows($res3);
               ?>
                 <h1><?php echo $count3; ?></h1>
                 <br>
                 Total Order
              </div>

         
              <div class="col-4">
               <?php
                  // create SQL query to generate total revenue
                $sql4 = "SELECT SUM(total) as total FROM tbl_order";

                  // execute the query
                    $res4 = mysqli_query($conn, $sql4);

                     // fetch result as array
                     $row4 = mysqli_fetch_assoc($res4);

                 // get total revenue
                    $total_revenue = $row4['total'];
                    ?>

                 <h1>$<?php echo $total_revenue; ?></h1>
                 <br>
                 Revenue Generted
              </div>
 
              <div class="clearfix">

              </div>

        </div>
      
     </div>
       <!-- main content section end -->

       <?php
       include('partials/footer.php');
       ?>