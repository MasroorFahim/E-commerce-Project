<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">UPDATE ORDER</h1>

        <?php 

            $id = $_GET['id'];
            $sql = "SELECT * FROM order_table WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $count = mysqli_num_rows($res);
                
                if($count==1)
                {
                    echo "Order Available";

                    $row = mysqli_fetch_assoc($res);
                    $name = $row['customer_name'];
                    $contact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $status = $row['status'];
                    $address= $row['customer_address'];
                }
                else
                {
                    header('location:'.URL.'admin/manage-order.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="insert_table">
                
                <tr>
                    <td>Full Name:</td>
                    <td><input type= "text" name= "full_name" value = "<?php echo $name ?>"></td>
                </tr>
                
                <tr>
                    <td>Email:</td>
                    <td><input type= "text" name= "email" value = "<?php echo $email ?>"></td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="ordered") {echo "selected";}?> value="ordered">Ordered</option>
                            <option <?php if($status=="delivered") {echo "selected";}?> value="delivered">Delivered</option>
                            <option <?php if($status=="on delivery") {echo "selected";}?> value="on delivery">On Delivery</option>
                            <option <?php if($status=="cancelled") {echo "selected";}?> value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Phn no:</td>
                    <td><input type= "text" name= "contact" value = "<?php echo $contact ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td><input type= "text" name= "address" value = "<?php echo $address ?>"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="hidden" name="id" value = "<?php echo $id ?>"><input type="submit" name="submit" value="Update Order" class= "btn"></td>
                </tr>

            </table>
            </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    $name = $_POST['full_name'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql2 = "UPDATE order_table SET
    customer_name = '$name',
    status ='$status',
    customer_email = '$email',
    customer_contact = '$contact',
    customer_address = '$address'    
    WHERE id = '$id'

    ";
    $res2 = mysqli_query($conn, $sql2);

    if($res2==true)
    {
        $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
        header('location:'.URL.'admin/manage-order.php');
    }

    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Order</div>";
        header('location:'.URL.'admin/manage-order.php');
    }
}

?>

<?php include('partials/footer.php')?>