<?php
echo $this->Html->div('menumain', 'Secciones');
echo $this->Html->div(Null, Null, array('style'=>'text-align:center;'));
$sections = $this->requestAction('sections/display');
foreach ($sections as $val):
   echo $this->Html->link($this->Html->image('secs/'.$val['Section']['img'], array('alt'=>$val['Section']['description'], 'title'=>$val['Section']['description'], 
                                 'width'=>50, 'style'=>'border:1px solid gray;width:50px;margin-left:auto;margin-rigth:auto;float:center')), 
                                 '/pages/section/' .$val['Section']['id'], array('escape'=>False));
   echo '<br />';
   echo $this->Html->link($val['Section']['description'], '/pages/section/' .$val['Section']['id'], array('class'=>'chiki'));
   echo '<br />';
endforeach;
?>
</div>
