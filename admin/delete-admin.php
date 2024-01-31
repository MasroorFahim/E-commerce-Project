<?php include('../config/dbsql.php'); 

$id =$_GET['id'];

$sql = "DELETE FROM admin_table WHERE id=$id";
$res = mysqli_query($conn,$sql);

if($res==true)
{
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    header('location:'.URL.'admin/manage-admin.php');
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin</div>";
    header('location:'.URL.'admin/manage-admin.php');
}

?>