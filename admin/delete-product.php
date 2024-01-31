<?php include('../config/dbsql.php'); 

if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image = $_GET['image_name'];

        if($image != "")
        {
            $path = "../UP Images/product/".$image;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class= 'error'>Could not remove Image</div>";
                header('location:'.URL.'admin/manage-product.php');
                die();
            }
        }

    $sql = "DELETE FROM product WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully</div>";
        header('location:'.URL.'admin/manage-product.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Product</div>";
        header('location:'.URL.'admin/manage-product.php');
    }
}
else
{
    header('location:'.URL.'admin/manage-product.php');
}

?>