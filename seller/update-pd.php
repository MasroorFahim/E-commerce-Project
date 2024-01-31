<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1 class="text-center">Update Product</h1>

        <?php 

            if(isset($_GET['id']))
            {
            $id = $_GET['id'];
            $sql = "SELECT * FROM product WHERE id=$id";

            $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    
                    if($count==1)
                    {
                        echo "Product Available";

                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $price = $row['price'];
                        $description= $row['description'];
                        $old_image = $row['image_name'];
                        $ctg_id = $row['category_id'];
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
                    <td><input type= "text" name= "title" value = "<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type= "number" name= "price" value = "<?php echo $price; ?>"></td>
                </tr>

                <tr>
                    <td>Destination: </td>
                    <td><textarea name="description" cols="30" rows="10"><?php echo $description; ?></textarea></td>
                </tr>
                
                <tr>
                    <td>Current Image: </td>
                    <td>
                    <?php
                    if($old_image !="")
                    {?>
                    <img src="<?php echo URL; ?>UP Images/product/<?php echo $old_image; ?>" width= "100px" alt="curr_prd_pic"></td>
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
                    <td>Category ID: </td>
                    <td><select name="category">
                    <?php
                            $sql3 = "SELECT * FROM category WHERE active='yes'";
                            $res3 = mysqli_query($conn, $sql3);
                            $count = mysqli_num_rows($res3);

                            if($count>0)
                            {
                                while($rows2 =mysqli_fetch_assoc($res3))
                                {
                                    $ctg_id= $rows2['id'];
                                    $title= $rows2['title'];
                                    ?>
                                    <option value="<?php echo $ctg_id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                    </select></td>
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
                        <input type="submit" name="submit" value="Update Product" class= "btn">
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
    $price = $_POST['price'];
    $ctg_id =$_POST['category'];
    $description = $_POST['description'];
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
            $destination = "../UP Images/product/".$new_image;

            $upload = move_uploaded_file($source, $destination);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Could not Upload Image</div>";

                header('location:'.URL.'admin/manage-product.php');
                die();
            }
            if($old_image !="")
            {
                $remove_path= "../UP Images/product/".$old_image;
                $remove = unlink($remove_path);
                if($remove == false)
                {
                    $_SESSION['remove'] = "<div class='error'>Failed to remove current image</div>";
                    header('location:'.URL.'admin/manage-product.php');
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

    $sql2 = "UPDATE product SET
    title = '$title',
    image_name= '$new_image',
    price ='$price',
    description ='$description',
    category_id ='$ctg_id',
    featured = '$featured',
    active = '$active'
    WHERE id = '$id'

    ";
    $res2 = mysqli_query($conn, $sql2);

    if($res2==true)
    {
        $_SESSION['update'] = "<div class='success'>Product Updated Successfully</div>";
        header('location:'.URL.'seller/sellpd.php');
    }

    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Product</div>";
        header('location:'.URL.'admin/sellpd.php');
    }
}

?>

<?php include('partials/footer.php')?>