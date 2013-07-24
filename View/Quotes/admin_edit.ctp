<?php 
echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->addCrumb('Quote', '/admin/quotes/listing');  
echo $this->Html->getCrumbs(' > '); 

echo $this->Form->create('Quote'); 
echo $this->Form->hidden('Quote.id'); 
?>
<fieldset>
<legend>Edit new</legend>
 <?php 
   echo $this->Form->input('Quote.quote', array('size' => 60, 'maxlength' => 150));
   echo $this->Form->input('Quote.author', array('size' => 25, 'maxlength' => 70));
   echo $this->Form->end('Send');  
?>
</fieldset>


