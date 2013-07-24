<?php
$this->set('title_for_layout', 'Sections');
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' / ');
echo $this->Html->div('title_section', 'Sections (' . count($data) .')');
 
echo $this->Html->para(Null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new', 'title'=>'Add new')),'#', 
array('onclick'=>'hU()', 'escape'=>False))); 
?>
<div id="trh" style="margin:0;padding:0;padding-left:40px;width:80%;display:none;">
    <?php echo $this->Form->create('Section', array('action'=>'edit', 'type'=>'file')); ?>
 <fieldset>
 <legend>New section</legend>
 <?php 
   echo $this->Form->input('Section.description', array('size' => 60, 'maxlength'=>130)); 
   echo $this->Form->input('Section.img', array('type' => 'file')); 
   echo $this->Form->end('Add');
 ?>
</fieldset>
</div>

<table style="width:100%">
<?php
$th = array ('Edit', 'Section', 'Avatar', 'Delete');
echo $this->Html->tableHeaders($th);

foreach ($data as $key=>$val):
    $tr = array (
        $this->Gags->sendEdit($val['Section']['id'], 'sections'),
        $val['Section']['description'],
        $this->Html->image('secs/'.$val['Section']['img'], array('width'=>'25px','alt'=>$val['Section']['description'], 'title'=> $val['Section']['description'])),
        $this->Gags->confirmDel($val['Section']['id'], 'sections')
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
