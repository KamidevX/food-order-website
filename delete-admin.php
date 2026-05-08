<?php
// including constants.php file here
include('../config/constants.php');
//.1 get the id of admin to be deleted

echo $id = $_GET['id'];

//.2 create sql query to  delete admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check the whether the query succeful or not 
if($res == TRUE)
    {
// SUCCEFUL and delete the admin
   //echo "succesfully delete admin";
   // create seesion var for display message
   $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
   // redirect to manage admin page
   header('location:'.SITEURL.'/admin/manage-admin.php');
}
else{
    // not successfull
    //echo "not deleting admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete the admin. Please try again.</div>";
    header('location:'.SITEURL.'/admin/manage-admin.php');
}

//.3 redirct to manage admin page messsage either success or error


?>