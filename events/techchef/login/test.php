
            <?php 
            require_once "../../../resources/config/db.php";
            session_start();
            if (!((isset($_SESSION['loggedin'])) && $_SESSION['loggedin']=="tc-candidate"))
            header("location: index.php");
           ?>
<html lang=en>
    <head><title>Test ongoing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body><script src="./alert.js"></script>
<link rel="stylesheet" href="./test-style.css" type="text/css">
<script src="./test-functions.js"></script>


            <?php
// $id=$_SESSION['id'];
// $user=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id" );
// $user=mysqli_fetch_array($user);
// $_SESSION['isstarted']=$user['isstarted'];
// $_sess
            $settings=file_get_contents("../config/settings.json");
            $settings= json_decode($settings,true); //converts json to array


            // $section1=mysqli_query($conn,"SELECT * FROM questions WHERE section=1");
            // $section2=mysqli_query($conn,"SELECT * FROM questions WHERE section=2");
            // $section3=mysqli_query($conn,"SELECT * FROM questions WHERE section=3");
            // $total_section_1_questions=mysqli_num_rows($section1);
            // $total_section_2_questions=mysqli_num_rows($section2);
            // $total_section_3_questions=mysqli_num_rows($section3);


            $total_time=$settings['total-test-time'];

      if((isset($_SESSION['isstarted']) && $_SESSION['isstarted']==1))
            {
                $_SESSION['remaining-time']=$_SESSION['end']-time();
                $total_time=$_SESSION['remaining-time']/60;
            }



            $todo_total_questions=$settings['total-questions'];
            // $todo_section_1_questions=$settings['questions-section-1'];
            // $todo_section_2_questions=$settings['questions-section-2'];
            // $todo_section_3_questions=$settings['questions-section-3'];



           

// echo '<br>'.$total_section_3_questions;
// $candidate_name="Deepak";
$candidate_name=$_SESSION['name'];
// echo $row;
?>


    <div class="header">
        <div id="hello-user">Hello, <?php echo $candidate_name?></div>
        <div id="time-details">
            <span id="time-left"></span> </div>
    </div>
    <!-- <hr> -->
    <div class="rules-container" id="rules-container">
    <div class="rules-heading">INSTRUCTIONS</div>
    <div class="rules">
        1. These rules are not final yet
        <br>
        2. Dont leave/close the test window after starting the test
        <br>
        3. Dont even try to play with my website
        <br>
        4. Rules will be updates soom
        <br>
        5. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        <br>
        6. Lorem ipsum dolor, sit amet consectetur adipisicing.
        <br>
    </div>

    <div class="start-button-class">
    <input id="start-test" type="button" value="Start Test" name="start-test"  onclick="window.location.href='start-test.php'">
    </div>
</div>
    <div class="main" id="main">
        <?php
        for($i=1;$i<=$todo_total_questions;$i++):

$set_number=$_SESSION['set-number'];
$qid=$settings['set'.$set_number]['q'.$i.'-id'];
// echo "qid=".$qid;
$qna=mysqli_query($conn,"SELECT * FROM questions WHERE qno='$qid'" );
$qna=mysqli_fetch_array($qna);
// var_dump($qna);
            // choose a question and 4 ooptions from databse
$question=nl2br(htmlspecialchars($qna['question']));
// echo $question;

            // $question=nl2br(htmlspecialchars('What will be the output of following program?
            //                                 #include<stdio.h>
            //                                 void main()
            //                                 {
            //                                     printf("includehelp.com\rOK\n");
            //                                     printf("includehelp.com\b\b\bOk\n");
            //                                 }'));
            // $question=nl2br(htmlspecialchars("<sometext
            // >"));
            // $option=array('Optio','Cumique','Mollitia','Repellat');

$option=array($qna['optiona'],$qna['optionb'],$qna['optionc'],$qna['optiond']);

            ?>
<!-- <div class="question-wrap"> -->
            <div class="question-container" id="question-container<?php echo $i?>" style="display:none">
                <!-- question number -->
                <div class="question-number" id="question-number<?php echo $i?>">
                    <strong>Question <?php echo $i?>:</strong>
                </div>

                <div class="question-answer" id="question-answer<?php echo $i?>">
                    <!-- question -->
                    <div class="question" id="question<?php echo $i?>">
                        <?php echo $question ?>
                    </div>
                    <!-- answer -->


                    <div class="answer" id="answer<?php echo $i?>">
                        <?php for($j=0,$ch='a';$j<4;$j++,$ch++):?>

                        <div class="option-container" id="option-container<?php echo $i.$ch?>">
                           <div class="input-and-label">
                            <input onchange="responseChanged('<?php echo $i.'\',\''.$ch ?>')" type="radio" name="answer<?php echo $i?>" id="option<?php echo $i.$ch?>a">
                                <label for="option<?php echo $i.$ch?>a">
                                    <?php echo $option[$j]?>
                                </label>
                           </div>
                        </div>
                        <?php endfor ?>

                    </div>

<div class="emptydiv"></div>
                </div>
                   <div class="controls"> 
                        <hr>
                        <button id="previous-question<?php echo $i ?>" class="previous-question" onclick="showQuestion(<?php echo $i-1?>,-1)">Back</button> 
                        <button id="next-question<?php echo $i ?>" class="next-question" onclick="showQuestion(<?php echo $i+1?>,1)">Next</button>
                        <hr>
                    </div>


            </div>

           
        <?php endfor ?>
    </div>
<!-- </div> -->
    <div class="end-test-class">
        <div class="endbutton-wrap">
        <button id="end-test" onclick="timeOver()">END TEST</button>
        </div>
    </div>

</body>


<?php
 if((isset($_SESSION['isstarted']) && $_SESSION['isstarted']==1))
 {
     $_SESSION['remaining-time']=$_SESSION['end']-time();
     $total_time=$_SESSION['remaining-time']/60;
     ?>
     <script>
    continueTest( <?php echo $total_time.','.$todo_total_questions.','.$_SESSION['id'] ?> );
     </script>

     <?php
 }
 
?>





</html>