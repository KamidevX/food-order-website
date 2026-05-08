<?php
// include constants file
include("../config/constants.php");

// check whether id and image_name are set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // get values
    $id = $_GET['id'];
    $image_name = trim($_GET['image_name']);

    // remove image if available
    if($image_name != "")
    {
        // ✅ FIXED PATH (because images are inside admin folder)
        $path = "images/category/" . $image_name;

        // check if file exists
        if(file_exists($path))
        {
            $remove = unlink($path);

            // if failed to remove image
            if($remove == false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                die();
            }
        }
        else
        {
            $_SESSION['remove'] = "<div class='error'>Image not found.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    // delete from database
    $sql = "DELETE FROM tbl_category WHERE id = $id";

    // execute query
    $res = mysqli_query($conn, $sql);

    // check result
    if($res == true)
    {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
    }

    // redirect
    header('location:' . SITEURL . 'admin/manage-category.php');
}
else
{
    // redirect if id not set
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>