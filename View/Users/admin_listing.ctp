<?php 
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > '); 
echo  $this->Html->div('title_section', 'Users');
?>
<table class="tbadmin">
<?php
$th = array ('Edit', 'Blog', 'Created', 'Email', 'Status', 'Delete');

echo $this->Html->tableHeaders($th);	

foreach ($data as $val):
    $status = ($val['User']['active'] == 0) ? 'Inactive' : 'Active';
    
    $S   = ($this->Session->read('Auth.User.group_id') == 1)  ? $this->Html->link($status, '/admin/users/change/'.$val['User']['id'] .'/'. $val['User']['active']) : $status;
    
    $tr = array (
        $this->Gags->sendEdit($val['User']['id'], 'users'),
        $this->Html->link($val['User']['username'], '/blog/'.$val['User']['username']),
        $val['User']['created'],
        $val['User']['email'],
        $S,
        $this->Gags->confirmDel($val['User']['id'], 'users')
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