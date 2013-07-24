<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>CKEditor GeSHi Example</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script type="text/javascript" src="ckeditor.js"></script>
</head>
<body>
	<h1>CKEditor GeSHi Example</h1>

	<textarea name="editor1"></textarea>

<script type="text/javascript">//<![CDATA[
    CKEDITOR.config.customConfig = './GeSHiConfig.js';
    CKEDITOR.replace( 'editor1' );

//]]></script>
</body>
</html>
