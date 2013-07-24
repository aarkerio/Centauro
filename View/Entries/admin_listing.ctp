<?php
echo $this->Html->div('title_section','Entries');

$this->Html->addCrumb('Control Tools', '/admin/entries/start');  
echo $this->Html->getCrumbs(' > ');

echo $this->Html->div(Null); 
echo $this->Html->image('admin/new.gif', array('alt'=>'Add entry','title'=>'Add entry','url'=>array('controller'=>'entries','action'=>'edit'))). ' ';
echo $this->Html->image('static/icon_categories.gif', array('alt'=>'Themes', 'title'=>'Themes','url'=>array('controller'=>'themeblogs','action'=>'listing')));
echo '</div>';

echo '<table class="tbadmin">';

$th = array ('Edit', 'Title', 'Status', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val):
       $status = $this->Gags->setStatus($val['Entry']['status']);
       
       $tr = array (
        $this->Gags->sendEdit($val['Entry']['id'], 'entries'),
        $val['Entry']['title'],
        $this->Html->link($status, '/admin/entries/change/'.$val['Entry']['id'].'/'.$val['Entry']['status']),
        $this->Gags->confirmDel($val['Entry']['id'], 'entries')
        );
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;
echo '</table>';

$t  = $this->Html->div(Null,$this->Paginator->prev('«'. __('Previous').' ',Null,Null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(Null,$this->Paginator->next(' '.__('Next').' »',Null,Null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(Null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo  $this->Html->div(Null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));

# ? > EOF


