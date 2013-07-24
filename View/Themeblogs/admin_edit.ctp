<?php
$this->Html->addCrumb('Control Tools', '/admin/entries/start');  
$this->Html->addCrumb('Entries', '/admin/themeblogs/listing'); 
echo $this->Html->getCrumbs(' > ');

echo $this->Form->create('Themeblog', array('action'=>'edit')); 
 echo $this->Form->input('Themeblog.id', array('type' => 'hidden'));
?>
<fieldset>
<legend>Edit blog Theme</legend>
<?php
  echo $this->Form->input('Themeblog.title', array('size' => 40, 'maxlength' => 100));
  echo $this->Form->end('Update');
?>
</fieldset>
</div>