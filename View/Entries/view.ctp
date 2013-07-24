<?php
$this->set('title_for_layout',  $blogger['User']['username'] . '\'s Blog');

#exit(debug($Element));    
$discution =  $data['Entry']['discution'];
$entry_id  =  $data['Entry']['id'];
$user_id   =  $data['Entry']['user_id'];
    
    
echo '<h3><a class="title" href="/entries/view/'.$blogger['User']['username'].'/'.$data['Entry']['id'].'">' . $data['Entry']['title'] . '</a></h3>';

echo $this->Html->div('date_entry', $data['Entry']['created']. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Esta entrada ha sido vista <b>'.$data['Entry']['visits'].'</b> veces.');
echo '<h4>'. $data['Themeblog']['title'].'</h4>';
echo $this->Html->div('body_entry', $data['Entry']['body']);
    
$pl = 'Permalink: http://' . $_SERVER['SERVER_NAME'] . '/entries/view/'.$blogger['User']['username'].'/'.$entry_id;
    
echo $this->Html->para(null, '<a style="font-size:7pt" href="/entries/view/'.$blogger['User']['username'].'/'.$entry_id.'">'.$pl.'</a>');
    
if ( $discution == 1 ):
      echo '<div id="new_comment">';
      echo $this->Html->link('Add comment ('.count($data['Commentblog']).')', '/entries/view/'.$blogger['User']['username'].'/'.$entry_id, array('style'=>'font-size:7pt'));
      echo '</div>';
endif;   
echo '<hr />';
 
if ( $discution == 1 ):  # is the comments in this entry enabled in this individual entry
    if ( !$this->Session->check('Auth.User.id') ):  # if user logged, anchor to textarea
        echo "<div id=\"comments\"> ".$this->Html->image('static/comment.gif', array('alt'=>'Comments'))." Commentblogs:</div>";
    else:
        echo "<div id=\"comments\">".$this->Html->image('static/comment.gif', array('alt'=>'Comments'))." Commentblogs:<a style=\"font-size:7pt\" href=\"#new_comment\">&gt;&gt;</a></div>";
    endif;
        
    $k = 1;
        
    foreach ($data['Commentblog'] as $v):      
         $bg = ($k%2==0) ? "#e2e2e2" : "#fff";       
         $user = ( $v['user_id'] != 0 ) ? $this->Html->link($v['username'], '/users/about/'.$v['username']) : $v['username'];
               echo '<div style="border:2px dotted #e2e2e2;margin:15px 0 15px 0;padding:4px;background-color:'.$bg.'">' . $k++ . '.- <b>' . $user  . '</b> wrote: ';
               echo '<br /><br />';
               echo nl2br(Sanitize::html($v['comment'])) . '<br /><br />';
               echo '<span class="small" style="font-size:7pt;font-weight:bold;">' . $v['created'] . '</span></div>';
     endforeach;
        echo '<div>';
        
        echo $this->Form->create('Commentblog', array('action'=>'add'));
        echo $this->Form->hidden('Commentblog.redirect_to', array('value'=>'/entries/view/'.$blogger['User']['username'].'/'.$entry_id));
        echo $this->Form->hidden('Commentblog.blogger_id', array('value' => $blogger['User']['id']));
        echo $this->Form->hidden('Commentblog.entry_id', array('value'=>$entry_id));
?>
<fieldset>
  <legend id="new_comment">New Commentblog</legend>
  <?php
 
  if ($this->Session->read('Auth.User.id') ):
      echo $this->Session->read('Auth.User.username') . '  escribe:';
  else:
      $tmp  = $this->Form->input('Commentblog.username', array('size' => 25, 'maxlength' => 50));
      $tmp .= $this->Html->image('/commentblogs/securimage/', array('id'=>'captcha', 'alt'=>'CAPTCHA Image')).'<br />';
      $tmp .= $this->Form->input('Commentblog.captcha',array('size'=>6,'maxlength'=>6, 'label'=>'Introduce el código, todas la letras son minúsculas'));
      echo $this->Html->div(Null, $tmp, array('id'=>'captcha_container'));
  endif;
  #debug($this->Session->read());
  echo $this->Form->input('Commentblog.comment', array('type'=>'textarea', 'label'=>False, 'rows' => 10, 'cols' => 50));
  echo $this->Form->end('Send');
  echo '</fieldset>';
  echo '</div>';
 endif;

 echo $this->Html->scriptStart(); 
?>
// Using jQuery
$( '#captcha_reload' ).click( function() {
        $( '#captcha_img' ).attr('src', '/commentblogs/securimage/' + Math.random());  // Append random number to prevent caching
        $( '#CommentblogCaptcha' ).val('');
    });

<?php 
echo $this->Html->scriptEnd();
# ? > EOF

