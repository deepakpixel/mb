<?php
session_start();
if ((isset($_SESSION['adminloggedin']))&& $_SESSION['adminloggedin']=="tc-admin") {
header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | TechChef</title>

</head>

<body>

    <div class="modal-footer">
        <div class="wrapper-div">
            <form action="process-login.php" method="post">
                <input type="password" name="password" placeholder="Enter password">
                <button type="button" class="button"> Submit </button>
            </form>
        </div>

    </div>


    <style>
    body,
    html {
        margin: 0px;
        padding: 0px;
    }

    .modal-footer {
        background-color: #2A3E5D;
        color: white;
        height: 100px;
        /* padding: 2px 16px; */
    }

    /* .wrapper-div {
        vertical-align: middle
    } */

    .button {
        background: #e8e8e8;
        display: inline-block;
        font-size: 12px position: relative;
    }

    .modal-footer {
        display: table;
        width: 100%;
        height: 100vh;
        padding: 0px;

    }

    .wrapper-div {
        /* display: table-cell;
        vertical-align: middle; */
        padding-top:50px;
        text-align: center;
    }
    </style>

</body>

</html>