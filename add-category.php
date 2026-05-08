<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wraper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        // Display session messages
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

        <!-- Add category form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category title" required></td>
                </tr>
                <tr>
                    <td>Add Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form end -->

        <?php
        if(isset($_POST['submit'])) {

            // Get form values safely
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Handle image upload
            $image_name = "";

            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {

                // Check if folder exists, if not create it
                $upload_dir = "images/category/";
                if(!is_dir($upload_dir)){
                    mkdir($upload_dir, 0777, true); // recursive mkdir
                }

                $image_name_original = $_FILES['image']['name'];
                $ext = pathinfo($image_name_original, PATHINFO_EXTENSION);
                $image_name = "Category_".rand(000,999).".".$ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = $upload_dir.$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload == false){
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }
            }

            // Insert into database
            $sql = "INSERT INTO tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
            ";

            $res = mysqli_query($conn, $sql);

            if($res == true){
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>