<?php echo $this->Form->create('Poll'); ?>
<fieldset>
<legend>New Poll</legend>
  <?php echo $this->Form->input('Poll.question', array('size' => 60, 'maxlength'=>130)); ?>

<div style="margin:15px auto 15px auto;border:1px dotted gray;padding-left:40px;width:80%;">
  <?php 
     for ($i=1;$i<7;$i++): 
          echo $this->Form->input('Row.answer'.$i, array('size' => 50, "maxlenght"=>100));  
     endfor;
  ?>
</div>
<?php 
  echo $this->Form->label('Poll.status', 'Published') . "<br />"; 
  echo $this->Form->checkbox('Poll.status'); 
?>
<div style="clear:both"></div>
<?php echo $this->Form->end('Save'); ?>
</fieldset>
