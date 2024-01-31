<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1 class="text-center">Update Category</h1>

        <?php 

            if(isset($_GET['id']))
            {
            $id = $_GET['id'];
            $sql = "SELECT * FROM category WHERE id=$id";

            $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    
                    if($count==1)
                    {
                        echo "Category Available";

                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $old_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        header('location:'.URL.'admin/manage-admin.php');
                    }
                }
            }
            
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="insert_table">
                
                <tr>
                    <td>Title: </td>
                    <td><input type= "text" name= "title" value = "<?php echo $title ?>"></td>
                </tr>
                
                <tr>
                    <td>Current Image: </td>
                    <td>
                    <?php
                    if($old_image !="")
                    {?>    
                    <img src="<?php echo URL; ?>UP Images/Category/<?php echo $old_image; ?>" width= "100px" alt="curr_ctg_pic"></td>
                    <?php
                    }
                    else
                    {
                        echo "<div class='error'>Image not selected</div>";
                    }
                    ?>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td><input type= "file" name= "new_image"></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="yes"){ echo "checked"; }?> type= "radio" name= "featured" value = "yes"> yes
                        <input <?php if($featured=="no"){ echo "checked"; }?> type= "radio" name= "featured" value= "no"> no
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="yes"){ echo "checked"; }?> type= "radio" name= "active" value = "yes"> yes
                        <input <?php if($active=="no"){ echo "checked"; }?> type= "radio" name= "active" value= "no"> no
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value = "<?php echo $id ?>">
                        <input type="hidden" name="old_image" value = "<?php echo $old_image ?>">
                        <input type="submit" name="submit" value="Update Category" class= "btn">
                    </td>
                </tr>

            </table>
            </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $old_image = $_POST['old_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['new_image']['name']))
    {
        $new_image = $_FILES['new_image']['name'];
        if($new_image !="")
        {
            $ext = end(explode('.', $new_image));
            $new_image = "Product_Category_".rand(0000,9999).'.'.$ext;
            
            $source = $_FILES['new_image']['tmp_name'];
            $destination = "../UP Images/Category/".$new_image;

            $upload = move_uploaded_file($source, $destination);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Could not Upload Image</div>";

                header('location:'.URL.'admin/manage-category.php');
                die();
            }
            if($old_image !="")
            {
                $remove_path= "../UP Images/Category/".$old_image;
                $remove = unlink($remove_path);
                if($remove == false)
                {
                    $_SESSION['remove'] = "<div class='error'>Failed to remove current image</div>";
                    header('location:'.URL.'admin/manage-category.php');
                }                
            }
        }
        else
        {
            $new_image = $old_image;
        }
    }
    else
    {
        $new_image = $old_image;
    }

    $sql2 = "UPDATE category SET
    title = '$title',
    image_name= '$new_image',
    featured = '$featured',
    active = '$active'
    WHERE id = '$id'

    ";
    $res2 = mysqli_query($conn, $sql2);

    if($res2==true)
    {
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
        header('location:'.URL.'admin/manage-category.php');
    }

    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
        header('location:'.URL.'admin/manage-category.php');
    }
}

?>

<?php include('partials/footer.php')?>