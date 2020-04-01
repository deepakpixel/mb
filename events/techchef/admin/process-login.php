<?php

$password="deepak";
session_start();
if(!(((isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'])=="tc-admin") || (isset($_REQUEST['password'])&&($_REQUEST['password']==$password))))
{header("Location: index.php"); 
}
else
{
    $_SESSION['adminloggedin']="tc-admin";
    $_SESSION['username']="TC-ADMIN";
    header("location: admin.php");
}

?>