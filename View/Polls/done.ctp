<?php
#debug($data);
   $avatar = $this->Html->image('avatars/'.$data['User']['avatar'], 
                            array('alt'=>$data['User']['username'], 'title'=>$data['User']['username'],  'height'=>20, 'width'=>20));
   $user   = $this->Html->link($data['User']['username'], '/users/about/'.$data['User']['username']) .' ';
   $user  .= $this->Html->link($avatar, '/users/about/'.$data['User']['username'], null, null, false);

   echo $this->Html->div('comentnew');  
                  echo  '<span style="font-weight:bold;color:#000;"></span> '.$user . '<br />';
                  echo $time->timeAgoInWords($data['PollsComment']['created']) . ' <b>'. $data['User']['username'].'</b> wrote:<br />';
                  echo Sanitize::html($data['PollsComment']['comment']);
   echo '</div>';
?>