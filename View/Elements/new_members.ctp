<?php
 # Chipotle Software

 $users = $this->requestAction('users/newMembers');
 echo $this->Html->div('newmembers');
 echo $this->Html->div('nm_title', 'New members');
 foreach ($users as $u):
        echo $this->Html->link(
                     $this->Html->image('avatars/'.$u['User']['avatar'], array('width'=>'18px', 'alt'=>$u['User']['username'], 'title'=>$u['User']['username'])),
                                 '/blog/'.$u['User']['username'], array('title'=>$u['User']['username']), array(), false, false) . '&nbsp;';
        echo $this->Html->link($u['User']['username'],  '/blog/'.$u['User']['username']) . '<br />';
 endforeach;
 ?>
</div>
