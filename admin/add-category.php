<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
            <strong>Category-Form</strong><br/><br/>
            <h1 class="text-center">Add Category</h1><br>
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
                    <td> Category Name: </td>
                    <td><input type= "text" name= "title" placeholder= "Category Name"></td>
                </tr>

                <tr>
                    <td> Select Image: </td>
                    <td><input type= "file" name= "image"></td>
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
                    <td colspan="2"><input type="submit" name="submit" value="Add Category" class= "btn"></td>
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
            $destination = "../UP Images/Category/".$image;

            $upload = move_uploaded_file($source, $destination);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Could not Upload Image</div>";

                header('location:'.URL.'admin/add-category.php');
                die();
            }
        }
    }
    else
    {
        $image = "";
    }

    $sql = "INSERT INTO category SET

    title = '$title',
    image_name= '$image',    
    featured = '$featured',
    active = '$active'

    ";

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['add']="<div class='success'>Category Added Succesfully</div>";
        header("location:".URL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['add']="<div class='error'>Failed to add Category</div>";
        header("location:".URL.'admin/add-category.php');
    }
}

?>