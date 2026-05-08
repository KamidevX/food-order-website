<?php  include('partials/menu.php');?>

<div class="main-content">
    <div class="wraper">
    <h1>Manage Category</h1>

    <br> <br>

    <?php
         
         if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }

          if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }

            if(isset($_SESSION['no-category-found']))    
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
        
        
        ?>
        <br><br>
        <!-- button for add rem -->
         <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

    <br> <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.no</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <!--
            <tr>
                <td>1.</td>
                <td>Kamran Ali</td>
                <td><img src="images/category/kamibhai.jpg" alt="Category Image" width="100px"></td>
                <td>Yes</td>
                <td>Yes</td>
                <td>
                    <a href="#" class="btn-secondary">Update Category</a> 
                    <a href="#" class="btn-danger">Delete Category</a>
                </td>
            </tr> -->
                
           <?php
$sql = "SELECT * FROM tbl_category";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);

$sn = 1; // serial number

if($count > 0)
{
    while($row = mysqli_fetch_assoc($res))
    {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
        ?>

        <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>

            <td>
                <?php
                if($image_name != "")
                {
                    ?>
                    <img src="<?php echo SITEURL; ?>admin/images/category/<?php echo $image_name; ?>" width="100px" height="90px">
                    <?php
                }
                else
                { 
                    echo "<div class='error'>No Image</div>";
                }
                ?>
            </td>

            <td><?php echo $featured; ?></td>
            <td><?php echo $active; ?></td>

            <td>
                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a> 
                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
            </td>
        </tr>

        <?php
    }
}
else
{
    ?>
    <tr>
        <td colspan="6"><div class="error">No Category Added</div></td>
    </tr>
    <?php
}
?>
            

            
        </table>

    </div>
</div>

<?php  include('partials/footer.php');?>