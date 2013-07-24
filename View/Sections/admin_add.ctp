<?php echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); ?> 
<?php echo $this->Html->addCrumb('Sections', '/admin/pages/sections'); ?> 
<?php echo $this->Html->getCrumbs(' / '); ?>

<?php echo $this->Form->create('/admin/sections/edit/','post'); ?>

<?php echo $this->Form->hidden('Section/order', array('value'=>'1')); ?>

<fieldset>
<legend>Add Section</legend>
 <?php 
   echo $this->Form->label('Section/description', 'Name:' ); 
   echo $this->Form->input('Section/description', array('size' => 60, 'maxlength' => 150));
   echo $this->Form->error('Section/name', 'Name is required.'); 
   
   echo $this->Form->label('Section/img', 'Image:' ); 
   echo $this->Form->input('Section/img', array('size' => 25, 'maxlength' => 70));
   echo $this->Form->error('Section/img', 'img is required.'); 
 ?>

  <?php echo $this->Form->end('Send');  ?>
</fieldset>
</form>

