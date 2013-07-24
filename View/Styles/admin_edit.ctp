<?php 
$this->Html->addCrumb('Control Tools', '/admin/entries/start');  
echo $this->Html->getCrumbs(' > ');

echo $this->Form->create('Style');
echo $this->Form->hidden('Style.id');
?>
<fieldset>
<legend>Edit Style</legend>
<?php 
 echo $this->Form->input('Style.style', array('cols'=>90, 'rows'=>40));
 echo $this->Form->end('Save');  
?>
</fieldset>

