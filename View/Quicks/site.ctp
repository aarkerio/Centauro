<?php
#debug($data);
foreach($data as $q):
   echo $this->Html->div('entry');
   echo $this->Html->para(null, $this->Html->link($q['Quick']['title'], $q['Quick']['reference'], array('class'=>'quick_title', 'target'=>'_blank')));
   echo '</div>';
endforeach;
?>