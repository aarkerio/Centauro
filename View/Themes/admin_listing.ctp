<?php
echo $this->Html->div('title_section', 'Themes');

echo $this->Html->para(Null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add entry', 'title'=>'Add entry')), '#', array('escape'=>False, 'onclick'=>'showHide()')) );
?>
<div id="add" style="display:none">
<?php echo $this->Form->create('Themes',array('type'=>'file') ); ?>
  
<fieldset>
  <legend>New Theme</legend>
 <?php 
   echo $this->Form->input('Theme.file', array('type'=>'file'));
   echo $this->Form->input('Theme.theme', array('size' => 30, 'maxlength' => 40));
   echo $this->Form->input('Theme.description', array('size' => 40, 'maxlength' => 150));   
   echo $this->Form->end('Send'); 
?>
</fieldset>
</form>
</div>
<table style="width:100%;border-collapse:collapse;paddin:4px">
<?php
$th = array('Edit', 'Name', 'Description', 'Image', 'Delete');

echo $this->Html->tableHeaders($th);	
foreach ($data as $val):
    $tr = array (
        $this->Gags->sendEdit($val['Theme']['id'], 'themes'),
        $val['Theme']['theme'],
        $val['Theme']['description'],
        $this->Html->link($this->Html->image('themes/'.$val['Theme']['img'], 
                array('alt'=>$val['Theme']['theme'], 'title'=>$val['Theme']['theme'], 'width'=>40)), 
                '/img/themes/'.$val['Theme']['img'], array('escape'=>False)),
        $this->Gags->confirmDel($val['Theme']['id'], 'themes')
        );
       
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>

<script lenguage="javascript">
<!--
function showHide() 
{
    var target1 =  document.getElementById('add');
    
    if (target1.style.display=="none") 
    {
        target1.style.display ="block";
    } else {
        target1.style.display ="none";
    }
}
</script>
