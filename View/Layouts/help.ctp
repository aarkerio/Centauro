<?php
    echo '<?xml version="1.0"?>';
    echo $this->Html->docType();
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head><title>Centauro :: <?php echo $title_for_layout?></title>

<?php
if ( isset($javascript) ):
  echo $this->Html->charset('UTF-8');
  echo $this->Html->script('prototype');
  echo $this->Html->script('scriptaculous.js?load=effects');
endif;
?>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
img{border:0}
body {
background:#fff url(/img/static/help_bg.png) top repeat-x; 
margin:3pt;font-family: Arial, Verdana, Helvetica, Tahoma;}
.title_section {
 color:#cc0033;
 border-bottom:dotted 1px gray;
 font-size:12pt;
 margin:7px 0 7px 0;
 padding:3px;
 font-fasmily:verdana;
}
.der {text-align:right;font-weight:bold;font-size:9pt;}
#container {text-align:left;font-size:10pt;width:350px;margin-left:auto;margin-right:auto;}
.titulo {border-bottom:1px #268698 solid; padding:5px;color:#268698;font-size:16pt;}
#marco {border:1px grey solid;padding:5px;color:#268698;background-color:#dadada;font-size:10pt;width:80%;margin:5px auto 2px auto;}
.warning {color:red;font-size:10px;text-align:left;}
button {background-color:orange;color:#fff;border:1px solid gray;font-size:8pt;padding:5px;}
input {background-color:#eda2bb;color:#000;border:1px solid gray;font-size:7pt;padding:1px;}
-->
</style>
</head>
<body id="cuerpo">
        <?php echo $content_for_layout ?>
<br />
<?php echo $this->Html->link($this->Html->image('static/help.gif', array("alt"=>"Help index")), '/helps/index', null, null, false); ?>
</body>

</html>

