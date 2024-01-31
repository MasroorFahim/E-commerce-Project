<?php
if(!isset($_SESSION['user']))
{
    $_SESSION['not_login'] = "<div class= 'error'>Sign-in again</div>";
    header('location:'.URL.'login.php');
}
?>