<?php 
include('../config/dbsql.php'); 
include('log-chk.php');
$username=$_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="../astyle.css">
    <link rel="stylesheet" href="../footer.css">
</head>
<body>
    <div class="menu">
        <div class="wrapper text-center">
            <ul style="display: inline">
                <a href="index.php"><li>Home</li></a>
                <a href="manage-admin.php"><li>Admin</li></a>
                <a href="manage-vet.php"><li>Vets</li></a>
                <a href="manage-category.php"><li>Category</li></a>
                <a href="manage-order.php"><li>Order</li></a>
                <a href="manage-product.php"><li>Products</li></a>
                <a href="<?php echo URL;?>logout.php"><li>Logout</li></a>

            </ul>
</div>
    </div>