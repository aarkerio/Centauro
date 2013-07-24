<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
            "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>::My Web application::</title>

<style type="text/css"><!--
body {
  background-color: #a1c936;
  color: #a52;
  font-size: 11pt;
  font-family: Verdana, Arial, SunSans-Regular, Sans-Serif;
}
.caja{
font-size:9pt;
background-color:#dff89c;
border:1px solid gray;
}
#foto {
 width:425px;
 float:left;
 margin:0;
}
-->
</style>

</head>
<body>

<div style="margin:20px auto;width:590px;padding:8px;background-color:#fff;border:1px solid black;float:center;">
<div id="foto">
   <img src="img/my_app.jpg" width="425" height="340" alt="My App" title="My App" /> 

</div>

<div style="width:auto;float:right;margin:10px;padding:0;font-size:9pt;text-align:left;">

<form action="inc/valida.inc.php" method="post">
Username: <br />
<input type="text" name="username" size="15" maxlength="20" class="caja" /><br />
Contrase&ntilde;a: <br />
<input type="password" name="passwd" class="caja" size="9" maxlength="9" /><br />

<input type="submit" value="Enviar" class="caja" />  
</form>
</div>
<div style="clear:both;"></div>

<div style="margin:60px;border-top:1px solid black;font-size:8pt;">
My Web application &copy; GPL 2007
</div>
</body>
</html>
