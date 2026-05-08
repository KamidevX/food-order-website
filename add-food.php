<?php include("partials/menu.php"); ?>

<?php
if(isset($_POST['submit']))
{
    // Sanitize inputs
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // CATEGORY VALIDATION
    if($category == "")
    {
        $_SESSION['add'] = "<div class='error'>Please select a category</div>";
        header('location:'.SITEURL.'admin/add-food.php');
        exit();
    }

    // IMAGE UPLOAD
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
    {
        $image_name = $_FILES['image']['name'];

        // get extension
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // allowed types
        $allowed = array('jpg','jpeg','png','gif');

        if(!in_array($ext, $allowed))
        {
            $_SESSION['upload'] = "<div class='error'>Invalid image type</div>";
            header('location:'.SITEURL.'admin/add-food.php');
            exit();
        }

        // rename image
        $image_name = "Food_".rand(1000,9999).".".$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/".$image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if($upload == false)
        {
            $_SESSION['upload'] = "<div class='error'>Image Upload Failed</div>";
            header('location:'.SITEURL.'admin/add-food.php');
            exit();
        }
    }
    else
    {
        $image_name = "";
    }

    // INSERT QUERY
    $sql = "INSERT INTO tbl_food SET
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
    ";

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
        exit();
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Database Error: ".mysqli_error($conn)."</div>";
        header('location:'.SITEURL.'admin/add-food.php');
        exit();
    }
}
?>

<!-- MAIN CONTENT START -->
<div class="main-content">
    <div class="wrapper">

        <h1>Add Food</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" required></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5" required></textarea></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" required></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" required>
                            <option value="">Select Category</option>

                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($res) > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['title']; ?>
                                    </option>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<option value=''>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No" checked> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No" checked> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php include("partials/footer.php"); ?>