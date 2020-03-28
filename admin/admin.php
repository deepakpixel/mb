<?php session_start();
if (!((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="superadmin"))
header("location: index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Microbird</title>
</head>

<body>

    <div class=center><strong>ADMIN PANEL</strong>
        <span onclick="window.location.href='process-logout.php'"
            class="login-info">Logout[<?php echo $_SESSION['username'] ?>]</span>
    </div>
    <div class="container">
        <button class="button-primary" id="fetch-changes" onclick="updateWebsite()">Fetch website changes</button>
        <div id="message">
            Output will show hebre...
        </div>

    </div>

</body>

</html>
<script>
function updateWebsite() {
    console.log("Funcion called");
    var req = new XMLHttpRequest();
    req.open("GET", "update.php", true);
    req.onload = function() {
        document.getElementById("message").innerHTML = this.responseText;
    };
    req.send();
}
</script>
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

.button-primary {
    width: 200px;
    height: 30px;
    color: white;
    background-color: grey;
    /* border: none; */
    border: darkgrey solid;
    outline: none;
}

.button-primary:hover {
    color: black;
    background-color: white;
    cursor: pointer;
}

.container {
    width: 80%;
    margin: auto auto;
}

#message {
    width: 100%;
    height: auto;
    background-color: lightgrey;
    color: black;
    position: fixed;
    padding: 10px 10px 30px 10px;
    bottom: 0px;

    left: 0px;
    border-top: 5px solid darkgrey;

}
</style>