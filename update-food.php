<?php include("partials/menu.php"); ?>

<?php
// check id
if(isset($_GET['id']))
{
    $id = (int)$_GET['id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res == true && mysqli_num_rows($res) == 1)
    {
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
        exit();
    }
}
else
{
    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
?>

<div class="main-content">
<div class="wrapper">

<h1>Update Food</h1>
<br><br>

<form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">

<tr>
<td>Title:</td>
<td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
</tr>

<tr>
<td>Description:</td>
<td><textarea name="description" required><?php echo $description; ?></textarea></td>
</tr>

<tr>
<td>Price:</td>
<td><input type="number" name="price" value="<?php echo $price; ?>" required></td>
</tr>

<tr>
<td>Current Image:</td>
<td>
<?php
if($current_image != "")
{
?>
    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
<?php
}
else
{
    echo "<div class='error'>No Image</div>";
}
?>
</td>
</tr>

<tr>
<td>New Image:</td>
<td><input type="file" name="image"></td>
</tr>

<tr>
<td>Category:</td>
<td>
<select name="category" required>

<?php
$sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
$res2 = mysqli_query($conn, $sql2);

if(mysqli_num_rows($res2) > 0)
{
    while($cat = mysqli_fetch_assoc($res2))
    {
?>
    <option value="<?php echo $cat['id']; ?>"
        <?php if($current_category == $cat['id']) echo "selected"; ?>>
        <?php echo $cat['title']; ?>
    </option>
<?php
    }
}
else
{
?>
    <option value="">No Category Found</option>
<?php
}
?>

</select>
</td>
</tr>

<tr>
<td>Featured:</td>
<td>
<input type="radio" name="featured" value="Yes" <?php if($featured=="Yes") echo "checked"; ?>> Yes
<input type="radio" name="featured" value="No" <?php if($featured=="No") echo "checked"; ?>> No
</td>
</tr>

<tr>
<td>Active:</td>
<td>
<input type="radio" name="active" value="Yes" <?php if($active=="Yes") echo "checked"; ?>> Yes
<input type="radio" name="active" value="No" <?php if($active=="No") echo "checked"; ?>> No
</td>
</tr>

<tr>
<td colspan="2">

<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

<input type="submit" name="submit" value="Update Food" class="btn-secondary">

</td>
</tr>

</table>

</form>

</div>
</div>

<?php
// UPDATE PROCESS
if(isset($_POST['submit']))
{
    $id = (int)$_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    $current_image = $_POST['current_image'];

    $image_name = $current_image;

    // IMAGE UPLOAD
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
    {
        $image_name_new = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($image_name_new, PATHINFO_EXTENSION));

        $image_name = "Food_".rand(1000,9999).".".$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/".$image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if($upload == false)
        {
            $_SESSION['update'] = "<div class='error'>Image Upload Failed</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            exit();
        }

        // delete old image
        if($current_image != "")
        {
            unlink("../images/food/".$current_image);
        }
    }

    // UPDATE QUERY
    $sql3 = "UPDATE tbl_food SET
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
        WHERE id=$id
    ";

    $res3 = mysqli_query($conn, $sql3);

    if($res3 == true)
    {
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Update Failed</div>";
    }

    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
?>

<?php include("partials/footer.php"); ?>