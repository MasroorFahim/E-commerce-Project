<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
            <strong>Vet-Form</strong><br/><br/>
            <h1 class="text-center">Add Vet</h1>
            <form action="" method="POST">
            <table class="insert_table">
                
                <tr>
                    <td>Full Name:</td>
                    <td><input type= "text" name= "full_name" placeholder= "Enter your name" required></td>
                </tr>
                
                <tr>
                    <td>Email:</td>
                    <td><input type= "text" name= "email" placeholder= "Enter your mail" required></td>
                </tr>

                <tr>
                    <td>User-Name:</td>
                    <td><input type= "text" name= "user_name" placeholder= "Enter your user-name" required></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type= "password" name= "password" placeholder= "Enter your password" required></td>
                </tr>

                <tr>
                    <td>Phn no:</td>
                    <td><input type= "text" name= "phn_no" placeholder= "Enter your Phn no." required></td>
                </tr>

                <tr>
                    <td>Qualification:</td>
                    <td><input type= "text" name= "quali" placeholder= "Enter your qualification" required></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Vet" class= "btn"></td>
                </tr>

            </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php'); ?>

<?php

if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);
    $phn_no = $_POST['phn_no'];
    $quali = $_POST['quali'];

    $sql = "INSERT INTO vet_table SET

    full_name = '$full_name',    
    email = '$email',
    username = '$user_name',
    password = '$password',
    phn_no = '$phn_no',
    qualification = '$quali'

    ";

    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    if($res == true)
    {
        $_SESSION['add']="<div class='success'>Vet Added Succesfully</div>";
        header('location:'.URL.'admin/manage-vet.php');
    }
    else
    {
        $_SESSION['add']="<div class='error'>Failed to add Vet</div>";
        header('location:'.URL.'admin/add-vet.php');
    }
}

?>