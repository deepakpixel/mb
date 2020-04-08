<?php
require_once "../../../resources/config/db.php";
$settings=file_get_contents("../config/settings.json");
$settings=json_decode($settings,true);
$result=mysqli_query($conn,"SELECT * FROM registrations WHERE isstarted=1");
$total_questions=$settings['total-questions'];

// $user=mysqli_fetch_array($result);
while($user=mysqli_fetch_array($result))
{   $score=0;
    $responses=$user['responses'];
    $set_number=$responses[0];

    for($i=1;$i<=$total_questions;$i++)
    {
    $qno=$settings['set'.$set_number]['q'.$i.'-id'];

    echo $qno.' '.$responses[$i]; //responses[i] contains the answerprovided by user
    
    $qna=mysqli_query($conn,"SELECT * FROM questions WHERE qno='$qno'");
    $qna=mysqli_fetch_array($qna);

    $answer=$qna['answer']; //answer contains the correct answer
    echo $answer.' ';
    if($responses[$i]==$answer)
    $score+=1;
    // var_dump($answer);
    // compare with the answer

    }
    // echo $user['responses'];
    $id=$user['id'];
    $score=mysqli_query($conn,"UPDATE registrations SET score1='$score' WHERE id='$id'");
    echo '<br>';
    

}

?>