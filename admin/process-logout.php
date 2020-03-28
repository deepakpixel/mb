<?php
session_start();
// $_SESSION['isloggedin']=0;
// unset($_SESSION['isloggedin']);
session_destroy();
// var_dump($_SESSION);
header("location: index.php");
?>