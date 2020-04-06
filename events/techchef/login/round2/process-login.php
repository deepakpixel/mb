<?php
session_start();
require_once "../../../../resources/config/db.php";
// check if already logged in
if((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])=="tc-candidate" && isset($_SESSION['hints-used']))
{          
            header("Location: test.php"); 
            exit();
}

// $password="deepak";
date_default_timezone_set('Asia/Kolkata');
$time=strtotime('now');
$time=time();

$settings=file_get_contents("../../config/settings.json");
$settings= json_decode($settings,true); //converts json to array
$test_end_time=strtotime($settings['round2-end-time']);
$test_start_time=strtotime($settings['round2-start-time']);

// check if test is not expired
if($time>$test_end_time)
{header("location: index.php?m=expired");
exit();
}
if($time<$test_start_time)
{header("location: index.php?m=early");
exit();
}

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];


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
    // $_SESSION['end']=$user['end'];
    // $_SESSION['start']=$user['start'];
    // $_SESSION['isstarted']=$user['isstarted'];
    
    // $_SESSION['issubmitted']=$user['issubmitted'];
    // $r=$user['responses'][0];
    // $_SESSION['set-number']=$r;
    if($user['problemassigned']==0)
    {
    $probs=mysqli_query($conn,"SELECT * FROM problemstatements");
    $probs=mysqli_num_rows($probs);
    
    $prob=rand(1,$probs);
    $_SESSION['problem-assigned']=$prob;
    $id=$user['id'];
    $probs=mysqli_query($conn,"UPDATE registrations set problemassigned='$prob' WHERE id='$id'");

    }
    else
    $_SESSION['problem-assigned']=$user['problemassigned'];

    // ********************************************************************************************************************************
    $_SESSION['hints-used']=1;
    
    // session should carry id to end test

//    if($user['issubmitted']==1)
// {
//     unset($_SESSION['loggedin']);
//     unset($_SESSION['isstarted']);
//     unset($_SESSION['issubmitted']);
//     unset($_SESSION['start']);
//     unset($_SESSION['end']);
//     header("location: index.php?m=submitted");
//     exit();

// }
// $_SESSION['remaining-time']=($user['end'])-$time;

//   if($user['isstarted']==1)
//     {  
//         //  $t=strtotime('now');
//        $_SESSION['remaining-time']=($user['end'])-$time;
//         if($_SESSION['remaining-time']<0){
//             // date_default_timezone_set('Asia/Kolkata');

//             unset($_SESSION['loggedin']);
//             unset($_SESSION['isstarted']);
//             unset($_SESSION['issubmitted']);
//             header("location: index.php?m=submitted");
//             // echo $_SESSION['remaining-time'];
//             // echo '<br>';
//             // echo 'hell'.strtotime($user['end']);
//             // echo 'hell'.time();
            
//             // echo strtotime('31march2020');;
//             // $exp= date('d-M-Y h:i:sa',time());
//             // echo strtotime($exp);
            
//             exit();
//         }
//         else{
//             header("location: test.php");
//             exit();
//         }
//     }
    header("location: test.php");
    exit();
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