<?php
// start session (agar already start nahi hai)


// authorization access control
if(!isset($_SESSION['user'])) 
{
    // user is not logged in

    $_SESSION['no-login-message'] = "<div class='error'>Please login to access admin panel.</div>";

    // redirect to login page
    header('location:' . SITEURL . 'admin/login.php');
    exit();
}
?>