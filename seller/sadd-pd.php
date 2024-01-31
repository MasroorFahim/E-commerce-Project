<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
            <strong>Product-Form</strong><br/><br/>
            <h1 class="text-center">Add Product</h1><br>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="insert_table">
                
                <tr>
                    <td> Product Name: </td>
                    <td><input type= "text" name= "title" placeholder= "Product Name"></td>
                </tr>

                <tr>
                    <td> Description: </td>
                    <td><textarea name="description" cols="30" rows="10" placeholder="Description of the product"></textarea></td>
                </tr>

                <tr>
                    <td> Price: </td>
                    <td><input type= "number" name= "price" placeholder= "Product price"></td>
                </tr>

                <tr>
                    <td> Select Image: </td>
                    <td><input type= "file" name= "image"></td>
                </tr>
                
                <tr>
                    <td> Category ID: </td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM category WHERE active='yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $ctg_id= $rows['id'];
                                    $title= $rows['title'];
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
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type= "radio" name= "featured" value= "yes"> yes
                        <input type= "radio" name= "featured" value= "no"> no
                    </td>
                </tr>

                <tr>
                <td>Active: </td>
                    <td>
                        <input type= "radio" name= "active" value= "yes"> yes
                        <input type= "radio" name= "active" value= "no"> no
                    </td>
                </tr>

                <tr>
                    <td> Seller-Name: </td>
                    <td><b><?php echo $susername; ?></b></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Product" class= "btn"></td>
                </tr>

            </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php'); ?>

<?php

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];        
    }
    else
    {
        $featured = "no";
    }
    
    if(isset($_POST['active']))
    {
        $active = $_POST['active'];        
    }
    else
    {
        $active = "no";
    }

    if(isset($_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];

        if($image !="")
        {
            $ext = end(explode('.', $image));
            $image = "Product_Category_".rand(0000,9999).'.'.$ext;
            
            $source = $_FILES['image']['tmp_name'];
            $destination = "../UP Images/product/".$image;

            $upload = move_uploaded_file($source, $destination);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Could not Upload Image</div>";

                header('location:'.URL.'seller/sadd-pd.php');
                die();
            }
        }
    }
    else
    {
        $image = "";
    }

    $sql2 = "INSERT INTO product SET

    title = '$title',
    image_name= '$image',    
    featured = '$featured',
    active = '$active',
    description = '$description',
    price = '$price',
    category_id = '$category',
    seller_name = '$susername'

    ";

    $res2 = mysqli_query($conn, $sql2);

    if($res == true)
    {
        $_SESSION['add']="<div class='success'>Product Added Succesfully</div>";
        header("location:".URL.'seller/sellpd.php');
    }
    else
    {
        $_SESSION['add']="<div class='error'>Failed to add Product</div>";
        header("location:".URL.'seller/sadd-pd.php');
    }
}

?>