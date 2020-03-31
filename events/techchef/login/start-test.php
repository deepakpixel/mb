<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

require_once "../../../resources/config/db.php";

$settings=file_get_contents("../config/settings.json");
$settings= json_decode($settings,true); //converts json to array
$total_time=$settings['total-test-time'];
$total_questions=$settings['total-questions'];

$id=$_SESSION['id'];
   $start=strtotime('now');
     $end=$start+($total_time*60);
     $starttime=date('d-M-Y h:i:sa l',$start);
     $responses='r';
     $responses[0]='s';

     for($i=1;$i<=$total_questions;$i++)
     {
        $responses[$i]='-';
     }
     $sql = "UPDATE registrations SET isstarted=1 , start='$start', starttime='$starttime' , end='$end',responses='$responses' WHERE id='$id'";
         if ($conn->query($sql) === TRUE)
         {
           
            $_SESSION['isstarted']=1;
            $_SESSION['end']=$end;
            $_SESSION['start']=$start;

            
            $_SESSION['remaining-time']=$end-time();

        
            header("location: test.php");
         }
   
 


?>