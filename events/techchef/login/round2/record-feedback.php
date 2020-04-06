<?php

require_once "../../../../resources/config/db.php";
    if(isset($_REQUEST['feedback']) && isset($_REQUEST['id']))
    {
 $feedback=$_REQUEST['feedback'];

 $user_id=$_REQUEST['id'];

 $sql = "UPDATE registrations SET feedback2='$feedback' WHERE id='$user_id'";
 $conn->query($sql);
 if ($conn->query($sql) === TRUE)
 header("location: index.php");
}

header("location: index.php");
?>