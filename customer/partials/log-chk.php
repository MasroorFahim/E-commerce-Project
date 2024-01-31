<?php
if(!isset($_SESSION['cuser']))
{
    $_SESSION['cnot_login'] = "<div class= 'error'>Sign-in again</div>";
    header('location:'.URL.'login.php');
}
?>