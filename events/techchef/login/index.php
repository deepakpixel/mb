<?php
session_start();
require_once "../../../resources/config/db.php";

// if test expired show test is over see 
if ((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-candidate") {
header("Location: test.php");
}
$message="none";
if(isset($_REQUEST['m']))
$message=$_REQUEST['m'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TechChef</title>
</head>

<body>
    <?php if($message=="expired") : ?>
        <div class="message">
            Sorry the test is over
        </div>
    <?php endif; ?>

    <?php if($message=="early") : ?>
        <div class="message">
            Looks like you came too soon. Test hasn't started yet
        </div>
    <?php endif; ?>

    <?php if($message=="incorrect") : ?>
        <div class="message">
            Please re-recheck the login details carefully
        </div>
    <?php endif; ?>

    <?php if($message=="submitted") : ?>
        <div class="message">
            Your test is already submitted
        </div>
    <?php

// update issubmitted==1
$id=$_SESSION['id'];
$sql = "UPDATE registrations SET issubmitted=1 WHERE id='$id'";
if ($conn->query($sql) === TRUE)
session_destroy();
    endif; ?>



<form action="process-login.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>



</body>

</html>