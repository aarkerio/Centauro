<?php
   echo '<?xml version="1.0"?>'; 
   echo $this->Html->docType();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<link rel="shortcut icon" href="/img/static/favicon.ico" />
<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
<?php 
echo $this->Html->css('cpanel');
echo $this->Html->charset();   # Defaults to UTF-8
echo '<title>Centauro::'. $title_for_layout.'</title>';
if ( isset($this->Js) ):
    echo $this->Html->charset('UTF-8');
    echo $this->Html->script(array('jquery-min', 'admin'));
endif; 
?>
</head>
 <body>
 <script type="text/javascript">
   window.onload = timedMsg;
</script>
<?php echo $this->Session->flash(); ?>
<div id="header">
<?php
  echo $this->Html->link('Control Panel',  '/admin/entries/start'). ' | ';
  echo $this->Html->link($this->Session->read('Auth.User.name_blog'), '/blog/'.$this->Session->read('Auth.User.username')); 
?> 
  Logged in as <strong><?php echo $this->Session->read('Auth.User.username'); ?></strong> |
     <strong><a href="/"><?php echo $_SERVER['SERVER_NAME']; ?></a></strong> 
<?php
    echo $this->Html->link('My Account',  '/admin/users/edit/'). ' | ';
    echo $this->Html->link('Logout',  '/users/logout'). ' | ';
           
    $o = str_replace('/', '-', $_SERVER['REQUEST_URI']);       
    $path = '/admin/helps/display/' . $o;
    $t="javascript:window.open('".$path."', 'blank', 'toolbar=no, scrollbars=yes,width=700,height=400')";
           
    echo $this->Html->link($this->Html->image('static/help-icon.png', array('alt'=>'Help', 'title'=>'Help', 'class'=>'helping')), 
                           '#header', array('onclick'=>$t, 'escape'=>False));       
echo '</div>';
echo $this->element('admin_menu');  # top menu
?>
<div id="container"><?php echo $this->Html->div('clearfix', $content_for_layout, array('id'=>'main-section'));  ?></div>
<div style="clear:both"></div>
<div id="footer"><p>Powered by <a href="http://www.chipotle-software.com/" rel="external">Centauro &copy; GPLv3 2002-2012</a></p></div>
</div><!-- end container -->
<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>