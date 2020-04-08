<?php
session_start();
if (!((isset($_SESSION['adminloggedin']))&& $_SESSION['adminloggedin']=="tc-admin")) {
header("Location: index.php");
}

require_once "../../../resources/config/db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Candidates</title>
</head>
<body>


<table border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>College</td>
        </tr>
    


    <?php 

        $result=mysqli_query($conn,"SELECT * FROM registrations" );
        while($user=mysqli_fetch_array($result)){
        echo '
            <tr> 
            <td>'.$user['id'].'</td>
            <td>'.$user['name'].'</td>
            <td>'.$user['email'].'</td>
            <td>'.$user['phone'].'</td>
            <td>'.$user['college'].'</td>
            </tr>';

        }

    ?>
</body>
</html>




<style>

        td{
            border-right:solid white 1px;
            padding-right:5px;
            padding-left:5px;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:nth-child(1) {background-color: #888888 !important;
        font-weight: bolder;}
        /* tr:nth-child(even) {background-color: white !important;} */
        tr:nth-child(odd) {background-color: #c2c2c2;}

</style>
