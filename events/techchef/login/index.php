<?php
session_start();
// if test expired show test is over see 
if ((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-candidate") {
header("Location: test.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TechChef</title>
</head>

<body>
<form action="process-login.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>



</body>

</html>