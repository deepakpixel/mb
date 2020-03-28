<?php
require_once "../../../resources/config/db.php";

$message="default";


$name=strtoupper(($_REQUEST["name"]));
$name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
// $username = preg_replace("/[^a-zA-Z0-9]/", "", $name);

$email=strtolower($_REQUEST["email"]);
$phone=$_REQUEST["phone"];
$phone = preg_replace("/[^0-9\s]/", "", $phone);
// $college=$_REQUEST["college"];
$college=strtoupper($_REQUEST["college"]);
$college = preg_replace("/[^a-zA-Z0-9\s]/", "", $college);


// $email = preg_replace('~[\\\\/#:*?"<>|]~', '', $email);

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
        $message="invalidemail";
        else{    
            
            // insert data into pending tablel
            // $sql = "INSERT INTO pending (name, email, phone, college) VALUES ('$name', '$email','$phone', '$college')";
            date_default_timezone_set('Asia/Kolkata');
            $t=strtotime('now');
            $regtime=date("d/m/Y h:ia l",$t);
            $last_id=mysqli_query($conn,"SELECT * FROM approved ORDER BY id DESC LIMIT 1");
            $last_id=mysqli_fetch_array($last_id);
            // starting id for first entry
            if($last_id==NULL)
                $id=1;
            else
                $id=$last_id['id']+1;
            $username =strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $name));
            $password="techchef@".$id;
            // $issent=1;
            // $issent=sendmail($email,$name,$username,$password);
            $sql = "INSERT INTO approved (name,email,phone,college,username, password,regtime) VALUES('$name', '$email','$phone', '$college','$username', '$password','$regtime')";

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
                


                // $url = 'https://api.sendgrid.com/v3/mail/send';
                // $api_key = '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';

                // $data='{"personalizations": [{"to": [{"email": "'.$email.'"}]}],"from": {"email": "hello@microbird.club","name":"Team Techchef"},"subject": "'.$subject.'",
                // "content": [{"type": "text/html", "value": "'.$body.'"}]}';
                // Initializes a new cURL session
                // $curl = curl_init($url);
                // // Set the CURLOPT_RETURNTRANSFER option to true
                // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                // // Set the CURLOPT_POST option to true for POST request
                // curl_setopt($curl, CURLOPT_POST, true);
                // // Set the request data as JSON using json_encode function
                // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                // // Set custom headers for RapidAPI Auth and Content-Type header
                // curl_setopt($curl, CURLOPT_HTTPHEADER, [
                // 'Authorization: Bearer '.$api_key.'',
                // 'Content-Type: application/json'
                // ]);
                // Execute cURL request with all previous settings
                // $response = curl_exec($curl);
                // Close cURL session
                // curl_close($curl);
                // echo $response;
                // var_dump($response);
                // var_dump($response,curl_error($curl),curl_getinfo($curl));





                // curl --request POST \
                //   --url https://api.sendgrid.com/v3/mail/send \
                //   --header "Authorization: Bearer $SENDGRID_API_KEY" \
                //   --header 'Content-Type: application/json' \
                //   $data='{"personalizations": [{"to": [{"email": "test@example.com"}]}],"from": {"email": "test@example.com"},"subject": "Sending with SendGrid is Fun","content": [{"type": "text/plain", "value": "and easy to do anywhere, even with cURL"}]}';
                
                
                
                
                if(mail($email, $subject, $body, $headers))
                {
                    // $mail1+=1;
                    $sql = "UPDATE approved SET mail1='1' WHERE id='$id'";
                    if($conn->query($sql)===TRUE)
                    $message="success";
                }
                                $message="success";
            } else {
                $message="uploadfailed";
            }
        }
}

// send mail
// $message="success";
echo $message;
// sleep(5);
// $issent=sendmail($email,$name,$username,$password);


?>