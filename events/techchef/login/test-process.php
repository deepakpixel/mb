<?php

require_once "../../../resources/config/db.php";

date_default_timezone_set('Asia/Kolkata');


$settings=file_get_contents("../config/settings.json");
$settings= json_decode($settings,true); //converts json to array

$total_time=$settings['total-test-time'];

$id=$_REQUEST['id'];

if(isset($_REQUEST['message']) && $_REQUEST['message']=="warn")
{   
    $warntime=date('d/m/y h:i:s a',time());
    $user=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id'" );
    $user=mysqli_fetch_array($user);
    if($user['comment']=="warned")
    {echo "warn2";
    exit();
    }
    else
    $sql = "UPDATE registrations SET comment='warned', warntime='$warntime' WHERE id='$id'";
    if ($conn->query($sql) === TRUE)
    {
        echo "warned";
    } 

}


if(isset($_REQUEST['action']))
{
    if($_REQUEST['action']=="cheating")
    {   
        // mark cheated
        // echo "cheated";
        $endtime=date('d/m/y h:i:s a',time());
        $temp=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id'" );
        $temp=mysqli_fetch_array($temp);
        $timetaken=(time()-$temp['start'])/60;
        $sql = "UPDATE registrations SET issubmitted=1,comment='suspicious',endtime='$endtime',timetaken='$timetaken' WHERE id='$id'";
        if ($conn->query($sql) === TRUE)
        {
            echo "cheated";
        } 

        exit();
    }

    if($_REQUEST['action']=="start")
    {   $start=strtotime('now');
        $end=$start+($total_time*60);
        $starttime=date('d-M-Y h:i:sa l',$start);
        $sql = "UPDATE registrations SET isstarted=1 , start='$start', starttime='$starttime' , end='$end' WHERE id='$id'";
            if ($conn->query($sql) === TRUE)
            {
                echo "started";
            }
        exit();
    }

    if($_REQUEST['action']=="end")
    {
        $endtime=date('d/m/y h:i:s a',time());
        $temp=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id'" );
        $temp=mysqli_fetch_array($temp);
        $timetaken=(time()-$temp['start'])/60;
        $sql = "UPDATE registrations SET issubmitted=1,endtime='$endtime',timetaken='$timetaken' WHERE id='$id'";
        if ($conn->query($sql) === TRUE)
        {
            echo "submitted";
        } 
        exit();

    }
}

if(isset($_REQUEST['newans']))
{

// echo "newanset";
$qno=$_REQUEST['qno'];
$newans=$_REQUEST['newans'];
$user=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id'" );
$user=mysqli_fetch_array($user);

$responses=$user['responses'];
$responses[$qno]=$newans;


$sql3 = "UPDATE registrations SET responses='$responses' WHERE id='$id'";
if ($conn->query($sql3) === TRUE)
{   $d="$qno $newans $id :qno newans id";
    $sql = "INSERT INTO logs (description) VALUES('$d')";
    if ($conn->query($sql) === TRUE)
        echo "response-changed";
}
}
// check if asking for start
// check if in time
    // update the answer using id


?>