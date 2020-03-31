<?php
session_start();
require_once "../../../resources/config/db.php";
// check if already logged in
if((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])=="tc-candidate")
{
    header("Location: test.php"); 
    exit();
}

// $password="deepak";
date_default_timezone_set('Asia/Kolkata');
$time=strtotime('now');

$settings=file_get_contents("../config/settings.json");
$settings= json_decode($settings,true); //converts json to array
$test_end_time=strtotime($settings['test-end-time']);
$test_start_time=strtotime($settings['test-start-time']);


$username='d';
$password='d';


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


    // session should carry id to end test

   if($user['issubmitted']==1)
{
    unset($_SESSION['loggedin']);
    header("location: index.php?m=submitted");
    exit();
}
  if($user['isstarted']==1)
    {  
        //  $t=strtotime('now');
       $_SESSION['remaining-time']=(strtotime($user['end'])-$time);
        if($_SESSION['remaining-time']<0){
            // unset($_SESSION['loggedin']);
            // header("location: index.php?m=submitted");
            echo $_SESSION['remaining-time'].'='.$user['end'].'-'.date('d/m/Y h:i:sa l',$time);

            exit();
        }
        else{
            header("location: test.php?m=continue");
            exit();
        }
    }
    header("location: test.php");
    exit();
    // echo $_SESSION['time-remaining'];
}




// if already logged 

    //check remaining-time
        // if has time: redirect to test
        // if has no time: redirect to test-summary.php time test is over (not possible though)
    // already submitted: reditect to test-summary.php with message submitted-already
// if record matches
// set session
// else wrong-pass



//if questions are not assigned
// assign questions 

// session_start();
// if(!(((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])=="tc-candidate") || (isset($_REQUEST['password'])&&($_REQUEST['password']==$password))))
// {header("Location: index.php"); 

//     exit();
// }
// else
// {
    // $_SESSION['loggedin']="tc-candidate";
    // $_SESSION['username']="TC-CANDIDATE";
    // // session should carry id to end test

    // header("location: test.php");
    // exit();


// }

?>