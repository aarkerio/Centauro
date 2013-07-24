<?php 
echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->addCrumb('Quick', '/admin/quotes/listing');  
echo $this->Html->getCrumbs(' > '); 

echo $this->Form->create('Quick'); 
echo $this->Form->hidden('Quick.id'); 
?>
<fieldset>
<legend>Edit new</legend>
 <?php 
   echo $this->Form->input('Quick.title', array('size'=>40, 'maxlength'=>100));
   echo $this->Form->input('Quick.reference', array('size'=>70, 'maxlength'=>300));
   echo $this->Form->label('Quick.theme_id', 'Theme').'<br />';
   echo $this->Form->select('Quick.theme_id', $themes, null, array(), false);
   echo $this->Form->end('Send');  
?>
</fieldset>


