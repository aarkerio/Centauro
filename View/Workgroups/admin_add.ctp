
<?php echo $this->Html->script('myfunctions'); ?>

<div>
<?php echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); ?> 
<?php echo $this->Html->getCrumbs(' / '); ?>
</div>
<div class="title_section">Add New Workgroup</div>

<div class="spaced">

<?php echo $this->Form->create('/admin/workgroups/add/','post'); ?>
<fieldset>
  <legend>New Workgroup</legend>
  
  <?php echo $this->Form->label('Workgroup/title', 'Title:' );?><br />
  <?php echo $this->Form->input('Workgroup/title', array('size' => 40, 'maxlength' => 60)); ?>
  <?php echo $this->Form->error('Workgroup/title', 'A phorum title is required.'); ?>
  <p>
    <?php echo $this->Form->label('Workgroup/description', 'Description:' );?><br />
    <?php echo $this->Form->textarea('Workgroup/description', array("rows" => 8, "cols" => 40)); ?>
    <?php echo $this->Form->error('Workgroup/description', 'A phorum description is required.'); ?>
  </p>
  <br />
     <?php echo $this->Form->label('Workgroup/access', 'This a public workgroup:') . $this->Form->checkbox('Workgroup/access', array('value'=>'1')); ?><br />
     <?php echo $this->Form->label('Workgroup/status', 'Activate Workgroup:') . $this->Form->checkbox('Workgroup/status', array('value'=>'1')); ?><br />
  <p><br />
  <?php echo $this->Form->end('Send') ?></p>
</fieldset>
</form>
</div>
