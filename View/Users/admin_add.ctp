<?php echo $this->Html->script('myfunctions'); ?>

<div class="spaced">

<?php echo $this->Form->create('/users/add/','post', array("onsubmit"=>"return validateUser()")); ?>
<fieldset>
  <legend>New User:</legend>
  <?php echo $this->Form->input('User/name', array('size' => 40, 'maxlength' => 60)); ?>
  <?php echo $this->Form->error('User/name', 'A name is required.'); ?>
  <br /><br />
  
  <?php echo $this->Form->label('User/status', 'Activate classroom:' );?><br />
  <?php echo $this->Form->checkbox('User/status'); ?>
  <br /><br />
  
  <?php echo $this->Form->label('User/invitation', 'Members only by invitation:' );?><br />
  <?php echo $this->Form->checkbox('User/invitation', null, array("onclick" => "showhide()")); ?>
  <br /><br />
  
  <div id="invi_code" style="display:none;">
     <?php echo $this->Form->label('User/code', 'Code:' );?><br />
     <?php echo $this->Form->input('User/code', array('size' => 4, 'maxlength' => 4)); ?>
     <br /><br />
  </div>
  
  <br />
  <?php echo $this->Form->end('Send') ?>
</fieldset>
</form>
</div>
