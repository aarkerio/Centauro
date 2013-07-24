<?php 
 echo $this->Html->addCrumb('Control Tools', '/admin/entries/start');  
 echo $this->Html->addCrumb('Messages', '/admin/messages/listing'); 
 echo $this->Html->getCrumbs(' > '); 

 echo $this->Html->div('title_section', 'Write message to another MonoNeuron');
echo $this->Gags->imgLoad('charging');
?>

<div id="already">
<?php        
  echo$this->Form->create(); 
  echo $this->Form->hidden('Message.sender_id',  array('value'=>$this->Session->read('Auth.User.id')));
  echo $this->Form->hidden('Message.username', array('value'=>$this->Session->read('Auth.User.username')));
?>
<fieldset>
<legend>Write Message:</legend>
  <?php 
  
  echo $this->Form->label('Message.user_id', 'Send message to' ) . '<br />';
  
  echo '<div id="updater"></div>';
  
  echo $this->Session->read('Auth.User.username') . "  escribe: <br />";
  echo $this->Form->input('Message.title', array('size' => 35, 'maxlength' => 50)) . "<br />";

  echo $this->Form->label('Message.body', 'Message');
  echo $this->Form->textarea('Message.body', array('cols'=>50, 'rows'=>8));
  echo $this->Form->error('Message.body', 'Message is required.'); 
?>
  
  
  <div style="clear:both"></div>
  <?php
  echo $this->Js->submit('Send message', array("url" => "/messages/deliver/", 
                                         "update"=>"already",
                                         "before" => "MyFCKObject.UpdateEditorFormValue();",
                                         "loading" => "Element.show('charging');Element.hide('already')",
                                         "complete" => "Element.hide('charging');Effect.Appear('already')"
        )); ?>
</fieldset>
</form>
</div>
