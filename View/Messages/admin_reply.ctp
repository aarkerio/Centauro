<?php
  echo $this->Form->create(null, 'post',        array('onsubmit'=>'return chkData()')); 
  echo $this->Form->hidden('Message.username',   array("value"=>$this->Session->read('Auth.User.username')));
  echo $this->Form->hidden('Message.sender_id',  array("value"=>$this->Session->read('Auth.User.id')));
  echo $this->Form->hidden('Message.message_id', array("value"=>$data["message_id"]));
  echo $this->Form->hidden('Message.user_id',    array("value"=>$data["user_id"]));     // the change was made on admin_display.thtml
?>
<fieldset>
<legend>Reply</legend>
  <?php 
  echo$this->Session->read('Auth.User.username') . "  writes: <br />";
  echo $this->Form->label('Message.title', 'Asunto:' ) . "<br />";
  echo $this->Form->input('Message.title', array('size' => 35, 'maxlength' => 50, "value"=> 'Re: ' . $data['title'])) . "<br />";
  echo $this->Form->error('Message.title', 'Asunto is required.'); 
  ?>  
</p>
  <br />
  <?php echo $this->Form->label('Message.body', 'Message:' );?><br />
  <?php echo $this->Form->textarea('Message.body', array("cols"=>50, "rows"=>10, "value"=>$data["sender"] . ' wrote: ' .$data["body"])) ?>
  <?php echo $fck->load('Message.body', 'Basic', 700, 500); ?> 
  <?php echo $this->Form->error('Message.body', 'Message is required.'); ?>
  <br />
  </p>
  
  <div style="clear:both"></div>
  <?php
  echo $this->Js->submit('Reply', array("url" => "/admin/messages/add", 
                                         "update"=>"setform",
                                         "loading" => "Element.show('charging');Element.hide('setform')",
                                         "complete" => "Element.hide('charging');Effect.Appear('setform')"
        ));
  ?>
</fieldset>
</form>
</div>

