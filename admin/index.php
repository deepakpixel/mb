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

    <div class="modal-footer">
        <div class="wrapper-div">
            <form action="process-login.php" method="post">
                <input type="password" name="password">
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
        padding: 2px 16px;
    }

    .wrapper-div {
        vertical-align: middle
    }

    .button {
        background: #e8e8e8;
        display: inline-block;
        font-size: 12px position: relative;
    }

    .modal-footer {
        display: table;
        width: 100%;
        height: 100vh;
    }

    .wrapper-div {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
    }
    </style>

</body>

</html>