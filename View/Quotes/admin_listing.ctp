<?php 
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' / ');
echo $this->Html->div('title_section', 'Quotes (' . count($data) .')');
 
echo $this->Html->para(null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>"Add new", 'title'=>"Add new")), '#', array('onclick'=>'hU()', 'escape'=>False))); 
?>
<div id="trh" style="margin:0;padding:0;padding-left:40px;width:80%;display:none;">
<?php echo $this->Form->create('Quote', array('action'=>'add')); ?>
 <fieldset>
 <legend>New quote</legend>
 <?php 
   echo $this->Form->input('Quote.quote', array('size' => 60, 'maxlength'=>130)); 
   echo $this->Form->input('Quote.author', array('size' => 60, 'maxlength'=>130)); 
   echo $this->Form->end('Add');
 ?>
</fieldset>
</div>

<table style="width:100%">
<?php
$th = array ('Edit', 'Quote', 'Author', 'Delete');
echo $this->Html->tableHeaders($th);

foreach ($data as $key=>$val):
    $tr = array (
        $this->Gags->sendEdit($val['Quote']['id'], 'quotes'),
        $val['Quote']['quote'],
        $val['Quote']['author'],
        $this->Gags->confirmDel($val['Quote']['id'], 'quotes')
        );
       
    echo $this->Html->tableCells($tr,  $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?> 
</table>

<script type="text/javascript"> 
<!-- 
function hU() {

var tr = document.getElementById('trh');

  if (tr.style.display == 'none')
  {
            tr.style.display = 'table-row';
  } else {
            tr.style.display = 'none';
  }
}
-->
</script>
