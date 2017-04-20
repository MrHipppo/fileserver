<?php
$target_dir = "masteruploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  // if(file_exists($target_file))
//	{
//		$target_file= $target_file.".1"
//		echo"File has been renamed to: ".$target_file;
//	} 
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.\n ";
	$logfile=fopen("logs/LOGFILE.log","a+") or die ("ERROR: 100  Unable to open LOGFILE please contact a system Administrator\n");
//	$log = basename($_FILE["fileToUpload"]["name"]);
	echo "<br>";
	fwrite($logfile ,"UPLOAD: ". basename($_FILES["fileToUpload"]["name"])." ".date("d-m-Y : h:i:s A")."\n");
	fclose($logfile);
	
    } else {
        echo "ERROR: 101  Unable to upload file, please contact a system administrator.";
	$error = fopen("logs/ERRORLOG.log", "a+") or die ("ERROR: 100 Unable to open ERRORLOG please contact a system Administrator\n");
//	$text = "ERROR: Unable to Upload Document".date("d-m-Y : h:i:s A)"."\n";
	fwrite ($error, "ERROR: 101  Unable to Upload file"." ".date("d-m-Y : h:i:s A")."\n");
	fclose($error);
    }
?>
<html>
	<body>
		<br>
		<a href="uploadIndex.php">Zurück</a>
	</body>
</html>

