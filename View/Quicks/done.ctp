<?php
#die(debug($data));
echo $this->Session->flash();
$i = 0;
foreach($data as $c):
    $i++;
    $class= $i == count($data) ? 'comentnewlast' : 'comentnew';
    $avatar = $this->Html->image('avatars/'.$c['User']['avatar'], 
                            array('alt'=>$c['User']['username'], 'title'=>$c['User']['username'],  'height'=>20, 'width'=>20));
    $user   = $this->Html->link($c['User']['username'], '/users/about/'.$c['User']['username']) .' ';
    $user  .= $this->Html->link($avatar, '/users/about/'.$c['User']['username'], array('escape'=>False));

    echo $this->Html->div($class);  
                  echo  '<span style="font-weight:bold;color:#000;"></span> '.$user . '<br />';
                  echo $time->timeAgoInWords($c['QuicksComment']['created']) . ' <b>'. $c['User']['username'].'</b> wrote:<br />';
                  echo nl2br(h($c['QuicksComment']['comment']));
    echo '</div>';
endforeach;
    
# ? >
