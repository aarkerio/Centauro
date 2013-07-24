<?php 
echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Form->create('Wayding'); 
echo $this->Form->hidden('Wayding.id'); 
?>
<fieldset>
<legend>Edit new</legend>
 <?php 
   echo $this->Form->input('Wayding.task', array('size' => 80, 'maxlength' => 250));
   echo $this->Form->end('Send');  
?>
</fieldset>


