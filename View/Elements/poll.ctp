<?php
echo $this->Html->div('sideelement', Null,  array('style'=>'background-color:#fff;border:1px solid #000;padding:3px;'));

#echo $this->Html->div(Null,);

echo $this->Html->div('sidemenu', 'Quickvote');
echo $this->Gags->imgLoad('loading');
echo $this->Gags->ajaxDiv('add_pollrow');
$poll = $this->requestAction('polls/poll'); 
$poll_id = $this->Session->read('poll_id');
#die(debug($poll));
$question =  $this->Html->para('negrita', $poll['Poll']['question'], array('style'=>'text-align:left;font-size:12pt;color:#000;'));
if ( $poll_id != Null &&  $poll['Poll']['id'] == $poll_id): # the user has already voted, so show poll results
    $total_votes = (int) 0;
    # build array  
    foreach ($poll['Pollrow'] as $val):
         $total_votes += $val['vote'];  # the total votes
    endforeach;
    echo $question;
    
    foreach ($poll['Pollrow'] as $val):        
          if ( $val['vote'] > 0 ):
              $percent = ($val['vote'] * 100) / $total_votes;  #  % = votes * 100 / total
          else:
              $percent = 0;
	      endif;
          $width   = number_format($percent, 0);
          echo $this->Html->div(Null, '<b>'.$val['answer'].'</b> '.number_format($percent, 2).'% <br />'. 
                          $this->Html->image('static/poll/'.$val['color'].'.png',array('height'=>10,'width'=>$width,'alt'=>$val['answer'])).'  '.$val['vote'],
                          array('style'=>'text-align:left;margin-top:7px;'));
     endforeach;
     echo $this->Html->para('negrita', __('Total votes').':' . $total_votes); 
else: # the user has no voted, print the form
     echo $this->Form->create();
     echo '<fieldset style="padding:5px">';
     $array   = array();
     echo $question;
     echo $this->Form->hidden('Pollrow.poll_id', array('value'=>$poll['Poll']['id']));  # Poll_id
     foreach ($poll['Pollrow'] as $val):
         $array[$val['id']] = $val['answer'];  # construct id->value 
     endforeach;
  
     echo '<span style="font-size:7pt">';
     # print the answers
     echo $this->Form->input('Pollrow.id', array('options'=> $array,'label'=>False, 'separator'=>'<br />', 'type'=>'radio', 'checked'=>1));   
     echo '</span><br />';
    
     echo $this->Js->submit(__('Vote', True), array('url'         => '/pollrows/vote', 
                                                    'update'      => '#add_pollrow',
                                                    'evalScripts' => True,
                                                    'before'      => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => False)),
                                                    'complete'    => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => False)),
                         ));
     echo '</fieldset></form>';
  endif;
echo $this->Gags->divEnd('add_pollrow');
echo $this->Gags->divEnd('sideelement');

# ? > EOF

