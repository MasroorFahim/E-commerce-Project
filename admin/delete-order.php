<?php include('../config/dbsql.php'); 

$id =$_GET['id'];

$sql = "DELETE FROM order_table WHERE id=$id";
$res = mysqli_query($conn,$sql);

if($res==true)
{
    $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully</div>";
    header('location:'.URL.'admin/manage-order.php');
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to delete Order</div>";
    header('location:'.URL.'admin/manage-order.php');
}

?>