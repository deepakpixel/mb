<?php
    $email=$_REQUEST['email'];
    $key='private_ee93a9a18a0d5cfa5ad58f67ec47b383';
    $params = array(
    "key" => $key,
    // "email" => $eamil,
    "email" => $email      //remember the comma (,) if uncommented below
    // "id" => $id,
    // "url" => $url,
    // "mails_sent" => $mails_sent
    );
    $url='https://api.neverbounce.com/v4/single/check';
    // send mail request to particular api  

    $postData = '';
    //create name value pairs seperated by &
    foreach($params as $k => $v) 
    { 
        $postData .= $k . '='.$v.'&'; 
    }
    $postData = rtrim($postData, '&');
    
    $ch = curl_init();  
    
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    // curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

    $output=curl_exec($ch);

    curl_close($ch);
    var_dump($output);
    // echo $output;
    // var_dump($output['result']);
    $output=json_decode($output,true);
    var_dump($output);

    echo $output['result'];

    ?>