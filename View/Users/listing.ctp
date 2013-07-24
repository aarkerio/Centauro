
<table class="tbadmin">
<?php
$th = array ('Blog', 'Created');

echo "<b>".$this->Html->tableHeaders($th)."</b>";	

foreach ($data as $val):
    $tr = array (
        $this->Html->link($val['User']['username'], '/blog/'.$val['User']['username']),
        $val['User']['created'] = $time->timeAgoInWords($val['User']['created']),


        );
     
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?> 
</table>
<?php
$t  = $this->Html->div(null,$this->Paginator->prev('«'. __('Previous', True).' ',null,null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(null, $this->Paginator->next(' '.__('Next', True).' »', null, null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo  $this->Html->div(null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));
# ? >