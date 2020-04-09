<?php

function createZipAndDownload($files, $filesPath, $zipFileName)
{
    $zip = new \ZipArchive();
    if ($zip->open($zipFileName, \ZipArchive::CREATE) !== TRUE) {
        exit("cannot open <$zipFileName>\n");
    }

    // Adding every attachments files into the ZIP.
    foreach ($files as $file) {
        $zip->addFile($filesPath . $file, $file);
    }
    $zip->close();

    // Download the created zip file
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename = $zipFileName");
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile("$zipFileName");
    exit;
}

// Files which need to be added into zip
$dir = scandir('../uploads');
$files = array();
$i=0;
foreach($dir as $file){
    if($file[0]=='.')
    continue;
echo $file;
$files[$i]=$file;
$i++;
}

// $files = array('download.php', 'index.html', 'sitemap.xml');
// Directory of files
$filesPath = '../uploads/';
// Name of creating zip file
$zipName = 'TechChefRound2.zip';

echo createZipAndDownload($files, $filesPath, $zipName);