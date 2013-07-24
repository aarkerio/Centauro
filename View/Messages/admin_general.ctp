<?php echo $this->Html->script('fckeditor/fckeditor'); ?>
<?php echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); ?> 
<?php echo $this->Html->addCrumb('Messages', '/admin/messages/listing'); ?>
<?php echo $this->Html->getCrumbs(' / '); ?>

<div class="barra">Write message to all portal members.</div>

<div id="charging" style="display:none;"><?php echo $this->Html->image('static/loading.gif', array('alt'=>"searching")); ?></div>

<div id="already">

<?php        
  echo $this->Form->create('/admin/messages/general', 'post', array('onsubmit'=>'return chkData()')); 
  echo $this->Form->hidden('Message.username', array("value"=>$this->Session->read('Auth.User.username')));
?>
<fieldset>
<legend>Write General Message</legend>
  <?php 
  echo$this->Session->read('Auth.User.username') . "  writes: <br />";
  echo $this->Form->label('Message.title', 'Asunto:' ) . "<br />";
  echo $this->Form->input('Message.title', array('size' => 35, 'maxlength' => 50)) . "<br />";
  echo $this->Form->error('Message.title', 'Asunto is required.'); 
  ?>
  
</p>
  <br />
  <?php echo $this->Form->label('Message.body', 'Message:' );?><br />
  <?php echo $this->Form->textarea('Message.body', array("cols"=>30, "rows"=>10)) ?>
  <?php echo $fck->load('Message.body', 'Basic', 500, 200); ?>
  <?php echo $this->Form->error('Message.body', 'Message is required.'); ?>
  <br />
  </p>
  
  <div style="clear:both"></div>
  <?php
  echo $this->Form->end('Send message'); ?>
</fieldset>
</form>
</div>
