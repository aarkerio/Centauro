<?php 
   $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
   $this->Html->addCrumb('Sections', '/admin/pages/sections');  
   echo $this->Html->getCrumbs(' > '); 
   echo $this->Form->create('Section');
   echo $this->Form->hidden('Section.id'); 
?>
<fieldset>
<legend>Edit Section</legend>
<?php  
 echo $this->Form->input('Section.description', array('size' => 60, 'maxlength' => 150));
 echo $this->Form->end('Send');  
?>
</fieldset>

