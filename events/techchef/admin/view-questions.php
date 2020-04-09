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
<div class="qno">
<?php

require_once "../../../resources/config/db.php";

$questions=mysqli_query($conn,"SELECT * FROM questions" );
$number=mysqli_num_rows($questions);

echo '<div class="alert alert-info">Total Questions:'.$number.'</div>';

while($row=mysqli_fetch_array($questions))
{$filtered_question=nl2br(htmlspecialchars($row['question']));
echo '<div class="qno">QNo:'.$row['qno'].'</div>
    <div class="question"> '.$filtered_question.'</div>
    <div class="option">a) '.$row['optiona'].'</div>
    <div class="option">b) '.$row['optionb'].'</div>
    <div class="option">c) '.$row['optionc'].'</div>
    <div class="option">d) '.$row['optiond'].'</div>
    <div class="answer alert alert-success">Ans '.$row['answer'].'</div>';

// if($user==NULL)
// $user=0;
// $user+=1;
}
?>

</div>
</body>
</html>

<style>
    .option{
    
            background-color:#f2f2f2;
        }
    .question{
        /* font-weight:bolder; */
    }
    .qno{
        font-weight:bolder;
    }
    .answer{
        border-bottom:black solid;
    }
    </style>