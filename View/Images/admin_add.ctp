<?php echo $this->Html->script('myfunctions'); ?>

<div class="title_section">Add new image</div>

<div class="spaced">

<?php echo $this->Form->create('/images/add/','post', array("enctype"=>"multipart/form-data") ); ?>
<?php echo $this->Form->hidden('Image.user_id',$this->Session->read('Auth.User.id')); ?>
<?php echo $this->Form->hidden('return', '/users/edit'); ?>
  
<fieldset>
  <legend>Image</legend>
   
   <p>
   <?php echo $this->Form->label('Image.file', 'Title:' );?><br />
   <?php echo $this->Html->file('Image.file'); ?>
   <?php echo $this->Form->error('Image.file', 'Title is required.'); ?>
  
  <br />
  <?php echo $this->Form->end('Upload'); ?>
</fieldset>
</form>
</div>
