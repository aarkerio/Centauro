<div style="padding:4px">
<?php
# die(debug($data));
echo '<div style="margin-bottom:4px;color:#2c363b;padding:4px;font-size:18pt;font-weight:bold;border-bottom:1px solid black">'.$data['Gallery']['title'] . '</div>';
  
$size = getimagesize('../webroot/img/photos/'.$data['Photo']['file']);
  
$width = ( $size[0] > 620 ) ? 620 : $size[0];
  
echo '<div style="text-align:center;border: 1px dotted black;margin:0;padding:5px;">';
echo $this->Html->link($this->Html->image('photos/'.$data['Photo']['file'], array('alt'=>$data['Photo']['title'], 'width'=>$width, 'title'=>$data['Photo']['title'])), '/img/photos/'.$data['Photo']['file'], array('class'=>'chiki', 'escape'=>False)) . '<br />';
echo $data['Photo']['title'] .'  '.  $data['Photo']['created'] . '<br />';
echo $data['Photo']['description'] . '<br />';
?>
</div></div> 

<?php
 $k = 1;
        
 foreach ($data['Commentphoto'] as $v):      
     $bg = ($k%2==0) ? "#e2e2e2" : "#fff";       
     $user = ( $v['user_id'] != 0 ) ? $this->Html->link($v['username'], '/users/about/'.$v['username']) : $v['username'];
     echo '<div style="border:2px dotted #e2e2e2;margin:15px 0 15px 0;padding:4px;background-color:'.$bg.'">' . $k++ . '.- <b>' . $user  . '</b> wrote: ';
     echo '<br /><br />';
echo nl2br($v['coment']) . '<br /><br />';
     echo '<span class="small" style="font-size:7pt;font-weight:bold;">' . $v['created'] . '</span></div>';
 endforeach;

 echo $this->Form->create('Commentphoto', array('action'=>'add'));
 echo $this->Form->hidden('Commentphoto.redirect_to', array('value'=>'/photos/view/'.$blogger['User']['username'].'/'.$data['Photo']['id']));
 echo $this->Form->hidden('Commentphoto.photo_id', array('value'=>$data['Photo']['id']));
 echo $this->Form->hidden('Commentphoto.blogger_id', array('value'=>$blogger['User']['id']));
?>
<fieldset>
  <legend id="new_comment">Write Comment</legend>
  <?php
  if ($this->Session->read('Auth.User.id') ):
      echo $this->Form->hidden('Commentphoto.user_id', array('value'=>$this->Session->read('Auth.User.id')));
      echo $this->Form->hidden('Commentphoto.username',array('value'=>$this->Session->read('Auth.User.username')));
      echo $this->Session->read('Auth.User.username') . '  escribe:';
  else:
?>
    <div id="captcha_container">
    <img id="captcha_img" src="/comentphotos/securimage/0" alt="CAPTCHA image" /><br />
    <img id="captcha_reload" src="/img/icon-reload.png" title="Refresh CAPTCHA" /><br />
    <input id="captcha_text" name="data[Commentphoto][captcha]" value="" />
    </div>
<?php
      echo $this->Form->input('Commentphoto.username', array('size' => 25, 'maxlength' => 50, 'between'=>':<br />', 'label'=>'Nombre (requerido)')); 
      echo $this->Form->input('Commentphoto.email',    array('size'=>30, 'maxlength'=>60, 'between'=>':<br />', 'label'=>__('Email (is not showed)')));
      echo $this->Form->input('Commentphoto.website',  array('size'=>40, 'maxlength'=>120,'between'=>':<br />', 'value'=>'http://'));
  endif;
  echo $this->Form->input('Commentphoto.coment', array('type'=>'textarea', 'label'=>False, 'rows' => 10, 'cols' => 50));
  echo $this->Form->end('Send');
 ?>
</fieldset>
