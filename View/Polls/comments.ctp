<h2>Opinión</h2>
<?php
# die(debug($data));

echo $this->Html->div('barra', $data['Poll']['question']);


if ( $this->Session->check('Auth.User.id') ):
   echo $this->Gags->imgLoad('load4');
   echo$this->Gags->ajaxDiv('comment');
        echo$this->Form->create();
        echo $this->Form->hidden('PollsComment.poll_id', array('value' => $data['Poll']['id']));
        echo $this->Form->textarea('PollsComment.comment', array('cols' => 60, 'rows' => 10, 'wrap'=>'hard'));
        echo $this->Js->submit('Send', array('url'       => '/polls/addcomment',
                                     'update'   => 'comment',
                                     'loading'  => "Element.hide('comment');Element.show('load4')",
                                     'complete' => "Element.hide('load4');Effect.Appear('comment');"
        ));
        echo '</form><br />';
   echo $this->Gags->divEnd('comment');
 endif; 
 
$i = 0;
foreach( $data['PollsComment'] as $c):
     $i++;
     $avatar = $this->Html->image('avatars/'.$c['User']['avatar'], 
                            array('alt'=>$c['User']['username'], 'title'=>$c['User']['username'],  'height'=>20, 'width'=>20));
     $user   = $this->Html->link($c['User']['username'], '/users/about/'.$c['User']['username']) .' ';
     $user  .= $this->Html->link($avatar, '/users/about/'.$c['User']['username'], null, null, false);

     echo $this->Html->div('comentnew');  
                  echo  '<span style="font-weight:bold;color:#000;">'.$i.'.-</span> '.$user . '<br />';
                  echo $time->timeAgoInWords($c['created']) . ' <b>'. $c['User']['username']    . '</b> wrote:<br />';
                  echo Sanitize::html($c['comment']);
     echo '</div>';        
endforeach;
?>