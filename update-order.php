<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wraper">
        <h1>Update Order</h1>

        <br><br><br>
   <?php
        if(isset($_GET['id']))
        {
           //get the order detils
           $id = $_GET['id'];

           //get all other details based on this details:
           // SQL query to get all details
           $sql = "SELECT * FROM tbl_order WHERE id=$id";

           //execute the query
           $res = mysqli_query($conn, $sql);

           //count rows
           $count = mysqli_num_rows($res);
           if($count > 0)
            {
                // details are avvailbel
                $row=mysqli_fetch_assoc($res);
                    {
                     $food = $row['food'];
                     $price= $row['price'];
                     $qty  = $row['qty'];
                     $customer_name = $row['customer_name'];
                     $customer_contact = $row['customer_contact'];
                     $customer_email    = $row['customer_email'];
                     $customer_address = $row['customer_address'];

                    }
            } 
            else
              {
                // details are not avavilbel
                // redirct to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');

              }  

        }
        else
          {
            //get all order details
            header('location:'.SITEURL.'admin/manage-order.php');

          }  

        ?>
        <form action="" method="post">

     <table class="tbl-30">

     <tr>
        <td>Food menu:</td>
        <td> <b><?php echo $food; ?></b></td>
     </tr>

     <tr>
        <td>Price:</td>
        <td>
          <b> $ <?php echo $price; ?></b>
        </td>
     </tr>

     <tr>
        <td>Qty</td>
        <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
     </tr>

     <tr>
        <td>Customer Name:</td>
        <td>
            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
        </td>
     </tr>

          <tr>
        <td>Customer contact:</td>
        <td>
            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
        </td>
     </tr>

          <tr>
        <td>Customer Email:</td>
        <td>
            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
        </td>
     </tr>

          <tr>
        <td>Customer Address:</td>
        <td>
            <textarea type="text" name="customer_address" value="<?php echo $customer_address; ?>"> </textarea>
        </td>
        </tr>

      
     <tr>
        <td colspan='2'>
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="price" value="<?php echo $price?>">


            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
        </td>
     </tr>
     </table>

        </form>

        <?php
         // check whether the update buttom is clicked or not
         if(isset($_POST['submit']))
            {
                //echo "btn is clicked";
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email   = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                // update the value

                $sql2 = "UPDATE tbl_order SET
                  qty = $qty,
                  total = $total,
                  customer_name = '$customer_name',
                  customer_contact = '$customer_contact',
                  customer_email = '$customer_email',
                 customer_address = '$customer_address'
                    WHERE id = $id
                       ";
                 // execute the query

                 $res2 = mysqli_query($conn, $sql2);

                 // check whether updated or not
                 // and redierct to manage with message
                 if($res2 == true)
                    {
                        // updated succesfull
                        $_SESSION['update'] = "<div class='success'>Order update successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                    else
                      {
                        // failed to update
                        
                        $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
                        header('location:'.SITEURL.'admin/manage-order.php');
                      }  
                 


            }

            
        
        ?>

    </div>

</div>

<?php include("partials/footer.php"); ?>