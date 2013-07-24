<?php
$entries = $this->requestAction('entries/lastEntries');

if ( count($entries) > 0):
    echo $this->Html->image('static/blogactiv2.gif',array('alt'=>'Blogging', 'title'=>'Teachers Blogging', 'style'=>'margin-right:5px 0 15px 0;'));
endif;

foreach ($entries as $val):
    $total = count($val['Commentblog']); # comments
    echo $this->Html->div(Null, $this->Html->link($val['Entry']['title'], 
                          '/entries/view/'.$val['User']['username'].'/'.$val['Entry']['id']) . 
                           ' <span style="font-size:6pt">'.$val['User']['username'].'('.$total.')'.'</span>', 
                           array('style'=>'margin-top:4px;padding-left:2px;text-align:left;')
                    );
endforeach;

# ? > EOF
