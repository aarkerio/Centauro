<?php
echo $this->Html->div('barra', 'Downloads');
foreach($data as $v):
    echo $this->Html->div(null, ' »'.$this->Html->link($v['Catdownload']['title'], '/downloads/display/'.$v['Catdownload']['id']), array('style'=>'margin:10px;padding:5px;border:1px dotted gray'));
endforeach;
# ? >
