<?php
# die(debug($data));
echo $this->Html->div('block', null, array('style'=>'text-align:center;margin:7px;border:1px dotted gray;'));
echo $this->Html->image('themes/'.$data['Theme']['img'], array('alt'=>$data['Theme']['theme'], 'title'=>$data['Theme']['theme']));
 echo '<br />';
 echo '<h1>'.$data['Theme']['theme'] . '</h1>';
echo '</div>';

#News
echo $this->Html->div('titnew', 'News');
foreach($data['News'] as $t):
echo $this->Html->div('block', null, array('style'=>'text-align:left;margin:7px;border:1px dotted gray;padding:3px;'));
      echo $this->Html->link($t['title'],'/news/display/'.$t['id']);
  echo '</div>'; 
endforeach;

#Quick
echo $this->Html->div('titnew', 'Quicks');
foreach($data['Quick'] as $q):
      echo $this->Html->div('block', null, array('style'=>'text-align:left;margin:7px;border:1px dotted gray;padding:3px;'));
      echo $this->Html->link($q['title'], $q['reference'], array('target'=>'_blank'));
echo '</div>'; 
endforeach;

# ? > EOF
