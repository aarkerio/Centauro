<div class="barra">Que estuvimos haciendo</div>
<div style="margin:10px;padding:10px 10px 10px 30px;border:1px dotted orange">
<?php
foreach ($data as $val):
    echo $this->Html->link($this->Html->image("avatars/".$val['User']['avatar'], array('alt'=>$val['User']['username'], 'title'=>$val['User']['username'], 
                                    'width'=>40, 'style'=>'margin-right:5px')),  '/blog/'.$val['User']['username'], array('escape'=>False));
      echo '<span style="font-size:6pt;font-weight:bold">'.$val['User']['username'] .' est&aacute;:</span> <br />';
      echo '<span style="font-size:7pt;">'.$val['Wayding']['task'] .'</span> <br />';
      echo '<span style="font-size:6pt;">'.$this->Time->timeAgoInWords($val['Wayding']['created']) .'</span><br /><br />';
endforeach;

echo '</div>';

# ? > EOF

