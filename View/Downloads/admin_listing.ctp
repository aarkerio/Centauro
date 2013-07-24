<?php 
$this->set('title_for_layout', 'Downloads');

echo $this->Html->div('title_section', 'Downloads');
    
echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add download', 'title'=>'Add download')), '/admin/downloads/edit', array('escape'=>False));
?>
<table class="tbadmin">
<?php
$th = array ('Edit', 'Title', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val):
    $tr = array (
        $this->Gags->sendEdit($val['Download']['id'], 'downloads'),
        $val['Download']['title'],
        $this->Gags->confirmDel($val['Download']['id'], 'downloads')
        );       
    echo $this->Html->tableCells($tr,  $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>
