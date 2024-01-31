<?php

session_start();
define('URL', 'http://localhost:8080/asif/');

define('LOCALHOST','localhost:3306');
define('USERNAME','root');
define('PASSWORD', 'root');
define('DB_NAME', 'demo');
    
    $conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>