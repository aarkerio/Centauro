<?php
echo $this->Html->div('menumain', 'Noticias m&aacute;s votadas');

$news = $this->requestAction('news/rankNews');
echo $this->Html->div(null, null, array('style'=>'text-align:left;'));
foreach ($news as  $val):
      echo $this->Html->link($val['News']['title'], '/news/display/'.$val['News']['id'], array('class'=>'chiki')) . '<br />';
      echo '<span style="font-size:7pt">'.$val['User']['username'].'</span><br />';
endforeach;
?>
</div>