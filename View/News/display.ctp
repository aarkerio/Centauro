<?php
$this->set('title_for_layout', 'Hacktivismo'); 
$this->Html->div('cintillo', 'Noticias');
$this->Html->div('barra','Noticias del mundo libre');
#exit(print_r($data));
foreach( $data as $val):
    echo $this->element('new', array('cache' => False, 'val'=>$val, 'frontend'=>True));
endforeach;

$t  = $this->Html->div(Null,$this->Paginator->prev('«'. __('Previous').' ',null,null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(Null, $this->Paginator->next(' '.__('Next').' »', null, null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(Null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo  $this->Html->div(Null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));

# ? > EOF
