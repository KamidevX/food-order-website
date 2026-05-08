<?php include('../config/constants.php')  ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">login</h1>
          <br><br>

           <?php
           if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
           
           ?>
           <br><br>



        <!-- login form start here -->
         <form action="" method="post" class="text-center">
          
         username: <br>
         <input type="text" name="username" placeholder="enter user name"><br><br>
         password: <br>
         <input type="password" name="password" placeholder ="enter passsword"><br><br>
         <input type="submit" name="submit" value="Login" class="btn-primary">

        <br><br>
         </form>

        <!-- login form start here -->

        <p class="text-center">Created by - <a href="#">kamran ali</a></p>
    </div>
</body>
</html>

<?php

if(isset($_POST['submit']))
    {
        // getting data from user anem
        $username = $_POST['username'];
        $password = md5($_POST['password']);


        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        // execute the querry

        $res = mysqli_query($conn, $sql);

        //count rows to whether the user exist or not


        $count = mysqli_num_rows($res);

        if($count==1)
            {
                // user avvailable
                $_SESSION['login'] = "login sucessfull";
                $_SESSION['user'] = $username;


                header('location:'.SITEURL.'admin/');
            }
            else
                {
                    //user not availabel
                     $_SESSION['login'] = "login failed";
                     header('location:'.SITEURL.'admin/login.php');
                }
    }




?>