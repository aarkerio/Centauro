<?php

echo $this->Html->div('title_section', 'Contacts');

echo  $this->Html->div(Null, $this->Html->link($this->Html->image('admin/icon_export.gif', array('alt'=>'Export Contacts', 'title'=>'Export Contacts to LDIF format')), '/admin/contacts/export/'.$this->Session->read('Auth.User.username'), array('escape'=>False)), array('style'=>'float:right;width:300px;')); 

echo $this->Html->para(Null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new', 'title'=>'Add new')), '/admin/contacts/add', array('escape'=>False))); 

echo '<table class="tbadmin" style="width:100%">';

$th = array ('Edit', 'First Name', 'Last Name', 'Email', 'WorkPhone', 'CellPhone', 'See all data', 'Delete');

echo $this->Html->tableHeaders($th);	

foreach ($data as $key=>$val):   
    $tr = array (
        $this->Gags->sendEdit($val['Contact']['id'], 'contacts'),
        $val['Contact']['firstname'],
        $val['Contact']['lastname'],
        $val['Contact']['email1'],
        $val['Contact']['workphone'],
        $val['Contact']['cellphone'],
        $this->Html->link($this->Html->image('admin/icon-mg.png', array('alt'=>'See data', 'title'=>'See data')), '/admin/contacts/single/'.$val['Contact']['id'], array('escape'=>False)),
        $this->Gags->confirmDel($val['Contact']['id'], 'contacts')
        );
 
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;

echo '</table>';

# echo $pagination; 
# ? > EOF

