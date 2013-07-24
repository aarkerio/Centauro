<?php 
  $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
  $this->Html->addCrumb('Podcasts', '/admin/podcasts/listing');
  echo $this->Html->getCrumbs(' / '); 
?>

<div class="title_section">Edit share</div>

<div class="spaced"> 

<?php echo $this->Form->create('/admin/podcasts/add/','post', array("enctype"=>"multipart/form-data") ); ?>

<fieldset>
  <legend>New podcast</legend>
   <p>
   <?php echo $this->Form->label('Podcast/file', 'MP3 File:' );?><br />
   <?php echo $this->Html->file('Podcast/file'); ?>
   <?php echo $this->Form->error('Podcast/file', 'Title is required.'); ?>
   
   <?php echo $this->Form->hidden('Podcast/user_id',$this->Session->read('Auth.User.id')) ?>
  </p>
  <p>
   <?php echo $this->Form->label('Podcast/status', 'Publish:' );?><br />
   <?php echo $this->Form->checkbox('Podcast/status', null, array("onclick" => "showhide()")); ?>
  <br /><br /></p>
  
  <p>
  <?php echo $this->Form->label('Podcast/created', 'Created:' );?>
  <br />
  <?php
      echo $this->Html->dayOptionTag('Podcast/created', null, date("d"), null, null, false);
      echo $this->Html->monthOptionTag('Podcast/created', null, date("m"), null, null, false);
      echo $this->Html->yearOptionTag('Podcast/created', null, 1920, 2017, date("Y"), null, null, false);
  ?>

<br /><br />
</p>
 
  <p>
     <?php echo $this->Form->label('Podcast/title', 'Title:' );?><br />
     <?php echo $this->Form->input('Podcast/title', array('size' => 25, 'maxlength' => 50, 'class'=>"formas")); ?>
     <br /><br />
  </p>
  <p>
    <?php echo $this->Form->label('Podcast/description', 'Description:' );?><br />
    <?php echo $this->Form->textarea('Podcast/description', array("rows"=>10, "cols"=>40)) ?>
  </p>
  <br />
  <?php echo $this->Form->end('Upload'); ?>
</fieldset>
</form>
</div>
