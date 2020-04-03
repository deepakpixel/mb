<?php
session_start();
if (!((isset($_SESSION['adminloggedin']))&& $_SESSION['adminloggedin']=="tc-admin")) {
header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Questions</title>
</head>
<body>
<div class="qno"><?php

require_once "../../../resources/config/db.php";

$user=mysqli_query($conn,"SELECT * FROM question2" );
$user=mysqli_num_rows($user);
if($user==NULL)
$user=0;
$user+=1;
echo 'Q.No:'.$user;
?></div>


    <form action="upload-questions-process.php" method="post">
        <textarea name="question" id="question" Placeholder="Write the question here" cols="30" rows="10"></textarea>
        <!-- <input type="text" name="question" placeholder="Question"> -->
        <input type="text" name="optiona" placeholder="OptionA">
        <input type="text" name="optionb" placeholder="OptionB">
        <input type="text" name="optionc" placeholder="OptionC">
        <input type="text" name="optiond" placeholder="OptionD">
        <input type="text" name="ans" placeholder="Ans eg a,b,c,d in short">
        <input type="submit" name="submit" class="btn btn-primary">

    </form>
</body>
</html>

<style>
    input,textarea,.qno{
        display:block;
        width:90%;
        margin:1% 5%;
    }

</style>