<?php
 echo $this->Html->div('title_section', 'Themes');
 echo '<div id="add">';
 echo $this->Form->create('Themes', array('action'=>'edit','enctype'=>'multipart/form-data'));
 echo $this->Form->hidden('Theme.id');
?>
<fieldset>
 <legend>Edit Theme</legend>
 <?php 
 # echo $this->Form->input('Theme.file', array('type' => 'file'));
  echo $this->Form->input('Theme.theme', array('size' => 40, 'maxlength' => 80));
  echo $this->Form->input('Theme.description', array('size' => 40, 'maxlength' => 150));
  echo $this->Form->end('Send'); 
?>
</fieldset>
</form>
</div>
