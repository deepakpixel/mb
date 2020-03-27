<?php
    // $command=$_REQUEST['command'];
    // execPrint($command);
    $output = shell_exec('/var/www/html/microbird-website/script.sh');
    // echo "<pre>$output</pre>";
    echo $result;

// function execPrint($command) {
// $result = array();
// exec($command, $result);
// // foreach ($result as $line) {
// // print($line . "\n");
// // }

// }

// Print the exec output inside of a pre element
?>