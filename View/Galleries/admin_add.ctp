<?php 
 $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 $this->Html->addCrumb('Gallerys', '/admin/galleries/listing'); 
 echo $this->Html->getCrumbs(' > '); 

 echo $this->Form->create('Gallery'); 
 echo $this->Form->hidden('Gallery.order', array('value'=>'1'));
?>
<fieldset>
<legend>Add Gallery</legend>
 <?php 
   echo $this->Form->input('Gallery.title', array('size' => 25, 'maxlength' => 70));
   echo '<br />';
   echo $this->Form->input('Gallery.description', array('size' => 60, 'maxlength' => 150));
   echo $this->Form->checkbox('Gallery.status',array('value' => '1'));
   echo '<div style="clear:both"></div>';
   echo $this->Form->end('Send');
  ?>
</fieldset>