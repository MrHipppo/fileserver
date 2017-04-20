<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>
<div>
<form action="download.php" method="post">
   	<br>
	 Select file to download:
	<br>
	<div>
	<?php
		$file= scandir("masteruploads/");
		foreach($file as $datei)
			{
				if($datei =="." || $datei == "..")
				{
				}
				else{
				echo $datei;
				echo "</br>";
				}
			}
	?>
	</div>
File to Download: <input type="text" name="fileToDownload"></br>
<input type="submit" value="Download File">
</form>
</div>
</body>
</html>

