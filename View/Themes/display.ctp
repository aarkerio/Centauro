<?php
echo $this->Html->div('barra', 'Themes');
foreach($data as $t):
echo $this->Html->div('block', null, array('style'=>'text-align:center;margin:5px;border:1px dotted gray;padding:5px;width:200px;'));
      echo $this->Html->link($this->Html->image('themes/'.$t['Theme']['img'], array('alt'=>$t['Theme']['theme'], 'title'=>$t['Theme']['theme'])), 
              '/themes/view/'.$t['Theme']['id'], null, null, false);
      echo '<br />';
      echo $this->Html->link($t['Theme']['theme'], '/themes/view/'.$t['Theme']['id']);
  echo '</div>'; 
endforeach;
?>