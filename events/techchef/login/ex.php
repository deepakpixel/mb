<?php
session_start();
$settings=file_get_contents("../config/settings.json");
$settings= json_decode($settings,true); //converts json to array


var_dump($_SESSION);
$_SESSION['set-number']=3;
// session_destroy();
// $responses=array(
//     "name"=>"deepak"
// );
// $responses["email"]="email@fds.f";
// // $responses["name"]="deepak";
// $t="n"."a".""."me";
// echo $responses[$t][0];
$i=1;
$set_number=$_SESSION['set-number'];
$qid=$settings['set'.$set_number]['q'.$i.'-id'];
echo $qid;

?>





