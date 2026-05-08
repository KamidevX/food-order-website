<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wraper">
        <h1>Change Password</h1>

        <br> <br>

        <?php
        if(isset($_GET['id']))
            {
               $id = $_GET['id'];
            }
        
        
        ?>

        <form action="" method="post">
            
        <table class="tbl-30">
            <tr>
                <td>Old Password:</td>
                <td>
                    <input type="password" name="current_password" value="" placeholder="current password">
                </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" id="" placeholder=" add new password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" id="" placeholder="confirm password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="change password" class="btn-secondary">
                </td>
            </tr>
        </table>



        </form>
    </div>
</div>

<?php
// check th whether the submit buton clicked or not
if(isset($_POST['submit']))
    {
     //.1 echo clicked

     //.2 // get the data from form
      $id = $_POST['id'];
      $current_password = md5($_POST['current_password']);
      $new_password = md5($_POST['new_password']);
      $confirm_password = md5($_POST['confirm_password']);
     //.3 check the whether user with current id or password  exist or not
     $sql = "SELECT * FROM tbl_admin WHERE id=$id AND PASSWORD = '$current_password'";

     // EXECUTE the querry
     $res = mysqli_query($conn, $sql);

     if($res==true)
        {
            // check whether data is avavilble or not
            $count = mysqli_num_rows($res);

            if($count == 1)
                {
                    // user exist and password can be changeed
                    //echo "user found";
                    //check whether newpassword and old paswprd match are not
                    if($new_password==$confirm_password)
                        {
                         //update the passsword
                         $sql2 = "UPDATE tbl_admin SET
                                 password = '$new_password'
                                 WHERE $id = (int)$id;
                                 ";

                                 // exexcute the query
                                 $res2 = mysqli_query($conn, $sql2);

                                 //check whether the query executed or not
                                 if($res2==true)
                                    {
                                        //DISPlay success message
                                        //redirect to manage admin page to  with error message
                                      $_SESSION['change-pwd'] = "password change successfully"; // color?
                                      header('location:'.SITEURL.'admin/manage-admin.php'); exit();
                                    }
                                    else
                                    {
                                            // not executed  succcessfully
                                            //redirect to manage admin page to  with error message
                                      $_SESSION['change-pwd'] = "failed to change"; // color?
                                      header('location:'.SITEURL.'admin/manage-admin.php'); exit();
                                    }
                        
                        }
                        else{
                            //redirect to manage admin page to  with error message
                            $_SESSION['pwd-not-match'] = "password did not match"; // color?
                            header('location:'.SITEURL.'admin/manage-admin.php'); exit();
                        }
                }
                else
                    {
                   // user not exist set the message and redirect
                   $_SESSION['user-not-found'] = "user not found"; // color?
                   header('location:'.SITEURL.'admin/manage-admin.php'); exit();
                }
        }

     //.4 change pasword if all above is true

    }


?>

<?php include('partials/footer.php'); ?>