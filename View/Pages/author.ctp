<?php
$this->set('title_for_layout',  'Paginas del autor');

echo $this->Gags->googleAds('page'); #publicity 

echo $this->Html->div('barra', 'Paginas de '. $data[0]['User']['username']);
$i = (int) 0;
 
echo '<ul>';
foreach($data as $val):
    $i++;
    echo '<li>'.$i.' ',$this->Html->link('&#187;'.$val['Page']['title'], '/pages/display/'.$val['Page']['id'], array('escape'=>False)) .'</li>';
endforeach;
echo '</ul>';

# ? > EOF

