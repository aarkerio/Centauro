<?php
echo $this->Html->div('title_section','Quick News');
echo $this->Html->para(null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new', 'title'=>'Add new')), '#', 
                                                 array('onclick'=>'hU()', 'escape'=>False))); 
echo $this->Html->div(Null, Null, array('style'=>'text-align:left;display:none;width:100%', 'id'=>'trh'));
echo $this->Form->create('Quick', array('action'=>'add')); 
?>
 <fieldset>
    <legend>Add Quick new</legend>
<?php 
 echo $this->Form->input('Quick.title', array('size'=>40, 'maxlength'=>100));
 echo $this->Form->input('Quick.reference', array('size'=>70, 'maxlength'=>300, 'value'=>'http://'));
 echo $this->Form->input('Quick.theme_id', array('options'=>$themes));
 echo $this->Form->end('Send'); 
?>
</fieldset>
</div>
<table class="tbadmin" id="tbl">
<?php
#die(print_r($data));

$th = array('Edit', 'Title', 'Votes', 'Delete');

echo $this->Html->tableHeaders($th);

foreach ($data as $val):            
       $tr = array(
           $this->Gags->sendEdit($val['Quick']['id'], 'quicks'),
		   $this->Html->link($val['Quick']['title'], $val['Quick']['reference']),
           $val['Quick']['votes'],
           $this->Gags->confirmDel($val['Quick']['id'], 'quicks')
        );
    echo $this->Html->tableCells($tr,  $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>
<script type="text/javascript"> 
<!--// 
function hU() {

var tr = document.getElementById('trh');

  if (tr.style.display == 'none')
            tr.style.display = 'block';
  else 
            tr.style.display = 'none';
}
 //-->
</script>
