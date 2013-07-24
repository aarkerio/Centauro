<?php 
 $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 $this->Html->addCrumb('Gallerys', '/admin/galleries/listing'); 
 echo $this->Html->getCrumbs(' > '); 

 echo $this->Form->create('Gallery',  array('action'=>'edit'));
 echo $this->Form->hidden('Gallery.id');
?>
<fieldset>
<legend>Edit Gallery</legend>
 <?php 
   echo $this->Form->input('Gallery.title', array('size' => 25, 'maxlength' => 70));
   echo '<br />';
   echo $this->Form->input('Gallery.description', array('size' => 60, 'maxlength' => 150));
echo $this->Form->input('Gallery.status',array('type'=>'checkbox', 'value' => '1', 'label'=>'Status'));
   echo '<div style="clear:both"></div>';
   echo $this->Form->end('Send');
  ?>
</fieldset>