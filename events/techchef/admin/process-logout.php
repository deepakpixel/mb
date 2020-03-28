<?php
session_start();
// $_SESSION['loggedin']=0;
// unset($_SESSION['loggedin']);
session_destroy();
// var_dump($_SESSION);
header("location: index.php");
?>