<?php
if(!isset($_SESSION['suser']))
{
    $_SESSION['snot_login'] = "<div class= 'error'>Sign-in again</div>";
    header('location:'.URL.'login.php');
}
?>