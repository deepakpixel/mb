<?php
require_once "../../../resources/config/db.php";

date_default_timezone_set('Asia/Kolkata');


$settings=file_get_contents("../config/settings.json");
$settings= json_decode($settings,true); //converts json to array

$total_time=$settings['total-test-time'];

$id=$_REQUEST['id'];
if(isset($_REQUEST['action']))
{
    if($_REQUEST['action']=="cheating")
    {   
        // mark cheated
        echo "cheated";
        exit();
    }

    if($_REQUEST['action']=="start")
    {   $start=strtotime('now');
        // $start=date('d-M-Y h:i:s',$time);
        $end=$start+($total_time*60);
        // $end=date('d-M-Y h:i:s',$time2);
        $sql = "UPDATE registrations SET isstarted=1 , start='$start' , end='$end' WHERE id='$id'";
            if ($conn->query($sql) === TRUE)
             echo "started";
        // update start time

        exit();
    }

    if($_REQUEST['action']=="end")
    {
        
        echo "submitted";
        exit();

    }
}
// check if asking for start
// check if in time
    // update the answer using id
echo "response-changed";

?>