<?php
$password="deepak";
session_start();
if(!(((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])=="superadmin") || (isset($_REQUEST['password'])&&($_REQUEST['password']==$password))))
{header("Location: index.php"); 
}
else
{
    $_SESSION['loggedin']="superadmin";
    $_SESSION['username']="MB-ADMIN";
    header("location: admin.php");
}

?>