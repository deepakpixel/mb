
            <?php 
            require_once "../../../../resources/config/db.php";
            session_start();
            if (!((isset($_SESSION['loggedin'])) && $_SESSION['loggedin']=="tc-candidate" && isset($_SESSION['hints-used'])))
            header("location: index.php");
           ?>
<html lang=en>
    <head><title>Test ongoing</title>
    <script src="../alert.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/litera/bootstrap.min.css">
<link rel="stylesheet" href="../test-style.css" type="text/css">
<!-- <script src="../test-functions.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>


            <?php
// $id=$_SESSION['id'];
// $user=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id" );
// $user=mysqli_fetch_array($user);
// $_SESSION['isstarted']=$user['isstarted'];
// $_sess
            $settings=file_get_contents("../../config/settings.json");
            $settings= json_decode($settings,true); //converts json to array


            // $section1=mysqli_query($conn,"SELECT * FROM questions WHERE section=1");
            // $section2=mysqli_query($conn,"SELECT * FROM questions WHERE section=2");
            // $section3=mysqli_query($conn,"SELECT * FROM questions WHERE section=3");
            // $total_section_1_questions=mysqli_num_rows($section1);
            // $total_section_2_questions=mysqli_num_rows($section2);
            // $total_section_3_questions=mysqli_num_rows($section3);


            // $total_time=$settings['total-test-time'];

    //   if((isset($_SESSION['isstarted']) && $_SESSION['isstarted']==1))
    //         {
    //             $_SESSION['remaining-time']=$_SESSION['end']-time();
    //             $total_time=$_SESSION['remaining-time']/60;
    //         }



            // $todo_total_questions=$settings['total-questions'];
            // $todo_section_1_questions=$settings['questions-section-1'];
            // $todo_section_2_questions=$settings['questions-section-2'];
            // $todo_section_3_questions=$settings['questions-section-3'];



           

// echo '<br>'.$total_section_3_questions;
// $candidate_name="Deepak";
$candidate_name=$_SESSION['name'];
// echo $row;
?>







    <div class="header">
        <div id="hello-user">Hello <?php echo $candidate_name?></div>
        <div id="time-details">
            <span id="time-left">Time remaining</span> </div>
    </div>
   

    <?php
        // for($i=1;$i<=$todo_total_questions;$i++):

$pno=$_SESSION['problem-assigned'];
// $qid=$settings['set'.$set_number]['q'.$i.'-id'];
// echo "qid=".$qid;
$qna=mysqli_query($conn,"SELECT * FROM problemstatements WHERE pno='$pno'" );
$qna=mysqli_fetch_array($qna);
// var_dump($qna);
// choose a question and 4 ooptions from databse
$question=nl2br(htmlspecialchars($qna['problemstatement']));

?>
<div class="alert alert-info">
<?php echo $question ?>
</div>

<?php
    $hintsused=$_SESSION['hints-used'];
    for($i=1;$i<=$hintsused;$i++):
    $hint=array($qna['hint1'],$qna['hint2'],$qna['hint3']);
?>
<div class="alert alert-success">
<?php echo $hint[$i] ?>
</div>

<?php endfor?>


<button onclick="window.location.href='ex.php'">LOGOUT</button>


</body>


</html>


<script>
swal.fire("READ CAREFULLY","In detail how to submit")
</script>