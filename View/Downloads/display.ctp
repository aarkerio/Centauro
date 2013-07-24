<?php
#die(debug($data));
echo $this->Html->div('title_section', '<h1>Downloads</h1>');

foreach($data as $v):
     echo $this->Html->div(null, null,  array('style'=>'margin:10px;padding:5px;border:1px dotted gray', 'id'=>'dow'.$v['Download']['id']));
     echo $this->Html->div('barra', $v['Download']['title']);
     echo $this->Html->para(null, 'Sugerido por '. $this->Html->link($v['User']['username'],  '/blog/'.$v['User']['username']));
     echo $this->Html->para(null, $v['Download']['description']);
     echo '<br />';
     echo $this->Html->para(null, $this->Html->link($this->Html->image('static/button_download.gif', array('alt'=>'Download', 'title'=>'Download')),  $v['Download']['url'], array('escape'=>False)));
echo '</div>';
endforeach;
# ? >
