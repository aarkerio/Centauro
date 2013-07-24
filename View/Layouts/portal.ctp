<?php 
  # die(debug($this->params));
  echo '<?xml version="1.0"?>'; 
  echo $this->Html->docType();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Despabilando la.. :: <?php echo $title_for_layout; ?> </title>
<meta name="google-site-verification" content="5PeM5GACl_SgMW-cBD6lCelwSwRtGOg_Gx8vBqhi6z0" />
<meta name="keywords" content="linux, openbsd, programming, cakephp, Django, ruby, python" />
<link rel="shortcut icon" href="/img/static/favicon.ico" />
<meta name="description" content="Hacktivismo Portal" />
<?php
if ( isset($this->Js) ):
    echo $this->Html->charset('UTF-8');
    echo $this->Html->script(array('jquery-min',  'jquery.jeditable', 'myfunctions', 'jsnow'), True);
endif;
echo $this->Html->css('styles');
?>
<script type="text/javascript">
   //$(function() {
            // $().jSnow();
    //     $().jSnow({flakes:15,flakeMaxSize:30,flakeMinSize:20,flakeCode:["&diams;","/img/ghost1.gif","/img/ghost2.gif","/img/ghost3.gif","/img/ghost4.png"],flakeColor:["#f00","#00f","#fff"],interval:30});
   //   });
</script>
<link rel="alternate" type="application/rss+xml" title="News RSS 2.0" href="/news/rss.rss" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php echo $this->Session->flash();  ?>
<script type="text/javascript">
   window.onload = timedMsg;
</script>
<?php 
echo $this->element('themes_top');
echo $this->element('header'); 
?>

<!--All content-->
<div id="content">
<!--Left panel-->
<div class="curved" id="divleft">
 <div style="text-align:center;margin:3px 0 3px 0;padding:2px;">
 <?php
  if ( !$this->Session->check('Auth.User') ):
      echo $this->element('login', array('cache' => True));
  endif;
  echo $this->Html->div('sidepanel', $this->element('lastentries'));

  if ( $this->Session->check('Auth.User') ):
      echo  $this->element('todos');
  endif;
  echo $this->Html->div('sidepanel', $this->Html->image('admin/your-users.png', array('alt'=>'MN', 'title'=>'MN', 'height'=> '25px', 'width'=>'25px'))."".$this->Html->link('Mononeurones Registrados', '/users/listing'));
  
 echo $this->element('adsense');
 echo $this->Html->div('sidepanel', $this->element('lastdownloads'));

 echo $this->Html->div('sidepanel', $this->element('sections', array('cache' => True)));
 echo $this->Html->div('sidepanel', $this->element('topnews')).'<br />';
 echo $this->Html->div('sidepanel', $this->element('topbloggers')); 
 echo  $this->element('banner');
?>
</div>
</div>

<!--Main panel-->
<div class="cont" id="divmain">
<cake:nocache>
<!--Quotes-->
<div class="blur" ><div class="shadow" ><div class="cont" >
<?php  
   echo $this->element('quote');
   $fe = (boolean) True;
?>
</div></div></div><br />
<!--Quicknews-->
<?php
    echo '<div class="blur"><div class="shadow"><div class="cont">';
    echo $this->Gags->imgLoad('loading_quick');
    # Load quick news if frontend
    if ( ($this->params['controller']             == 'news'    and
          $this->params['action']                 == 'display' and
          $this->params['paging']['News']['page'] == 1         and
          $fe == True) ):
              echo $this->Gags->ajaxDiv('quicks_comment').$this->Gags->divEnd('quicks_comment');
              echo $this->Gags->ajaxDiv('quicks', 'quicks'). $this->element('quicknews'). $this->Gags->divEnd('quicks');
    endif;
  ?>
 <br />
<?php  
  echo '<div id="content_layout">'. $content_for_layout.'</div>';  
  echo '</div></div></div>';
?>
  </cake:nocache>
</div>


<!--Right panel-->
<div class="curved" id="divright">
 <?php 
  echo $this->element('waydings').'<br />';
  echo $this->element('adsense');
  #echo $this->element('twitter'); # is somebody suing this ?
  #echo  $this->Gags->tla_ads();   # text links ad
  echo  $this->Html->div('menumain2', $this->Html->link(
                    $this->Html->image('static/banner_karamelo.jpg',array('alt'=>'e-Learning Solution', 'title'=>'e-Learning solution', 
                              'style'=>'border:1px solid black')), 
                                      'http://www.chipotle-software.com', array('escape'=>False)));
?>
<script type="text/javascript" src="http://www.ohloh.net/p/16759/widgets/project_partner_badge.js"></script>
<?php
  echo $this->element('poll');
  echo $this->element('rankpages');
 ?>
</div>

</div><!--END Main content (All page)-->

<!--Footer-->
<div class="curved" id="divfooter">
<?php  echo $this->Html->link($this->Html->image('static/top.png', array('alt'=>'Go top', 'title'=>'Go Top')), '#header', array('escape'=>False)); ?>
<span class="liga">Este trabajo est&aacute; licenciado bajo la <a style="font-size:7pt" href="/pages/display/783">MonoNeurona Commons License</a>. 2002-2012 &copy; :: Colectivo de Programacion MonoNeurona.org ::</span>
</div>

<div style="margin:20px auto 20px auto;width:800px;text-align:center;">
<?php
echo $this->Html->link($this->Html->image('static/debian-80x15.gif', array('alt'=>'The Queen is here', 'title'=>'The Queen is here')), 
        'http://www.debian.org/', array('escape'=>False)) . '&nbsp;';

echo $this->Html->link($this->Html->image('static/firefox-80x15.png', array('alt'=>'Mozilla Firefox', 'title'=>'Mozilla Firefox')), 
        'http://www.mozilla.org/products/firefox/', array('escape'=>False)) . '&nbsp;';
   
echo $this->Html->link($this->Html->image('static/pgsql-80x15.png', array('alt'=>'The Best DataBase', 'title'=>'The Best DataBase')), 
        'http://www.postgresql.org/', array('escape'=>False)) . '&nbsp;';
   
echo $this->Html->link($this->Html->image('static/cakephp-80x15.png', array('alt'=>'CakePHP Framework', 'title'=>'CakePHP Framework')), 
        'http://www.cakephp.org/', array('escape'=>False)) . '&nbsp;';
   
echo $this->Html->link($this->Html->image('static/valid_xhtml10_80x15_22.png', array('alt'=>'XHTML', 'title'=>'XHTML')), 
                          'http://validator.w3.org/check?uri=http://www.mononeurona.org/news/display/1522', array('escape'=>False)) . '&nbsp;';
 
echo $this->Html->link($this->Html->image('static/hacker-80x15.png', array('alt'=>"GNU Hacker", 'title'=>"GNU Hacker")), 
        'http://www.gnu.org/', array('escape'=>False)) . '&nbsp;';
		  
echo $this->Html->link($this->Html->image('static/chipotle80x15.png', array('alt'=>'Chipotle Software', 'title'=>'Chipotle Software')), 
        'http://www.chipotle-software.com', array('escape'=>False));   
echo '</div>'; 

#echo $this->Html->para(null,$this->Html->link('Too Cool for Internet Explorer', '/pages/display/681', array('id'=>'tooCool')));

if ( ! $this->Session->check('Auth.User') ):
    echo $this->element('login_hide');
endif;

echo $this->Html->scriptStart();
?>

function hideshow(element) //Hide and show quicks comment form, or other element specified
{ 
  var elem = document.getElementById(element);

   if (elem.style.display == 'none'){
            elem.style.display = 'block';
   } else {
            elem.style.display = 'none';
   }
}
<?php 
echo $this->Html->scriptEnd(); 
echo $this->Js->writeBuffer();
# echo $this->Html->div('corner', ' ', array('alt'=>'Ahora con CakePHP 2.0', 'title'=>'Ahora con CakePHP 2.0'));
?>
</body>
</html>