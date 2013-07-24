<?php
if ($this->Session->read('Auth.User.username') )
{ 
    $this->Html->link('You are not logged in', '/users/login');
    exit();
}
echo $this->Form->create('/messages/send/', 'post'); 
echo $this->Form->hidden('Message.user_id',  array("value"=>$this->Session->read('Auth.User.id')));
echo $this->Form->hidden('Message.username', array("value"=>$this->Session->read('Auth.User.username')));
?>

<fieldset>
<legend>Write Message:</legend>
<p>
  <?php 
  
  echo$this->Session->read('Auth.User.username') . "  escribe: <br />";
  echo $this->Form->hidden('Message.sender', array("value"=>$this->Session->read('Auth.User.id')));
  
  echo $this->Form->label('Message.title', 'Asunto:' ) . "<br />";
  echo $this->Form->input('Message.title', array('size' => 35, 'maxlength' => 50));
  echo $this->Form->error('Message.title', 'Asunto is required.'); 
  
  ?>
  
</p>
  
  <?php echo $this->Form->label('Message.comment', 'Comentario:' );?><br />
  <?php echo $this->Form->textarea('Message.comment', array("cols"=>30, "rows"=>10)) ?>
  <?php echo $this->Form->error('Message.comment', 'coment is required.'); ?>
  <br />
  </p>
  
  <br />
  <?php echo $this->Form->end('Add comment') ?>
</fieldset>
</form>
</div>

