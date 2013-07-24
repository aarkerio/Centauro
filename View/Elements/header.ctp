<!--Header-->
<div id="header">
<?php 
if ( $this->Session->check('Auth.User')  ):
    $nick = $this->Session->read('Auth.User.username');
    echo '<span style="font-size:8pt;font-weight:bold;color:#677d7b;padding-right:185px;float:right;">Welcome ' . $nick .'!</span>  ';
    echo $this->element('newmessage');
endif;
?>
</div><!--End Header-->
<div id="divmenu">
<ul class="main-nav">
<?php 
   if ( !$this->Session->check('Auth.User')  ):
          echo '<li>'.$this->Html->link(__('Login'), '/users/login', array('title'=>'Come in')).'</li>';
   endif;
   ?>
        <li><?php echo $this->Html->link(__('Home'), '/', array('title'=>'Home')); ?></li>
        <?php 
         # echo '<li>'.$this->Html->link('Chat', '/messages/chat/'.$nick, array('title'=>'IRC Chat')) .'</li>';
        ?>
        <li><?php echo $this->Html->link(__('Downloads'), '/downloads/', array('title'=>'Software para todos'));?></li>
        <li><?php echo $this->Html->link('Wallpapers', '/photos/display/aarkerio/6', array('title'=>'BG'));?></li>
        <li><?php echo $this->Html->link('Páginas recientes','/pages/last', array('title'=>'Lo último'));?></li>
        <li><?php echo $this->Html->link('FAQ', '/pages/faq', array('title'=>'Rincón del preguntón'));?></li>
 </ul>
</div>