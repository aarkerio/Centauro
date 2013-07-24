<?php
#die(debug($data));
echo $this->Html->div('cintillo', 'Noticias');
echo $this->Html->div('barra', 'Noticias del mundo libre');
echo $this->element('new', array('cache' => False, 'val'=>$data, 'frontend'=>False));

# ? > EOF   


