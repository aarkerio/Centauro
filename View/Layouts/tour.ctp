<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head><title><?php echo $title_for_layout?></title>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

body {
background: orange;
margin: 10px;
padding: 0px;
font-size: 10pt; 
font-family: Verdana, Arial;
}
a {
color: #3f5673;
font-size: 11pt;
text-decoration:none;
text-align:left;
}

#wrapper {
border:1px solid black;
margin:0 auto 0 auto;
max-width:900px;
background-color: white;
padding:0;
vertical-align:top;
}

img {border:0;text-align:center;}

#headerimg {
    width: 900px;
    height:220px;
    background:url(/img/static/blog-bg-default.jpg);
    margin:0;
    padding:0;
    vertical-align:top;
}

#titulo a {
font-size: 19pt;
float: left;
color: white;
font-weight: bold;
margin:30px 0 0 30px;
  padding:30px 0 15px 0;
}
  
#frase {
  float: left;
font-size: 11pt;
text-align: left;
color: white;
font-weight: bold;
margin-left:60px;
}
#avatar {
text-align: justify;
margin-left:auto;
margin-right:auto;
width:auto;
padding:3px;
font-weight:bold;
font-size:8pt;
font-family:courier;
}

.cuerpo_comentario{
font-size:11pt;
}

.entrada_permalink {
padding-top:10px;
margin-left:0;
margin-bottom:30px;
}
</style>

</head>
<body id="cuerpo">
  <div id="tdmain">
        <?php echo $content_for_layout ?>
  </div>
</body>

</html>

