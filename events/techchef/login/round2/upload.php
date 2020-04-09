<?php 
$upload = 'err'; 
if(!empty($_FILES['file'])){ 
    echo 'gotit';
    // File upload configuration 
    $targetDir = "../../uploads/"; 
    // $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
     
    $fileName = basename($_FILES['file']['name']); 
    $targetFilePath = $targetDir.$_REQUEST['id'].'-'.$_REQUEST['username'].'-'.$fileName;
    if(($_FILES['file']['size'])<20000000)
    {
        if (file_exists($targetFilePath))
        $upload = 'duplicate';
        else
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
            $upload = 'ok'; 
        } 
    }
    else
    $upload='largefile';
    // }
}
echo $upload; 
?>