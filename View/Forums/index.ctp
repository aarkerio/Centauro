<?php       
foreach ($data as $val):
    echo $this->Html->div('comentnew');
echo $this->Html->div(Null, $this->Html->link($val['Forum']['title'], '/forum/discussion/'.$val['Forum']['id'], array('style'=>'font-weight:bold;font-size:18pt;')));
    echo $this->Html->div(Null, $val['Forum']['description'], array('style'=>'margin:7px;'));
echo $this->Html->div(Null, '<i>Category: <b>'. $val['Catforum']['title'].'</b></i>', array('style'=>'font-size:7pt;'));
    echo $this->Gags->divEnd('comentnew');
endforeach;
# ? >