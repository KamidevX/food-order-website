<?php include('partials/menu.php');?>



<div class="main-content">
    <div class="wraper">
        <h1>Add Admin</h1>
           <br><br>

     <?php
      if(isset($_SESSION['add'])) // checking session whether session set or not
        {
            echo $_SESSION['add']; //display the message if session is set
            unset($_SESSION['add']); // remove session message
        }
     
     ?>


        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                   <td><input type="text" name="full_name" placeholder="add your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="username"></td>
                </tr>
                <td>password:</td>
                    <td><input type="password" name="password" placeholder="add password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>


<?php
// process the value from form and save in database 

// check the wether button clicked or not

if(isset($_POST["submit"]))
    {
    //button clicked
    //echo"button clicked";
   // getting data from form

    $full_name = $_POST["full_name"];
     $username = $_POST["username"];
     $password = md5($_POST["password"]); // password encrypted with md5

     // 2. sql querry to save the data to database

     $sql = "INSERT INTO tbl_admin SET
      
      full_name='$full_name',
      username='$username',
      password='$password'
     ";
     
     // .3 querry and saving data in database

     $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // .4 check the wether the (querr is excuted) data inserted or not and display approptaite message
      if($res==TRUE)
        {
            // DATA inserted
           // echo "data is inserted";
           // create a session variable to dispaly the message 
           $_SESSION['add'] = "Admin added successfully";
           //redirect page TO manage admin
           header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{ 
            //data not inserted
            //echo "data is not inserted";
            // create a session variable to dispaly the message 
           $_SESSION['add'] = "Failed to add admin";
           //redirect page TO manage admin
           header("location:".SITEURL.'admin/add-admin.php');
        }
}


?>