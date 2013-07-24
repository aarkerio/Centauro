<html>
<head>
  <title>Uploading a file</title>
</head>
<body>
<div style="margin:0 auto; border:1px solid orange;width:500px;padding:15px">

<form enctype="multipart/form-data" action="upload_2.php" method="post">
<input type="hidden" name="username" value="pobrecito_hablador" />
<h2>Uploading a file</h2>

Choose a file to upload:
<input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />

</form>
</div>
</body>
</html>
