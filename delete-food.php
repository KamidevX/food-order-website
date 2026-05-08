<?php
include("../config/constants.php");
session_start();

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    $id = (int)$_GET['id'];
    $image_name = $_GET['image_name'];

    // remove image
    if($image_name != "")
    {
        $path = "../images/food/".$image_name;

        if(file_exists($path))
        {
            $remove = unlink($path);

            if($remove == false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to remove image</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();
            }
        }
    }

    // delete DB
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
    }

    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
else
{
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
?>