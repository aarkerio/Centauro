<?php 
 echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 echo $this->Html->getCrumbs(' / ');
 echo $this->Html->div('title_section', 'What were you doing?');
 echo $this->Form->create('Wayding', array('action'=>'edit')); 
?>
 <fieldset>
 <legend>WAYD</legend>
 <?php 
   echo $this->Form->input('Wayding.task', array('size' => 60, 'maxlength'=>130, 'label'=>'What are you doing?')); 
   echo $this->Form->end('Add');
 ?>
</fieldset>
<table style="width:100%">
<tr>
<td colspan="4">
<?php 
echo $this->Gags->imgLoad('loading');
echo$this->Gags->ajaxDiv('editing'). $this->Gags->divEnd('editing');
?>
</td>
</tr>
<?php
$th = array ('Edit', 'Wayding', 'Date', 'Delete');
echo $this->Html->tableHeaders($th);

//var_dump($data);
foreach ($data as $key=>$val):
    $tr = array (
        $this->Gags->sendEdit($val['Wayding']['id'], 'waydings'),
        $val['Wayding']['task'],
        $val['Wayding']['created'],
        $this->Gags->confirmDel($val['Wayding']['id'], 'waydings')
        );
       
    echo $this->Html->tableCells($tr, array('class'=>"altRow", "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow',"onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='evenRow'"));
endforeach;
?> 
</table>
