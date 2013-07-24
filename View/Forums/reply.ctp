<div class="spaced">
<?php 
    echo $this->Html->formTag('/admin/forums/edit/', 'post'); 
    echo $this->Html->hidden('Forum/id');
?>
<fieldset>
<legend>Edit Phorums Category</legend>

<?php
    echo $this->Form->labelTag('Forum/title', 'Title:') . "<br />";
    echo $this->Html->input('Forum/title', array('size'=>60, 'maxlength'=>90));
    echo $this->Html->tagErrorMsg('Forum/title','Please enter a title.'); 
?>
<br />
<br />
<?php 
   echo $this->Form->labelTag('Forum/description', 'Description:') . "<br />"; 
   echo $this->Html->input('Forum/description', array("size" => 60, "maxlength" => 90));
   echo $this->Html->tagErrorMsg('Forum/description','Please enter a description.');
?>

<br /><br />
<?php echo $this->Form->labelTag('Forum/status', 'Status:') . "<br />"; ?>
<?php echo $this->Html->checkbox('Forum/status'); ?>
<br /><br />
<p style="clear:both"></p>
<?php echo $this->Html->submit('Update') ?>
</fieldset>
</form>
</div>

