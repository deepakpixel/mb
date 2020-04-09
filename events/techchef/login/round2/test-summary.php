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
    // unset($_SESSION['isstarted']);
    // unset($_SESSION['issubmitted']);
    // unset($_SESSION['start']);
    // unset($_SESSION['end']);
    }
session_destroy();
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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/litera/bootstrap.min.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks for participating</title>
    <script src="./alert.js"></script>
</head>
<body>
<?php if($message=="um"):?>
    <script>
    Swal.fire("Tab change detected!","Looks like our cheating detection system caught you.\nIf thats not the case contact us now","info")
    </script>

<?php endif; ?>
<div class="thanks">
    <center><img src="/resources/images/tick.png" width="128px" alt="Test Submitted"></center>
    <center><h1>Thanks for participating, <?php echo $_SESSION['name']?></h1></center>
    <!-- <center>Details for next round will be shared with you soon.</center> -->
    <br>
<div class="feedback">
<span>Please share your valuable feedback:</span>
<form action="record-feedback.php" method="POST">
    
    </div>
        <div class="textarea">
            <textarea name="feedback" id="feedback-text" Placeholder="Tell us your experience during the whole event process or if there is something we need to improve." cols="30" rows="10"></textarea>
        </div>
    </div>
    <input name="id" type="text" value="<?php echo $_SESSION['id'] ?>" hidden>
    <center><button type="submit" id="back">Submit Feedback</button></center>


</form>


</body>
</html>


<style>
html,body{
    padding:0px;
    margin:0px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color:lightgrey;
}
.thanks{
    padding-top:50px;
}
#back{
    background-color:#546de5;
    width:150px;
    color: white;
    font-weight: bolder;
    height:50px;
    border-radius:25px;
    border:none;
    outline:none;
    
}
#back:hover{
    color: black;
    background-color: #778beb;
    border:black solid;
    cursor: pointer;
}
.feedback{
    display: block;
    margin: 0px auto;
    width: 500px;
    padding: 10px;
    max-width: 80vw;

    max-width: 80vw;
}
textarea{
    display: block;
    margin: 0px auto;
    width: 500px;
    padding: 10px;
    max-width: 80vw;

    max-width: 80vw;
    border-radius: 10px;
    margin-bottom:30px;
    outline:none;
}

</style>