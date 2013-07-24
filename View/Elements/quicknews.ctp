<?php
# Form to add new quick new
if ( $this->Session->check('Auth.User')  ):
    echo $this->Gags->ajaxDiv('qn', array('style'=>'padding:3px'));
    echo $this->Js->link($this->Html->image('static/arrow_down.png', array('alt'=>__('Publish Quick New', True), 'title'=>__('Publish Quick New', True))), 
           '/quicks/qnform',
                       array('update'      => '#qn',
                             'evalScripts' => True,
                             'escape'      => False,
                             'before'      => $this->Gags->ajaxBefore('qn', 'loading_quick'),
                             'complete'    => $this->Gags->ajaxComplete('qn', 'loading_quick')
                             ));
  echo $this->Gags->divEnd('qn');
endif;    

echo $this->Html->div(null, null, array('style'=>'text-align:left;margin:5px auto 5px auto;'));
$quicks = $this->requestAction('quicks/lastQuicks');
# List the last quicks
#die(debug($quicks));
$counter = (int) 0;
foreach ($quicks as $q):
    $counter++;
    echo $this->element('qnew', array('cache' => False, 'q'=>$q, 'frontend'=>True, 'counter'=>$counter));
endforeach;

echo $this->Html->para(null,$this->Js->link('All quicks', '/quicks', 
                                      array('style'       => 'margin:13px;',
                                            'update'      => '#quicks',
                                            'evalScripts' => True,
                                            'before'      => $this->Gags->ajaxBefore('quicks', 'loading_quick'),
                                            'complete'    => $this->Gags->ajaxComplete('quicks', 'loading_quick')
                                            )));
echo '</div>';
echo $this->Js->writeBuffer(); 

# ? > EOF
