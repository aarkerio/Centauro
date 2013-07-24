<?php echo $this->Form->create('/admin/styles/add','post'); ?>
<fieldset>
<legend>Edit Style</legend>
   <?php echo $this->Form->textarea('Style/style', array("cols"=>90, "rows"=>40, "value"=>$style)) ?> 
   <?php echo $this->Form->error('Style/style', 'Style is required.'); ?>
   <div style="clear:both"></div>
   <?php echo $this->Form->end('Send');  ?>
</fieldset>
</form>

