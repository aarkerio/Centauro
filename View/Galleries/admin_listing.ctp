<?php 
#die(debug($data));
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > '); 
echo $this->Html->div(null);
echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new page', 'title'=>'Add new page')), '/admin/galleries/add', array('escape'=>False)). '  ';
echo $this->Html->link($this->Html->image('static/icon_categories.gif', array('alt'=>'Comments', 'title'=>'Comments')),'/admin/comentphotos/listing',array('escape'=>False));
?>
</div>
<table class="tbadmin">
<?php

$th = array ('Edit', 'See', 'Title', 'Status', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val): 
    $tr = array (
        $this->Gags->sendEdit($val['Gallery']['id'], 'galleries'),
        $this->Html->link($this->Html->image('admin/eye_icon.gif', array('alt'=>"See ". $val['Gallery']['title'], 
                          'title'=>"See ". $val['Gallery']['title'])), '#',   
                           array('onclick'=>"window.open('/galleries/display/".$this->Session->read('Auth.User.username').", 
                                  null, 'status=1,toolbar=1,scrollbars=1,height=600,width=800';)", 'escape'=>False)),
        $this->Html->link($val['Gallery']['title'], '/admin/photos/listing/'.$val['Gallery']['id']),
        $this->Gags->setStatus($val['Gallery']['status']),
        $this->Gags->confirmDel($val['Gallery']['id'], 'galleries')
        );
       
    echo $this->Html->tableCells($tr,  $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>
