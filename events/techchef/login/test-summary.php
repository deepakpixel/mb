<?php


session_start();
// $_SESSION['loggedin']=0;
// unset($_SESSION['loggedin']);
if (!((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-candidate"))
header("location: index.php");
else
session_destroy();
// var_dump($_SESSION);


if(isset($_REQUEST['m']))
$message=$_REQUEST['m'];
else
$message="none";

// if request['message']=timeover ==>automatically submitted
// if message=submitted :your test is submitted ==>show stats
// if message=already submitted ==>show stats
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Summary</title>
</head>
<body>
<?php if($message=="um"):?>
    <div class="cheated">
        Our cheating detection system told us that you were leaving test window. If that's not the case you can <a href="https://microbird.club/contact">contact us</a>.
    </div>
<?php endif; ?>
   Test Summary: for <?php echo $_SESSION['username'] ?>
   <button onclick="window.location.href='index.php'">OK</button>
</body>
</html>