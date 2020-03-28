<?php
require_once "../config/db.php";

$message='failed';
    $email=$_REQUEST['email'];
    $result=mysqli_query($conn,"SELECT * FROM approved WHERE email='$email' ORDER BY id DESC LIMIT 1");
    $row=mysqli_fetch_array($result);
    $name=$row['name'];
    $username=$row['username'];
    $password=$row['password'];
    $to=$row['email'];
    $mail1=$row['mail1'];
    $id=$row['id'];

    $body=file_get_contents("../mail-templates/register-success/application-confirmed1.html");
    $body.=" ".$name;
    $body.=file_get_contents("../mail-templates/register-success/application-confirmed2.html");
    $body.=" ".$username;
    $body.=file_get_contents("../mail-templates/register-success/application-confirmed3.html");
    $body.=" ".$password;
    $body.=file_get_contents("../mail-templates/register-success/application-confirmed4.html");

    $subject = 'Thanks for registering for Techchef';
    $from = 'techchefbymicrobird@gmail.com';
    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    // Create email headers
    $headers .= 'From: Team Techchef <'.$from.'>'."\r\n";
    // $headers.='Reply-To: '.$from."\r\n";
    $headers.='X-Mailer: PHP/' . phpversion();
    
    // Compose a simple HTML email message
    // $message = '<html><body>';
    // $message .= '<h1 style="color:#f40;">Hello!</h1>';
    // $message .= '<p style="color:#080;font-size:18px;">How are you? I am techchefbymicrobird again</p>';
    // $message .= '</body></html>';
    
    // Sending email
    


    if(mail($to, $subject, $body, $headers))
    {
        $mail1+=1;
        $sql = "UPDATE approved SET mail1='$mail1' WHERE id='$id'";
        if($conn->query($sql)===TRUE)
        $message="success";
    }



echo $message;
?>