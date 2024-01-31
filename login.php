<?php include('partials-front/menu.php'); ?>
    <div class= "login">
        <h1 class="text-center">Login</h1><br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        }
        if(isset($_SESSION['not_login']))
        {
            echo $_SESSION['not_login'];
            unset ($_SESSION['not_login']);
        }
        if(isset($_SESSION['cnot_login']))
        {
            echo $_SESSION['cnot_login'];
            unset ($_SESSION['cnot_login']);
        }
        if(isset($_SESSION['snot_login']))
        {
            echo $_SESSION['snot_login'];
            unset ($_SESSION['snot_login']);
        }
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
            <select name="log-as" id="">
                <option value="Admin">Admin</option>
                <option value="Seller">Seller</option>
                <option value="Customer">Customer</option>
                <option value="Vet">Vet</option>
            </select><br>
            USERNAME: <input type="text" name="username" placeholder="username"><br><br>
            PASSWORD: <input type="password" name="password" placeholder="password"><br><br>
            <input type="submit" name="submit" value="Login">
        </form>
    
<?php
if(isset($_POST['submit']))
{
    $log = $_POST['log-as'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    if($log=="Admin")
    {
        $sql = "SELECT * FROM admin_table WHERE username='$username' AND password = '$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Logged-in Successfully</div>";
            $_SESSION['user'] = $username;
            header('location:'.URL.'admin');
        }
        else
        {
            $_SESSION['login'] = "<div class='error'>Username or Password Did not match</div>";
            header('location:'.URL.'login.php');
        }
    }
    else if($log=="Customer")
    {
        $sql = "SELECT * FROM customer_info WHERE username='$username' AND password = '$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Logged-in Successfully</div>";
            $_SESSION['cuser'] = $username;
            header('location:'.URL.'customer');
        }
        
        else
        {
            $_SESSION['login'] = "<div class='error'>Username or Password Did not match</div>";
            header('location:'.URL.'login.php');
        }
    }
    else if($log=="Seller")
    {
        $sql = "SELECT * FROM seller_info WHERE username='$username' AND password = '$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Logged-in Successfully</div>";
            $_SESSION['suser'] = $username;
            header('location:'.URL.'seller');
        }
        
        else
        {
            $_SESSION['login'] = "<div class='error'>Username or Password Did not match</div>";
            header('location:'.URL.'login.php');
        }
    }
    else if($log=="Vet")
    {
        $sql = "SELECT * FROM vet_table WHERE username='$username' AND password = '$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Logged-in Successfully</div>";
            $_SESSION['vuser'] = $username;
            header('location:'.URL.'Vet');
        }
        
        else
        {
            $_SESSION['login'] = "<div class='error'>Username or Password Did not match</div>";
            header('location:'.URL.'login.php');
        }
    }
    else
    {
        echo "Mistake";
    }
}
?>
</div>
<?php include('partials-front/footer.php');?>