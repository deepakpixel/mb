<?php
require_once "../../../resources/config/db.php";

session_start();
if (!((isset($_SESSION['adminloggedin']))&& $_SESSION['adminloggedin']=="tc-admin")) {
header("Location: index.php");
}

if(!isset($_REQUEST['submit']))
{
header("location: upload-questions.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload-Status</title>
</head>

<body>
<div class="alert alert-info">
    

<?php




if(isset($_REQUEST['submit']))
{
    $question=$_REQUEST['question'];
    $optiona=$_REQUEST['optiona'];
    $optionb=$_REQUEST['optionb'];
    $optionc=$_REQUEST['optionc'];
    $optiond=$_REQUEST['optiond'];
    $ans=$_REQUEST['ans'];
    $question=(str_replace("'","''",$question));
    $optiona=(str_replace("'","''",$optiona));
    $optionb=(str_replace("'","''",$optionb));
    $optionc=(str_replace("'","''",$optionc));
    $optiond=(str_replace("'","''",$optiond));
    $ans=(str_replace("'","''",$ans));


    if(strlen($question))
        if(strlen($optiona))  
            if(strlen($optionb))
                if(strlen($optionc))
                    if(strlen($optiond))   
                        if(strlen($ans))         
                    {    $sql = "INSERT INTO question2 (question,optiona,optionb,optionc,optiond,answer) VALUES('$question','$optiona','$optionb','$optionc','$optiond','$ans')";
                        if ($conn->query($sql) === TRUE)
                        {
                            echo "Question-Submitted";
                        }
                        else{
                            echo("Error description: " . $conn->error);
                        }
                    }
    else
    echo "One or more fields are empty";
}


?>
</div>

<button class="btn btn-primary" onclick="window.location.href='upload-questions.php'">Submit another question</button>

    
</body>
</html>


<style>
    body{
        text-align:center;
    }
    
</style>