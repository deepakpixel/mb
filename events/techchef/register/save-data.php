<?php
require_once "../../../resources/config/db.php";

$message="default";


$name=strtoupper(($_REQUEST["name"]));
$name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);

$email=strtolower($_REQUEST["email"]);

$phone=$_REQUEST["phone"];
$phone = preg_replace("/[^0-9\s]/", "", $phone);

$college=strtoupper($_REQUEST["college"]);
$college = preg_replace("/[^a-zA-Z0-9\s]/", "", $college);


// college
if(!strlen($college))
$message="nocollege";
 

// invalid phone
$phone_sanitized = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);

if(strlen($phone_sanitized)!==10)
$message="invalidphone";


// phone
if(!strlen($phone))
$message="nophone";
 

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);


// Validate e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $message="invalidemail";

    }


//Check if email is filled
if(!strlen($email))
$message="noemail";
 

//Check if name is filled
if(!strlen($name))
$message="noname";
 

// if($message!="noname" && $message!="noemail" && $message!="nocollege" && $message!="nophone" && $message!="invalidphone" && $message!="invalidemail")
// $message=="default";

if($message=="default")
{
        $output="abc";
        // sleep(5);
        $key='private_ee93a9a18a0d5cfa5ad58f67ec47b383';
        $url='https://api.neverbounce.com/v4/single/check';
        $postData = 'key='.$key.'&email='.$email;
        $ch = curl_init();  
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($ch,CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
        $output=curl_exec($ch);
        curl_close($ch);
        $output=json_decode($output,true);
        if($output['result']=="invalid")
        $message="emailbounce";
        else{    
            
            date_default_timezone_set('Asia/Kolkata');
            $t=strtotime('now');
            $regtime=date("d/m/Y h:ia l",$t);
            $last_id=mysqli_query($conn,"SELECT * FROM registrations ORDER BY id DESC LIMIT 1");
            $last_id=mysqli_fetch_array($last_id);
            // starting id for first entry
            if($last_id==NULL)
                $id=1;
            else
                $id=$last_id['id']+1;
            $username =strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $name));
            $password="techchef@".$id;
            $sql = "INSERT INTO registrations (name,email,phone,college,username, password,regtime,regfor) VALUES('$name', '$email','$phone', '$college','$username', '$password','$regtime','techchef2020')";

            if ($conn->query($sql) === TRUE) {


                $body=file_get_contents("../../../resources/mail-templates/techchef-register-success.html");
                $body=str_replace("{%name%}",$name,$body);
                $body=str_replace("{%username%}",$username,$body);
                $body=str_replace("{%password%}",$password,$body);
                $subject = 'Thanks for registering for Techchef';
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: Team Techchef <hello@microbird.club>'."\r\n";
                // $headers.='Reply-To: '.$from."\r\n";
                $headers.='X-Mailer: PHP/' . phpversion();
                

 
                    if(mail($email, $subject, $body, $headers)){
                        // $mail1+=1;
                        $sql = "UPDATE registrations SET wcmail='1' WHERE id='$id'";
                        if($conn->query($sql)===TRUE)
                        $message="success";
                    }
                $message="success";
            } else {
                $message="uploadfailed";
            }
        }
}

$d=$_REQUEST['name'].'  '.$_REQUEST['email'].'  '.$_REQUEST['phone'].'  '.$_REQUEST['college'];
$sql = "INSERT INTO logs (description) VALUES('$d')";

if ($conn->query($sql) === TRUE)
echo $message;
else
echo $message;
?>