<script type="text/javascript">
   window.onload = timedMsg;
</script>
<?php echo $this->Session->flash(); ?>
<div class="title_section">Contacts</div>

<p>
<?php echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>"Add new", 'title'=>"Add new")), '/admin/contacts/add', null, false, false) ?></p>

<table class="tbadmin" style="width:100%">
<?php
//die(print_r($data));

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
       
    echo $this->Html->tableCells($tr, array('class'=>"altRow", "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow',"onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='evenRow'"));
    
endforeach;
?>
</table>
<?php 
//echo $pagination; 
?>
