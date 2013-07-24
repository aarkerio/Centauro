<?php 
echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Form->create('Livechat'); 
echo $this->Form->hidden('Livechat.id'); 
?>
<fieldset>
<legend>Edit Livechat</legend>
 <?php 
  echo $this->Form->input('Livechat.message', array('type'=>'textarea', 'cols' => 8, 'rows' => 50));
  echo $this->Form->end('Send');  

echo '</fieldset>';

# ? > EOF



