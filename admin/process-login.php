<?php
$password="deepak";
session_start();
if(!((isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'])==1 || (isset($_REQUEST['password'])&&($_REQUEST['password']==$password))))
{header("Location: index.php"); 
}
else
{
    $_SESSION['isloggedin']=1;
    $_SESSION['username']="deepak";
    header("location: admin.php");
}

?>