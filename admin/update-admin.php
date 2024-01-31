<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">UPDATE ADMIN</h1>

        <?php 

            $id = $_GET['id'];
            $sql = "SELECT * FROM admin_table WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $count = mysqli_num_rows($res);
                
                if($count==1)
                {
                    echo "Admin Available";

                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $phn_no = $row['phn_no'];
                }
                else
                {
                    header('location:'.URL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="insert_table">
                
                <tr>
                    <td>Full Name:</td>
                    <td><input type= "text" name= "full_name" value = "<?php echo $full_name ?>"></td>
                </tr>
                
                <tr>
                    <td>Email:</td>
                    <td><input type= "text" name= "email" value = "<?php echo $email ?>"></td>
                </tr>

                <tr>
                    <td>User-Name:</td>
                    <td><input type= "text" name= "username" value = "<?php echo $username ?>"></td>
                </tr>

                <tr>
                    <td>Phn no:</td>
                    <td><input type= "text" name= "phn_no" value = "<?php echo $phn_no ?>"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="hidden" name="id" value = "<?php echo $id ?>"><input type="submit" name="submit" value="Update Admin" class= "btn"></td>
                </tr>

            </table>
            </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phn_no = $_POST['phn_no'];

    $sql2 = "UPDATE admin_table SET
    full_name = '$full_name',
    username ='$username',
    email = '$email',
    phn_no = '$phn_no'
    WHERE id = '$id'

    ";
    $res2 = mysqli_query($conn, $sql2);

    if($res2==true)
    {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        header('location:'.URL.'admin/manage-admin.php');
    }

    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
        header('location:'.URL.'admin/manage-admin.php');
    }
}

?>

<?php include('partials/footer.php')?>