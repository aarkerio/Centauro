<div style="border:1px dotted orange;padding:4px">
<?php
#var_dump($Element[0]["Wayding"]);
echo $this->Html->image('static/qstuve.png', array('alt'=>"¿Qué estuve haciendo?", 'title'=>"¿Qué estuve haciendo?", "style"=>"margin-right:5px 0 10px 0"));
echo '<br />';
foreach ($blogger['Wayding'] as $val):
   echo '<span style="font-size:7pt;">'.$val['task'] .'</span> <br />';
   echo '<span style="font-size:6pt;">'.$this->Time->timeAgoInWords($val['created']) .'</span><br />';
endforeach;

echo '</div>';

# ? > EOF

