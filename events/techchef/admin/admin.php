<?php session_start();
if (!((isset($_SESSION['adminloggedin']))&& $_SESSION['adminloggedin']=="tc-admin"))
header("location: index.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Techchef</title>
</head>

<body>

    <div class=center><strong>ADMIN PANEL (TECHCHEF)</strong>
        <span onclick="window.location.href='process-logout.php'"
            class="login-info">Logout</span>
    </div>
    <!-- ADMIN PANEL -->
    <!-- Show registered candidates with techchef -->
    <button class="btn btn-info" onclick="window.location.href='registered-min.php'">Registrations (Name and Contact only)</button>

    <button class="btn btn-info" onclick="window.location.href='registrations.php'">Show Registrations in detail</button>
    
    <button class="btn btn-info" onclick="window.location.href='upload-questions.php'">Submit Questions</button>

    <button class="btn btn-info" onclick="window.location.href='view-questions.php'">View Questions</button>

    <!-- <button class="btn btn-info" onclick="window.location.href='calculate-round1-score.php'">Calculate Round 1 scores</button> -->



    <!-- show advanced options -->
    <!--Delete event data-->

</body>

</html>

<style>
html,
body {
    margin: 0px 5%;
    padding: 0px;
}

.login-info {
    /* position: absolute; */
    float: right;
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
button{
    width:100%;
    margin-bottom:15px;
}

</style>