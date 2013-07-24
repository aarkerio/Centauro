
<br />
<div class="barra">Invite to add  MonoNeuron</div>

<div id="charging" style="display:none;"><?php echo $this->Html->image('static/loading.gif', array('alt'=>"Loading")); ?></div>

<div id="already">

<?php
if ( !$this->Session->read('Auth.User.username') )
{ 
    $this->Html->link('You are not logged in', '/users/login');
    exit();
}

 echo $this->Form->create(null, 'post', array('onsubmit'=>'return false'));
 
 echo $this->Form->label('Message.string', 'Search user:' ). '<br />';
 
 echo $this->Form->input('Message.string', array('size' => 30, 'maxlength' => 45));
 
 echo $this->Js->submit('Search', array('url' => "/messages/search/", 
                                         'update'=>'updater',
                                         "loading" => "Element.show('charging');Element.hide('updater')",
                                         "complete" => "Element.hide('charging');Effect.Appear('updater')"
        ));
?>
</form>

<br /><br />


<?php        
  echo $this->Form->create(null, 'post', array('onsubmit'=>'return false')); 
  echo $this->Form->hidden('Message.sender_id',  array("value"=>$this->Session->read('Auth.User.id')));
  echo $this->Form->hidden('Message.username', array("value"=>$this->Session->read('Auth.User.username')));
?>
<fieldset>
<legend>Write Message:</legend>
  <?php 
  
  echo $this->Form->label('Message.user_id', 'Send message to:' ) . '<br />';
  
  echo '<div id="updater"></div>';
  
  echo$this->Session->read('Auth.User.username') . "  escribe: <br />";
  echo $this->Form->label('Message.title', 'Asunto:' ) . "<br />";
  echo $this->Form->input('Message.title', array('size' => 35, 'maxlength' => 50)) . "<br />";
  echo $this->Form->error('Message.title', 'Asunto is required.'); 
  
  ?>
  
</p>
  <br />
  <?php echo $this->Form->label('Message.body', 'Message:' );?><br />
  <?php echo $this->Form->textarea('Message.body', array("cols"=>30, "rows"=>10)) ?>
  <?php echo $this->Form->error('Message.body', 'Message is required.'); ?>
  <br />
  </p>
  
  <br />
  <?php
  echo $this->Js->submit('Send message', array("url" => "/messages/deliver/", 
                                         "update"=>"already",
                                         "loading" => "Element.show('charging');Element.hide('already')",
                                         "complete" => "Element.hide('charging');Effect.Appear('already')"
        )); ?>
</fieldset>
</form>
</div>

