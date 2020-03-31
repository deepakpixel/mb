<?php


session_start();
require_once "../../../resources/config/db.php";

// $_SESSION['loggedin']=0;
// unset($_SESSION['loggedin']);
if (!((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-candidate"))
header("location: index.php");
else
{
    $id=$_SESSION['id'];
    $sql = "UPDATE registrations SET issubmitted=1 WHERE id='$id'";
    if ($conn->query($sql) === TRUE)
    {
    unset($_SESSION['loggedin']);
    unset($_SESSION['isstarted']);
    unset($_SESSION['issubmitted']);
    unset($_SESSION['start']);
    unset($_SESSION['end']);
    }
// session_destroy();
}
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
    <script src="./alert.js"></script>
</head>
<body>
<?php if($message=="um"):?>
    <script>
    Swal.fire("Tab change detected!","Looks like our cheating detection system caught you. If thats not the case contact us now","info")
    </script>

<?php endif; ?>
   Test Summary: for <?php echo $_SESSION['username'] ?>
   <button onclick="window.location.href='index.php'">OK</button>
</body>
</html>