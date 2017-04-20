<?php
ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script
$file = $_POST['fileToDownload'];
$path = "/var/www/html/masteruploads/$file"; // change the path to fit your websites document structure
if ($path == "/var/www/html/masteruploads/")
	{
		echo"ERROR: 102  No file selected, please select a file you want to Download!\n";
		$error = fopen("logs/ERRORLOG.log" ,"a+") or die ("ERROR: 100  Unable to open  ERRORLOG please contact a system Administrator\n");
//		$text = "ERROR: Download without file selected".date("d-m-y : h:i:s");
		fwrite($error,"ERROR: 102  Download without file selected"." ".date("d-m-Y : h:i:s A")."\n");
		fclose($error);	
	} 
else{
$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $_GET['download_file']); // simple file name validation
$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
$fullPath = $path.$dl_file;
 
if ($fd = fopen ($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
        break;
        // add more headers for other content types here
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
        break;
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
$download = fopen("logs/LOGFILE.log", "a+") or die ("ERROR: 100  Unable to open LOGFILE please contact a system Administrator\n");
fwrite($download, "DOWNLOAD: ".$file." ".date("d-m-Y : h:i:s A")."\n");

fclose ($fd);
}
