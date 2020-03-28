<?php session_start();
if (!((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-admin"))
header("location: index.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Techchef</title>
</head>

<body>

    <div class=center><strong>ADMIN PANEL (TECHCHEF)</strong>
        <span onclick="window.location.href='process-logout.php'"
            class="login-info">Logout[<?php echo $_SESSION['username'] ?>]</span>
    </div>
    <!-- ADMIN PANEL -->
    <!-- Show registered candidates with techchef -->

    <!-- show advanced options -->
    <!--Delete event data-->

</body>

</html>

<style>
html,
body {
    margin: 0px;
    padding: 0px;
}

.login-info {
    position: absolute;
    /* float: right; */
    right: 0px;
    padding-right: 10px;
    cursor: pointer;
}

.center {

    background-color: lightgreen;
    margin: 0px 0px 20px 0px;
    text-align: center;
    padding: 0px;

    /* margin: 0px; */
}
</style>