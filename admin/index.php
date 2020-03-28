<?php
session_start();
if ((isset($_SESSION['isloggedin']))&& $_SESSION['isloggedin']==1) {
header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Microbird</title>

</head>

<body>
    <form action="process-login.php" method="post">
        <input type="password" name="password" id="admin-password">
        <input type="submit" value="Submit">
    </form>
</body>

</html>