<?php 
ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
$upload = 'err'; 
if(!empty($_FILES['file'])){ 
    
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
// unset($_SESSION['message']);
header('location: test.php?m='.$upload);
// echo $upload; 
?>