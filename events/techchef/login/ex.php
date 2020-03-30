<?php
require_once "../../../resources/config/db.php";

$username='d';
$password='d';
date_default_timezone_set('Asia/Kolkata');


$user=mysqli_query($conn,"SELECT * FROM registrations WHERE username='$username' AND password='$password'" );
if(mysqli_num_rows($user)!=1)
{header("location: index.php?m=incorrect");
    exit();
}
else
{       
    $user=mysqli_fetch_array($user);

  
    
    $_SESSION['loggedin']='tc-candidate';
    $_SESSION['username']=$user['username'];
    $_SESSION['name']=$user['name'];
    $_SESSION['id']=$user['id'];

echo $user['isstarted'];
    // session should carry id to end test
  if($user['isstarted']==1)
    {  
         $time=strtotime('now');
       $_SESSION['remaining-time']=(strtotime($user['end'])-$time);
    //    header("location: test.php?m=continue");
        // exit();
        var_dump($_SESSION);
        print_r($user);
    }
    // header("location: test.php");
    // exit();
}
