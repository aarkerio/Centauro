<?php
#die(debug($data));
$this->set('title_for_layout', 'Search Results');
echo $this->Html->div('title', 'Results');

foreach ($data as $v):
echo $this->Html->div('divlink', $this->Html->link($v[0]['title'],'/entries/view/'.$v[0]['username'].'/'.$v[0]['id']). '  <br /><span style="font-weight:bold;font-size:7pt;">'.$v[0]['created'].'</span><br />'.$v[0]['headline'], array('style'=>'border:1px solid #e0e0e0;')).''; 
endforeach;

# ? > EOF 
