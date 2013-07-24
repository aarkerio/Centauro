<?php
 #die(debug($data));
 echo $this->element('qnew', array('cache' => False, 'q'=>$data, 'frontend'=>False, 'counter'=>1));

 echo $this->Gags->imgLoad('load4');
 echo "<div id='all_quick_form'>";
 #Form to add a comment in quicks
 if ( $this->Session->check('Auth.User.id') ):
     echo $this->Html->link(__('Add comment'), '#', array('onclick' => 'hideshow("comment_form")'));
     echo "<div id='comment_form' style='display:block;'>";
     #Displays the add comment form
     echo$this->Form->create();
     echo $this->Form->hidden('QuicksComment.quick_id', array('value' => $data['Quick']['id']));
     echo $this->Form->textarea('QuicksComment.comment', array('cols' => 60, 'rows' => 10, 'wrap'=>'hard'));
     echo $this->Js->submit('Send', array(
                                     'url'         => '/quicks/addcomment',
                                     'update'      => '#comment',
                                     'evalScripts' => True,
                                     'before'      => $this->Gags->ajaxBefore('comment', 'load4'),
                                     'complete'    => $this->Gags->ajaxComplete('comment', 'load4')
         ));
     echo '</form><br />';
 endif; 
 echo '</div></div>';

echo $this->Gags->ajaxDiv('comment');
$i = 0;
foreach( $data['QuicksComment'] as $c):
     $i++;
     $avatar = $this->Html->image('avatars/'.$c['User']['avatar'], 
                                  array('alt'=>$c['User']['username'], 'title'=>$c['User']['username'],  'height'=>20, 'width'=>20,));
     $user   = $this->Html->link($c['User']['username'], '/users/about/'.$c['User']['username'] ) .' ';
     $user  .= $this->Html->link($avatar, '/users/about/'.$c['User']['username'], array('escape'=>False));

     echo $this->Html->div('comentnew');  
                  echo  '<span style="font-weight:bold;color:#000;">'.$i.'.-</span> '.$user . '<br />';
                  echo $this->Time->timeAgoInWords($c['created']) . ' <b>'. $c['User']['username']    . '</b> wrote:<br />';
                  echo nl2br(h($c['comment']));
     echo '</div>';        
endforeach;
echo $this->Gags->divEnd('comment');
#Return to quicks listing
 echo $this->Js->link(__('Back to index'), '/quicks/lastQuicks', 
                 array('update'      => '#quicks',
                       'evalScripts' => True,
                       'before'      => $this->Gags->ajaxBefore('quicks_comment', 'loading_quick'),
                       'complete'    => $this->Gags->ajaxComplete('quicks', 'loading_quick')
                       ));
 
echo $this->Js->writeBuffer();

# ? > EOF

