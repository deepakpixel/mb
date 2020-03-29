<?php
$password="deepak";

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

session_start();
if(!(((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])=="tc-candidate") || (isset($_REQUEST['password'])&&($_REQUEST['password']==$password))))
{header("Location: index.php"); 
}
else
{
    $_SESSION['loggedin']="tc-candidate";
    $_SESSION['username']="TC-CANDIDATE";
    // session should carry id to end test

    header("location: test.php");


}

?>