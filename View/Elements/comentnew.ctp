<div class="temas" style="text-align:center;">Opinión</div>

<?php echo $this->Form->create('/comentnews/add/','post', array("onsubmit"=>"return validateNew()")); ?>

<fieldset>
<p>
  <?php 
  if ( $this->Session->read('Auth.User.username') ):
      echo $this->Session->read('Auth.User.username') . "  escribe:";
      //echo $this->Form->hidden('Comentnew.user_id',$this->Session->read('Auth.User.id'));
  else:
      echo $this->Form->label('Comentnew.name', 'Nombre:' ) . "<br />"; 
      echo $this->Form->input('Comentnew.name', array('size' => 40, 'maxlength' => 50, 'class'=>"formas"));
      echo $this->Form->error('Comentnew.name', 'Name is required.'); 
  endif;
  ?>
  <br /><br />
</p>
  
  <p>
  <?php echo $this->Form->label('Comentnew.category_id', 'Category' );?>
      <br />
      
  </p>
  <?php echo $this->Form->label('Comentnew.Body', 'Body:' );?><br />
  <?php echo $this->Form->textarea('Comentnew.body', array('class'=>"formas", "cols"=>80, "rows"=>45)) ?>
  <?php echo $fck->load('Comentnew.body', 'Karamelo'); ?> 
  <?php echo $this->Form->error('Comentnew.body', 'Body is required.'); ?>
  <br />
  </p>
  
  <p><?php echo $this->Form->label('Comentnew.status', 'Published:' );?><br />
  <?php echo $this->Form->checkbox('Comentnew.status'); ?>
  <br /></p>
  
  
  <br />
  <?php echo $this->Form->end('Add comment') ?>
</fieldset>
</form>
</div>
