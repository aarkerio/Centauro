<?php 
 echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 echo $this->Html->addCrumb('Bookmark', '/admin/bookmarks/listing');  
 echo $this->Html->getCrumbs(' > '); 

 echo $this->Form->create('Bookmark');
 echo $this->Form->hidden('Bookmark.id'); 
?>
<fieldset>
<legend>Edit Bookmark</legend>
 <?php 
   echo $this->Form->input('Bookmark.name', array('size' => 50, 'maxlength' => 50));
   echo $this->Form->input('Bookmark.url', array('size' => 70, 'maxlength' => 299));
   echo $this->Form->end('Send');  
?>
</fieldset>

