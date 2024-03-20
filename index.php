<?php
$file = $_GET['file'];
//$file = "a.out";
function file_down($filepath, $file_name = ''){
    set_time_limit(0);

    if (!$file_name){
        $file_name = basename($filepath);
    }

    $filesize = filesize($filepath);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . $filesize);
    header('Content-Disposition: attachment; filename=' . $file_name);

    $index = 0;
    $read_buffer = 4096;
    $fp = fopen($filepath, 'rb');
    while(!feof($fp)) {
        echo fread($fp, $read_buffer);
        $index++;

        if ($index % 1024 == 0){
            ob_flush();
            flush(); 
        }
    }
    fclose($fp);
}
file_down('./'.$file,'./'.$file);
