<div id="login" style="text-align:left;padding:4px;border:1px dotted gray;float:center;"> 
<?php echo  $this->Form->create('User', array('action'=>'login')); ?>
<fieldset>
<legend><?php __('Login'); ?></legend>
  <?php 
   echo  $this->Form->input('User.email', array('size' => 15, 'maxlength'=> 45, 'between'=>'<br />')) . '<br />';
   echo  $this->Form->label('User.pwd', 'Password').'<br />';
   echo  $this->Form->password('User.pwd', array('id' => 'user_pwd', 'size' => 9, 'maxlength' => 9)) . '<br />';
   echo  $this->Form->label('User.remember_me', __('Remember me', true));
   echo  $this->Form->checkbox('User.remember_me');
   echo  $this->Form->end('Login'); 
 ?>
 </fieldset>

 <?php 
   echo $this->Html->div(null, $this->Html->link(__('Join us!', true), '/users/register', array('style'=>'font-size:7pt;'))); 
   echo $this->Html->div(null, $this->Html->link(__('Forgot your password?', true), '/recovers/recover', array('style'=>'font-size:7pt;'))) ; 
 ?>
 </div>
