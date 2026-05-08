<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wraper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
        // get the id of selected admin
        $id=$_GET['id'];

        //create sql query to get details
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
      
        
        // execute the query
        $res=mysqli_query($conn, $sql);

        //check the whethr the query executed or not\
        if($res==TRUE)
            {
                // CHECK THE whether the data is avvailable or not
                 $count =mysqli_num_rows($res);

                 //check whether we have admin or not
                 if($count==1)
                    {
                        // get details
                        //echo "admin availble";
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username  = $row['username'];
                    }
                    else{
                        // we will redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                
            }
        
        
        ?>

        <form action="" method="POST">
         
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td> 
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name;?>">
                </td>
            </tr>


            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $username;?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php
// check the whether admin button cliced or not

if(isset($_POST['submit']))
    {
        // clicked 
        //echo "clicked";
        // get all the value from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username  = $_POST['username'];


        // create sql query to update admin

        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username  = '$username' 
        WHERE id  = '$id'
        ";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check the whether query successfully update or not
        if($res==TRUE)
            {
                // QUERY executed and update successfully
                $_SESSION['update'] = "admin update successfully";

                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else{
                // failed
                $_SESSION['update'] = "admin failed to update";

                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
    }
   
?>

<?php include('partials/footer.php');?>