<?php
session_start();
// $_SESSION['adminloggedin']=0;
unset($_SESSION['adminloggedin']);
// $_SESSION['adminloggedin']=0;
// session_destroy();

// var_dump($_SESSION);
header("location: index.php");
?>