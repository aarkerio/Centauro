<?php
# die(debug($this->params));
   echo '<?xml version="1.0"?>'; 
   echo $this->Html->docType();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Despabilando la.. :: <?php echo $title_for_layout; ?> </title>
<link rel="shortcut icon" href="http://www.mononeurona.org/favicon.ico" />
<?php echo $this->Html->css('printing'); ?>
</head>
<body>
<table id="maintable" style="border:1px solid gray; width:95%;margin-left:auto;margin-right:auto;">
<!--Primer renglon--> 
<tr id="arriba"> 
      <td class="columnatop">Despabilando la MonoNeurona::Internet es de todos <a href="/">[Inicio]</a> <a href="javascript:history.go(-1)">[Regresar]</a></td>
</tr>

<!--Renglon del contenido-->
  <tr>
  <td class="columnacuerpo"> 
      <?php echo $content_for_layout; ?>
      <br />
      <br />
    <div style="margin-right:auto;margin-left:auto;width:200px;">
     <?php  echo $this->Html->link($this->Html->image('static/top.png', array('alt'=>"ir arriba", 'title'=>"ir arriba")), '#maintable',  array('escape'=>False)); ?>
    </div>
  </td>
</tr>
<tr><td id="footer">
    <span class="liga">Este trabajo est&aacute; licenciado bajo la <a style="font-size:7pt" href="/pages/display/783">MonoNeurona Commons License</a>. 2002-2010 &copy; :: Colectivo MonoNeurona.org ::</span>
</td></tr>
</table>
<div style="margin:20px auto 20px auto;width:800px;text-align:center;">
<?php
   echo $this->Html->link($this->Html->image("static/debian-80x15.gif", array('alt'=>"The Queen is here", 'title'=>"The Queen is here")), 
        'http://www.debian.org/',  array('escape'=>False)) . "&nbsp;";

   echo $this->Html->link($this->Html->image("static/firefox-80x15.png", array('alt'=>"Mozilla Firefox", 'title'=>"Mozilla Firefox")), 
        'http://www.mozilla.org/products/firefox/',  array('escape'=>False)) . "&nbsp;";
   
   echo $this->Html->link($this->Html->image("static/pgsql-80x15.png", array('alt'=>"The Best DataBase", 'title'=>"The Best DataBase")), 
        'http://www.postgresql.org/',  array('escape'=>False)) . "&nbsp;";
   
   echo $this->Html->link($this->Html->image("static/cakephp-80x15.png", array('alt'=>"CakePHP Framework", 'title'=>"CakePHP Framework")), 
        'http://www.cakephp.org/',  array('escape'=>False)) . "&nbsp;";
   
   echo $this->Html->link($this->Html->image("static/css-80x15.png", array('alt'=>"CSS", 'title'=>"CSS")), 
        'http://www.w3.org/Style/CSS/',  array('escape'=>False)) . "&nbsp;";
   
   echo $this->Html->link($this->Html->image("static/hacker-80x15.png", array('alt'=>"GNU Hacker", 'title'=>"GNU Hacker")), 
                          'http://www.fsfla.org/', array('escape'=>False));
   
?>

</div>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-72189-1";
urchinTracker();
</script>

</body>
</html>