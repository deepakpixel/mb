<?php require_once "../../../resources/config/db.php";
session_start();
if (!((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-candidate"))
header("location: index.php");

$settings=file_get_contents("../config/settings.json");
$settings= json_decode($settings,true); //converts json to array


$section1=mysqli_query($conn,"SELECT * FROM questions WHERE section=1");
$section2=mysqli_query($conn,"SELECT * FROM questions WHERE section=2");
$section3=mysqli_query($conn,"SELECT * FROM questions WHERE section=3");
$total_section_1_questions=mysqli_num_rows($section1);
$total_section_2_questions=mysqli_num_rows($section2);
$total_section_3_questions=mysqli_num_rows($section3);


$total_time=$settings['total-test-time'];
$todo_total_questions=$settings['total-questions'];
$todo_section_1_questions=$settings['questions-section-1'];
$todo_section_2_questions=$settings['questions-section-2'];
$todo_section_3_questions=$settings['questions-section-3'];




// echo '<br>'.$total_section_3_questions;
$candidate_name="Deepak";
// echo $row;
?>

<html lang=en>
<title>Techchef | Login</title>


<body>
    <div class="header">
        <div id="hello-user">Hello, <?php echo $candidate_name?></div>
        <div id="time-details">
            <span id="time-left"></span> </div>
    </div>
    <hr>

    <input type="button" value="Start Test" name="start-test"  onclick="startTest( <?php echo $total_time.','.$todo_total_questions ?> )">

    <div class="main" id="main">
        <?php
        for($i=1;$i<=$todo_total_questions;$i++):

            // choose a question and 4 ooptions from databse
            $question=nl2br(htmlspecialchars('What will be the output of following program?
                                            #include<stdio.h>
                                            void main()
                                            {
                                                printf("includehelp.com\rOK\n");
                                                printf("includehelp.com\b\b\bOk\n");
                                            }'));
            // $question=nl2br(htmlspecialchars("<sometext
            // >"));
            $option=array('Optio','Cumique','Mollitia','Repellat');
            ?>
<!-- <div class="question-wrap"> -->
            <div class="question-container" id="question-container<?php echo $i?>">
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
                            <input onchange="console.log('response changed')" type="radio" name="answer<?php echo $i?>" id="option<?php echo $i?>a">
                            <label for="option<?php echo $i?>a">
                                <?php echo $option[$j]?>
                            </label>
                        </div>
                        <?php endfor ?>

                    </div>


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
    <button onclick="timeOver()">END TEST</button>

</body>






<link rel="stylesheet" href="./test-style.css" type="text/css">
<script src="./test-functions.js"></script>

</html>