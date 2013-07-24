<?php 
echo $this->Html->script('ckeditor/ckeditor'); 
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
$this->Html->addCrumb('News', '/admin/news/listing');
echo $this->Html->getCrumbs(' > ');

echo $this->Form->create('Comentblog'); 
echo $this->Form->hidden('Comentblog.id'); 
?>
<fieldset>
<legend>Edit comment</legend>
<?php 
  echo $this->Form->input('Comentblog.comment', array('cols'=>90, 'rows'=>12));
  echo $this->Form->input('Comentblog.status', array('type'=>'checkbox')); 
  echo $this->Form->input('Comentblog.end', array('type'=>'checkbox'));
  echo $this->Form->end('Send');  
?>
</fieldset>
