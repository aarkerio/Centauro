<?php
echo $this->Form->create('/messages/contact/', 'post'); 
echo $this->Form->hidden('Message.page_id', $data["Page"]["id"]);
?>

<fieldset>
<legend>Add comment:</legend>
<p>
  <?php 
  if ($this->Session->read('Auth.User.username') ) 
  {
    echo$this->Session->read('Auth.User.username') . "  escribe: <br />";
    echo $this->Form->hidden('Message.sender', array("value"=>$this->Session->read('Auth.User.id')));
  }
  else 
  {
   echo $this->Form->hidden('Message.sender',  array("value"=>'0'));
   echo $this->Form->label('Message.username', ' Nombre (requerido)' ) . "<br />";
   echo $this->Form->input('Message.username', array('size' => 25, 'maxlength' => 50));
   echo $this->Form->error('Message.username', 'Name is required.'); 
  }
  
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

