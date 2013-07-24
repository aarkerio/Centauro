<?php 
echo $this->Html->script('ckeditor/ckeditor'); 
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
$this->Html->addCrumb('Comments', '/admin/commentblogs/listing');
echo $this->Html->getCrumbs(' > ');

echo $this->Form->create('Commentblog'); 
echo $this->Form->hidden('Commentblog.id'); 
?>
<fieldset>
<legend>Edit comment</legend>
<?php 
  echo $this->Form->input('Commentblog.comment', array('cols'=>90, 'rows'=>7));
  echo $this->Form->input('Commentblog.status', array('type'=>'checkbox')); 
  echo $this->Form->input('Commentblog.end', array('type'=>'checkbox'));
  echo $this->Form->end('Send');  
  echo '</fieldset>';

# ? > EOF

