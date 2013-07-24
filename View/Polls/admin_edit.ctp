<div class="image-info">
<?php echo $this->Form->create('Poll'); ?>
<fieldset>
<legend>Edit Poll</legend>
<?php
    echo $this->Form->hidden('Poll.id');
    echo $this->Form->input('Poll.question', array('size'=>60, 'maxlength'=>90)); 
?>
<br />
<br />
<?php echo $this->Form->label('Poll.question', 'Answers:') . '<br />'; ?>

<?php 
//print_r($this->data);

foreach ($this->data["Pollrow"] as $val) {
  //echo $val["answer"] . '<br />';
  echo $this->Form->input('Poll.answer', array('size'=>'60', 'maxlength'=>'90', 'value'=>$val['answer']));
}

?>

<br /><br />
<?php echo $this->Form->label('Poll.status', 'status:') . "<br />"; ?>
<?php echo $this->Form->checkbox('Poll.status'); ?>
<br /><br />
<p style="clear:both"></p>
<?php echo $this->Form->end('Update poll'); ?>
</fieldset>
</div>