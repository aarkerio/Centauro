<?php 
echo $this->Html->div('titulo', 'Karamelo&#8482; Help');
echo $this->Html->div(null, null, array('style'=>'margin:10px'));
foreach ($data as $v):
    echo $this->Html->link('&rArr; '.$v['Help']['title'], '/helps/view/'.$v['Help']['id'], null, null, false).'<br />';
endforeach;
?>
</div>