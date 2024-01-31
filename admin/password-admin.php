<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Change Password</h1><br>
    <?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    ?>
    <form action="" method="POST">
            <table class="insert_table">
                
                <tr>
                    <td>Current Password:</td>
                    <td><input type= "password" name= "old_pass" placeholder= "Current Password"></td>
                </tr>
                
                <tr>
                    <td>New Password:</td>
                    <td><input type= "password" name= "new_pass" placeholder= "New Password"></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input type= "password" name= "confirm_pass" placeholder= "Confirm Password"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="hidden" name="id" value = "<?php echo $id ?>"><input type="submit" name="submit" value="Change Password" class= "btn"></td>
                </tr>

            </table>
            </form>

    </div>
</div>

<?php
if(isset($_POST['submit']))
{
    $old_pass = md5($_POST['old_pass']);
    $new_pass = md5($_POST['new_pass']);
    $confirm_pass = md5($_POST['confirm_pass']);

    $sql = "SELECT * FROM admin_table WHERE id='$id' AND password='$old_pass'";
    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            if($new_pass==$confirm_pass)
            {
                $sql2 = "UPDATE admin_table SET 
                password = $new_pass
                WHERE id =$id
                ";
                $res2 = mysqli_query($conn, $sql);

                if($res2 == true)
                {
                    $_SESSION['pw_changed'] = "<div class='success'>New password Updated</div>";
                    header('location:'.URL.'admin/manage-admin.php');
                }
                else
                {
                    $_SESSION['pw_changed'] = "<div class='error'>Password Unchanged</div>";
                    header('location:'.URL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['pw_not_matched'] = "<div class='error'>New password not matched</div>";
                header('location:'.URL.'admin/manage-admin.php');
            }
        }
        else
        {
            $_SESSION['not_matched'] = "<div class='error'>User not found</div>";
            header('location:'.URL.'admin/manage-admin.php');
        }
    }
        
        
}
?>

<?php include('partials/footer.php');?>