<?php
#debug($data); 
echo $this->Html->div('titnew');
echo $this->Html->div('img_new',$this->Html->link(
                      $this->Html->image('themes/'.$val['Theme']['img'], array('style'=>'height:35px;border:1px solid white;','alt'=>$val['Theme']['theme'], 'title'=>$val['Theme']['theme'])),  '/news/category/' .$val['News']['theme_id'], array('escape'=>False)));
# --SI ES ESPAM
if ($this->Session->read('Auth.User.group_id')=='1'):
 echo  $this->Html->link($this->Html->image('images/nospam.png', array('style'=>'height:22px; border:1px solid white','width'=>'22px', 'alt'=>'NoSpam', 'title'=>'NoSpam')), '/admin/news/spam/'.$val['News']['id'],  array('escape'=>False)); 
endif; 

#Votes start
/*
$votes   = (int) 0;
$already = (bool) False;
foreach ($q['QuicksVote'] as $h):
   # echo $h['vote'] . '<br />';
   $votes = $votes + $h['vote'];
   if ($this->Session->read('Auth.User.id') == $h['user_id']):
       $already = True;
   endif;
endforeach;
?>
<span class="rank" style="width:20px;"><?php echo $counter; ?></span>
<div id="divarrows_<?php echo $q['Quick']['id']; ?>" class="midcol" style="width:15px;" >
<?php
 if ( $already ):  #user already voted
     $up   = $h['vote']  > 0  ? 'aupmod.gif'   : 'aupgray.gif';
     $down = $h['vote']  < 0  ? 'adownmod.gif' : 'adowngray.gif';
     echo $this->Html->image('static/'.$up,array('alt'=>'Vote')).$this->Html->div('score',$votes).$this->Html->image('static/'.$down,array('alt'=>'Vote'));
 elseif ( !$already && $this->Session->read('Auth.User')):
     echo$this->Js->link($this->Html->image('static/aupgray.gif', array('alt'=>'Vote')), '/quicks/vote/up/'.$q['Quick']['id'],
                         array('update'  => '#',$ajax_update,
                         'loading'  => "Element.show('loading3');", 
                         'complete' => "Element.hide('loading3');Effect.Appear('$ajax_update')"
));
     echo $this->Html->div('score', $votes);
     echo$this->Js->link($this->Html->image('static/adowngray.gif', array('alt'=>'Vote')), '/quicks/vote/down/'.$q['Quick']['id'],
                   array('update'   => '#'.$ajax_update,
              
else: 
     echo $this->Html->link($this->Html->image('static/aupgray.gif',  array('alt'=>'Vote')), '/users/login/', array('escape'=>False));
     echo $this->Html->div('score', $votes);
     echo $this->Html->link($this->Html->image('static/adowngray.gif',array('alt'=>'Vote')), '/users/login/', array('escape'=>False));
endif; 

echo '</div>';
*/
# Votes ends

echo $val['News']['title']; 
 echo '</div>';
 echo $this->Html->div('redaccion');

 echo 'Desde la redacci&oacute;n de <i>'.$val['Theme']['theme'].'</i>  '; 
 echo $this->Html->link($val['User']['username'], '/users/about/'.$val['User']['username'],  array('style'=>'font-size:7pt;')) . ' informa  &nbsp'; 
 echo $val['News']['created'];

 echo '</div>';
 echo $this->Html->div('bodynew'); 
 echo $val['News']['body']; 
 echo '<br />';
 echo $this->Html->para(null, '<span style="font-size:7pt;">Permalink:</span> ' .$this->Html->link(
			   'http://'.$_SERVER['HTTP_HOST'].'/news/view/'.$val['News']['id'],
                           'http://'.$_SERVER['HTTP_HOST'].'/news/view/'.$val['News']['id']
                           )); 
 ?>
 <br /><br />
<?php
if ( strlen($val['News']['reference'])  > 10) :
   echo $this->Html->para(null, __('Reference', true). ' ' .$this->Html->link(
                           $this->Html->image('admin/newwindow.gif', array('alt'=>'Open new window', 'title'=>'Open new window')),
                           '#new'.$val['News']['id'],
                           array('onclick'=>"window.open('".h($val['News']['reference'])."', '_help', 'status,scrollbars,resizable,width=800,height=600,left=10,top=10,menubar,toolbar')", 'escape'=>False)));
endif;    
                          
if ( $frontend == True):    
   if ( $val['News']['comments'] == 1 ):  # comments enabled
      $num_coment = count($val['Commentnews']);
      if ( $num_coment > 0 ):
            echo '&nbsp;'.$this->Html->link($num_coment.' Comentarios', '/news/view/'.$val['News']['id'], array('style'=>'font-size:7pt'));
      endif;
      echo $this->Html->link('Pon tu comentario','/news/view/'.$val['News']['id'],array('style'=>'font-size:7pt;padding-left:20px')).'<br />';
 endif;

 echo $this->News->socialNets($val['News']['id'], $val['News']['title']);    # Social nets buttons

 else: # showin permalink
   if ( $data['News']['comments'] == 1 ):  # comments are enabled
        $i = 1;
        echo $this->Html->div('cnews');
        foreach($val['Commentnews'] as $v):
              $bg = ($i%2==0) ? '#e2e2e2' : '#fff';
              if ( $v['user_id'] != 0 ):   # 0 = anonymous comment
		          $avatar = $this->Html->image('avatars/'.$v['User']['avatar'], 
                            array('alt'=>$v['User']['username'], 'title'=>$v['User']['username'],  'height'=>20, 'width'=>20));
	              $user   = $this->Html->link($v['User']['username'], '/users/about/'.$v['User']['username']) .' ';
                  $user  .= $this->Html->link($avatar, '/users/about/'.$v['User']['username'],array('escape'=>False));
	          else:                                                                                              
                  $avatar = $this->Html->image('avatars/t_icon.jpg', array('alt'=>$v['name'], 'title'=>$v['name'], 'height'=>20, 'width'=>20));
                  $user   = '<span style="font-weight:bold;">' . $v['name'] .'</span>  ' .  $avatar ;    
	          endif;
              
              echo $this->Html->div('comentnew', null, array('style'=>'background-color:'.$bg));  
              echo  '<span style="font-weight:bold;color:#000;">'.$i.'.-</span> '.$user . '<br />';
              echo $this->Time->timeAgoInWords($v['created']) . ' <b>'. $v['name']    . '</b> wrote:<br />';
              echo nl2br(h($v['comment']));
              echo '</div>';
              $i++;
        endforeach;
        echo '</div>';
        # Print comment form    
        echo $this->Form->create('Commentnews', array('action'=>'add'));
        echo $this->Form->hidden('Commentnews.new_id', array('value'=>$val['News']['id'])); 
        echo $this->Form->hidden('Commentnews.user_id', array('value'=>$val['News']['user_id'])); 
        echo $this->Form->hidden('Commentnews.level', array('value'=>1));
        echo $this->Form->hidden('Commentnews.commentnew_id', array('value'=>1));
        ?>
        <fieldset>
        <legend>Add comment:</legend>
        <?php 
        if ( $this->Session->read('Auth.User.username') ):
            echo $this->Session->read('Auth.User.username'). "  escribe:";
        else:  # anonymous user
            echo $this->Form->hidden('Commentnews.user_id', array('value'=>0));
            echo $this->Form->input('Commentnews.name', array('size' => 25, 'maxlength' => 50));
            echo $this->Html->image('/commentnews/securimage/', array('id'=>'captcha', 'alt'=>'CAPTCHA Image')).'<br />';
            echo $this->Form->input('Commentnews.captcha',array('size'=>6,'maxlength'=>6, 'label'=>'Introduce el código, todas la letras son minúsculas'));
        endif;

        echo '<br />';
        echo $this->Form->input('Commentnews.comment', array('type'=>'textarea','cols'=>70, 'rows'=>10));
        echo $this->Form->end('Add comment'); 
        echo '</fieldset>';
    endif;
 endif;    
 echo '</div>';

# ? > EOF
