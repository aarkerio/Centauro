<div class="title_section">WorkGroups</div>

<p><?php echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>"Add new", 'title'=>"Add new")), '/admin/workgroups/add', null, false, false) ?></p>

<table class="tbadmin" style="width:100%">

<?php
//die(print_r($data));

$th = array ('Edit', 'Title', 'Status', 'Acces', 'Invite', 'Delete');

echo $this->Html->tableHeaders($th);

foreach ($data as $key=>$val)
    {
       
       $tr = array (
        $this->Gags->sendEdit($val['Workgroup']['id'], 'workgroups'),
        $val['Workgroup']['title'],
        $val['Workgroup']['status'],
        $val['Workgroup']['access'],
        $this->Html->link('Invite someone', '/admin/workgroups/invite/'.$val['Workgroup']['id']),
        $this->Gags->confirmDel($val['Workgroup']['id'], 'workgroups')
        );
       
    echo $this->Html->tableCells($tr, array('class'=>"altRow", "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow',"onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='evenRow'"));
    
    }
?>
</table>

<?php 
//echo $pagination; 
?>

