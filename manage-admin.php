<?php include('partials/menu.php'); ?>




<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wraper">

        <h1>Manage Admin</h1>
          <br> 
          
          <?php
           if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // display session message
                unset($_SESSION['add']); // remove session message
            }
            // delete admin section 
            if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            // update admin 
            if(isset($_SESSION['update']))    
             {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
             }  
             
             
             // user not found
             if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                // pwd not found

                if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    // pwd change
                if(isset($_SESSION['change-pwd'])) 
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }   
          ?>
          <br> <br> 
        <!-- button for add rem -->
         <a href="add-admin.php" class="btn-primary">Add Admin</a>
         
         <br> <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.no</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
          
            <?php
             // query to get all admin
             $sql = "SELECT  *  FROM tbl_admin";

             // execute the query
             $res = mysqli_query($conn, $sql);

             // check the whether the query is selected or not
             if($res==TRUE)
                {
                    // counts row to check whether we have data in database or not
                    $count = mysqli_num_rows($res);

                    $sn=1; // create a variable and asign the value

                    // check number of rows
                    if($count>0)
                        {
                          // we have data in database  
                          while($rows = mysqli_fetch_assoc($res))
                            {
                                // using while loop to get data from database
                                // and while loop is run as long as , when we have data in database

                                // get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                // display the value in table
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                     <td> <?php  echo $full_name; ?></td>
                                     <td> <?php  echo $username;  ?></td>
                                    <td>
                                   
                                  <a href="<?php echo SITEURL; ?>admin/update-password.php? id=<?php echo $id;?>" class="btn-primary">Change Password </a>  
                                  <a href="<?php echo SITEURL; ?>admin/update-admin.php? id=<?php echo $id;?>" class="btn-secondary">Update Admin</a> 
                                  <a href="<?php echo SITEURL; ?>admin/delete-admin.php? id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                   </td>
                                </tr>

                                  <?php
                            } 
                        }
                        else{
                            // we dont have data in database
                        }
                } 
            
            
            ?>

        </table>

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php'); ?>