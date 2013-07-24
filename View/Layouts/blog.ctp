<?php
 #die(debug($blogger));
 echo '<?xml version="1.0"?>'; 
 echo $this->Html->docType();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<?php
if ( isset($this->Js) ):
    echo $this->Html->charset('UTF-8');
    echo $this->Html->script(array('jquery-min',  'jquery.jeditable'), True);
endif; 

$username = trim($blogger['User']['username']);
?>
<link rel="shortcut icon" href="/img/static/favicon.ico" />
<meta http-equiv="content-type" content="application/xhtml+xml;charset=utf-8" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $username; ?> RSS 2.0" href="/entries/rss/<?php echo $username; ?>.rss" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $username; ?> Bookmarks" href="/bookmarks/feeder/<?php echo $username; ?>.rss" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $username; ?> Podcast" href="/podcasts/index/<?php echo $username; ?>.rss" />
<title> <?php echo $title_for_layout; ?> :: MonoNeurona</title>
<style type="text/css">
<?php echo $style; ?>
</style>
</head>
<body id="body">
<!-- MAIN CONTENT BEGIN -->
<div id="wrapper">
<div id="headerimg">
<div id="titulo"><?php echo $this->Html->link($blogger['User']['name_blog'], '/blog/'.$username); ?></div>
<div style="clear:both"></div>
<div id="frase"><?php echo $blogger['User']['quote']; ?></div>
</div><!-- headerimg -->
<div id="shadow"></div>
<div id="main">
<div style="padding:4px">
<?php 
if ( isset( $blogger['Quote'][0]['quote'] ) ):  # only if quote really exist
    echo $this->Html->div('quote', $blogger['Quote'][0]['quote'] . '  <i>'. $blogger['Quote'][0]['author'] .'</i>');
endif;
echo $content_for_layout; 
?>
 </div>  
</div>
<div id="thin"> 
<div id="rss">RSS:
<?php
echo $this->Html->link('Articles', "/entries/rss/$username.rss", array('title'=>$username));
echo $this->Html->link('Podcasts', "/podcasts/index/$username.rss", array('title'=>$username));
echo '</div>';
if ( $this->Session->check('Auth.User') ):   
    echo $this->Html->div('centered',Null,array('style'=>'text-align:center'));
    echo $this->Html->link($this->Html->image('static/icon_logout.gif', array('alt'=>'Logout','title'=>'Logout')),'/users/logout',array('escape'=>False));
    echo '</div>';
else: 
    echo $this->element('login');
endif;

# Visits
echo $this->element('visits', array('user_id'=>$blogger['User']['id']));

# search box
echo $this->element('search_blog', array('username'=>$username));
?>
<div id="blogger">
   <div style="margin:0 auto 0 auto 0;float:center;text-align:center;">
<?php
echo $this->Html->image('avatars/'.$blogger['User']['avatar'], array('alt'=>$username,'title'=>$username));
echo '</div>';
echo '<span style="font-size:7pt;text-align:justify;">'. nl2br($blogger['User']['cv']) . '</span>';
echo '</div>';
    
# if ( isset($tagCloud) ):
#	 echo $this->element('tags', $tagCloud);
# endif;
echo $this->Html->div('temas', 'Powered by');
echo $this->Html->div('spaced',  $this->Html->link($this->Html->image('static/mn-small.png', array('alt'=>'Despabilando la MonoNeurona.org', 
                                                                   'title'=>'Despabilando la MonoNeurona.org')), '/',  array('escape'=>False)));
if ( $blogger['User']['livechat'] = 1):
    echo $this->element('livechat', $blogger['Livechat']);
endif;
if ( $blogger['User']['Wayding'] = 1):
    echo $this->element('waydingblog', $blogger['Wayding']);
endif;      

echo $this->element('galleries', array('blogger_id'=>$blogger['User']['id'], 'username' => $username));
                 
echo $this->Html->div('spaced');
echo $this->Html->link($this->Html->image('static/firefox-80x15.png',array('alt'=>'Firefox','title'=>'Firefox')),'http://www.mozilla.org/',  array('escape'=>False));
echo $this->Html->link($this->Html->image('static/jedit.png', array('alt'=>'jEdit.org', 'title'=>'jEdit.org')), 'http://www.jedit.org',  array('escape'=>False));
echo $this->Html->link($this->Html->image('static/gimp.png', array('alt'=>'Gimp', 'title'=>'Gimp')), 'http://www.gimp.org/',  array('escape'=>False));
echo $this->Html->link($this->Html->image('static/ooorg-80.png', array('alt'=>'OpenOffice.org', 'title'=>'OpenOffice.org')), 'http://www.openoffice.org/',  array('escape'=>False));
echo $this->Html->link($this->Html->image('static/hacker-80x15.png', array('alt'=>'Hacker', 'title'=>'Hacker')), 'http://www.fsfla.org/',  array('escape'=>False));
?>
</div>
</div> <!-- id="thin" -->
<div style="clear:both"></div>
<div id="top">
 <?php echo $this->Html->link($this->Html->image('static/top.png', array('alt'=>'Top', 'title'=>'Top')), '#body', array('escape'=>False)); ?>
</div>
<div id="cc">  Colectivo MonoNeurona.org &copy; 2002-2013.</div>
</div> <!--id="wrapper" -->
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<?php echo $this->Html->scriptStart(); ?>
_uacct = "UA-72189-1";
urchinTracker();
<?php 
echo $this->Html->scriptEnd();
echo $this->Js->writeBuffer();
?>
</body>
</html>