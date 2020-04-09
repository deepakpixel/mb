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
echo '<table>
    <tr>
    <td>Round 2 uploads:</td>
    </tr>';
$files = scandir('../uploads/');
// $firstpart=$_SESSION['id'].'-'.$_SESSION['username'].'-';
foreach($files as $file) {

    if($file!=".."&&$file!="."&&$file!=".htaccess")
    echo '<tr><td>'.$file.'</td></tr>';

}

echo '</table>';




?>
    <br>
    <button class="btn btn-primary" onclick="window.location.href='download-round2.php'">Download ZIP</button>

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
