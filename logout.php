<?php
include('config/dbsql.php');

session_destroy();

header('location:'.URL.'login.php');
?>