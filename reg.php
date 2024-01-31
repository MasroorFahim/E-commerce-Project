<?php include('partials-front/menu.php');?>
<?php 
if(isset($_GET['type']))
{
    $sign_up=$_GET['type'];?>
<div class= "login">
        <h1 class="text-center">Registration</h1><br>
        <?php
        if(isset($_SESSION['reg']))
        {
            echo $_SESSION['reg'];
            unset ($_SESSION['reg']);
        }
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['pwd']))
        {
            echo $_SESSION['pwd'];
            unset ($_SESSION['pwd']);
        }
        ?>
        <form action="" method="POST">
            Full-Name: <input type="text" name="fullname" placeholder="full-name" required><br><br>
            Email: <input type="text" name="email" placeholder="email" required><br><br>
            USERNAME: <input type="text" name="username" placeholder="username" required><br><br>
            PASSWORD: <input type="password" name="password" placeholder="password" required><br><br>
            Confirm-Password: <input type="password" name="confirm" placeholder="confirm-password" required><br><br>
            Phone no: <input type="text" name="phn" placeholder="username" required><br><br>
            Location: <input type="text" name="location" placeholder="location" required><br><br>
            <input type="submit" name="submit" value="Register">
        </form>
    
<?php
if(isset($_POST['submit']))
{
    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm = md5($_POST['confirm']);
    $phn =$_POST['phn'];
    $location = $_POST['location'];

    $sql1= "SELECT * FROM customer_info WHERE username='$username'";
    $res1= mysqli_query($conn, $sql1);
    $count1= mysqli_num_rows($res1);

if($count1==0)
{    
    if($sign_up=="customer" && $password==$confirm)
    {
        $sql = "INSERT INTO customer_info SET

        full_name ='$fname',
        email = '$email',
        username = '$username',
        password ='$password',
        location = '$location',
        phn_no = '$phn'
        
        ";

        $res = mysqli_query($conn, $sql);

            if($res == true)
            {
                $_SESSION['add']="<div class='success'>Registration Successful</div>";
                header('location:'.URL.'login.php');
            }
            else
            {
                $_SESSION['add']="<div class='error'>Failed to Register</div>";
            }
    }
    else
    {
        $_SESSION['pwd']="<div class='error'>Password not match</div>";
    }
}
else
{
    $_SESSION['reg']="<div class='error'>Username already in use. Please use another name</div>";
    header('location:'.URL.'reg.php?type=customer');
}
        $sql2= "SELECT * FROM seller_info WHERE username='$username'";
        $res2= mysqli_query($conn, $sql2);
        $count2= mysqli_num_rows($res2);

    if($count2==0)
    {    
        if($sign_up=="seller" && $password==$confirm)
        {
            $sql = "INSERT INTO seller_info SET
            
            full_name ='$fname',
            email = '$email',
            username = '$username',
            password ='$password',
            location = '$location',
            phn_no = '$phn'
            
            ";
            $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                    $_SESSION['add']="<div class='success'>Registration Successful</div>";
                    header('location:'.URL.'login.php');
                }
                else
                {
                    $_SESSION['add']="<div class='error'>Failed to Register</div>";
                }
        }
        else
        {
            $_SESSION['pwd']="<div class='error'>Password not match</div>";
        }
    }
    else
    {
        $_SESSION['reg']="<div class='error'>Username already in use. Please use another name</div>";
        header('location:'.URL.'reg.php?type=seller');
    }
    
}
?>
</div>
<?php 
}?>
<?php include('partials-front/footer.php');?>