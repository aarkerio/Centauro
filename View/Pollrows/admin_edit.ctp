<?php 
#die( debug( $data ) ); 
echo $this->Html->script('myfunctions');
echo $this->Html->div('spaced');
echo $this->Form->create('Pollrow'); 
echo $this->Form->hidden('Pollrow.id');
#echo $this->Form->hidden('Pollrow.return', '/pollrows/edit'); 
?>
<fieldset>
  <legend>Polls Question</legend>
  <?php echo $this->Form->label('Pollrow.answer', 'Pollrowname:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.username', array('size'=>9, 'maxlength'=>12)); ?>
  <?php echo $this->Form->error('Pollrow.username', 'A username is required.'); ?>
  <br /><br />
  
  <?php echo $this->Form->label('Pollrow.name', 'Name:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.name', array('size' => 35, 'maxlength'=>50)); ?>
  <?php echo $this->Form->error('Pollrow.name', 'A name is required.'); ?>
  <br /><br />
  
   <?php echo $this->Form->label('Pollrow.email', 'Email:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.email', array('size' => 15, 'maxlength'=>50)); ?>
  <?php echo $this->Form->error('Pollrow.email', 'An email is required.'); ?>
  <br /><br />
  
  <p><?php echo $this->Form->label('Pollrow.group_id', 'Group:' );?>
  <br />
      <?php 
      /*$this->Form->select(
      $fieldName,
      $optionElements,
      $selected = null,
      $selectAttr = array(),
      $optionAttr = null,
      $showEmpty = true,
      $return = false	 
      selectTag ($fieldName, $optionElements, $selected=null, $selectAttr=array(), $optionAttr=null, $showEmpty=true, $return=false)
      */
      echo $this->Form->select('Pollrow.group_id', $Groups);
      ?>
  </p>
  
  <?php echo $this->Form->label('Pollrow.website', 'Website:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.website', array('size'=>35, 'maxlength'=>50,"value"=>"http://")); ?>
  <br /><br />
  
  <?php echo $this->Form->label('Pollrow.style', 'Style:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.style', array('size' => 35, 'maxlength' => 50)); ?>
  <?php echo $this->Form->error('Pollrow.style', 'A name is required.'); ?>
  <br /><br />
  
  <?php echo $this->Form->label('Pollrow.cv', 'Profile:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.cv', array('size' => 35, 'maxlength' => 250)); ?>
  <?php echo $this->Form->error('Pollrow.cv', 'CV is required.'); ?>
  <br /><br />
  
  <?php echo $this->Form->label('Pollrow.quote', 'Quote:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.quote', array('size' => 40, 'maxlength' => 150)); ?>
  <?php echo $this->Form->error('Pollrow.quote', 'A name is required.'); ?>
  <br /><br />
 
  <?php echo $this->Form->label('Pollrow.name_blog', 'Name Blog:' );?><br /> 
  <?php echo $this->Form->input('Pollrow.name_blog', array('size' => 45, 'maxlength' => 150)); ?>
  <?php echo $this->Form->error('Pollrow.name_blog', 'A name_blog is required.'); ?>
  <br /><br />  
  
  <p><?php echo $this->Form->end('Update') ?></p>
</fieldset>
</form>
</div>

<div class="spaced">

<?php echo $this->Form->create('/pollrows/avatar', 'post', array("enctype"=>"multipart/form-data") ); ?>
<?php echo $this->Form->hidden('Pollrow.id'); ?>
<fieldset>
  <legend>Upload new avatar</legend>
  <br />
   <p>An image 30 x 40 pixels</p>
   <p>
   <?php echo $this->Form->label('Pollrow.file', 'Avatar:' );?><br />
   <?php echo $this->Html->file('Pollrow.file'); ?>
   <?php echo $this->Form->error('Pollrow.file', 'Title is required.'); ?>
  
  <br />
  <?php echo $this->Form->end('Upload'); ?>
</fieldset>
</form>
</div>
