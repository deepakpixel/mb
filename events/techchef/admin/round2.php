<?php
session_start();
if (!((isset($_SESSION['adminloggedin']))&& $_SESSION['adminloggedin']=="tc-admin")) {
header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/litera/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Round 2 submissions</title>
</head>

<body>
<div class="container">
<?php 
// Create ZIP file
if(isset($_REQUEST['download'])){
  $zip = new ZipArchive();
  $filename = "TechChefRound2.zip";

  if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
  }

  $dir = '../uploads/';

  // Create zip
  createZip($zip,$dir);

  $zip->close();

//   download

  if (file_exists($filename)) {
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Content-Length: ' . filesize($filename));

    flush();
    readfile($filename);
    // delete file
    unlink($filename);
  }



}

// Create zip
function createZip($zip,$dir){
  if (is_dir($dir)){

    if ($dh = opendir($dir)){
       while (($file = readdir($dh)) !== false){
 
         // If file
         if (is_file($dir.$file)) {
            if($file != '' && $file != '.' && $file != '..'){
 
               $zip->addFile($dir.$file);
            }
         }else{
            // If directory
            if(is_dir($dir.$file) ){

              if($file != '' && $file != '.' && $file != '..'){

                // Add empty directory
                $zip->addEmptyDir($dir.$file);

                $folder = $dir.$file.'/';
 
                // Read data of the folder
                createZip($zip,$folder);
              }
            }
 
         }
 
       }
       closedir($dh);
     }
  }
}

// Download Created Zip file
// if(isset($_POST['download'])){
 
//   $filename = "TechChefRound2.zip";

//   if (file_exists($filename)) {
//      header('Content-Type: application/zip');
//      header('Content-Disposition: attachment; filename="'.basename($filename).'"');
//      header('Content-Length: ' . filesize($filename));

//      flush();
//      readfile($filename);
//      // delete file
//      unlink($filename);
 
//    }
// }


// show all files

echo '<table>
    <tr>
    <td>Round 2 uploads:</td>
    </tr>';
$files = scandir('../uploads/');
// $firstpart=$_SESSION['id'].'-'.$_SESSION['username'].'-';
foreach($files as $file) {

    if($file!=".."&&$file!=".")
    echo '<tr><td>'.$file.'</td></tr>';

}

echo '</table>';




?>
<form method="post" action="round2.php">
    <br>
<button class="btn btn-primary" type="submit" name="download">Download zip</button>
</form>


<style>

        td{
            border-right:solid white 1px;
            padding-right:5px;
            padding-left:5px;
            width:80vw;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:nth-child(1) {background-color: #888888 !important;
        font-weight: bolder;}
        /* tr:nth-child(even) {background-color: white !important;} */
        tr:nth-child(odd) {background-color: #c2c2c2;}

</style>

        </div>
        </body>
        </htmt>