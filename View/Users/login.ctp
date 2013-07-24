<div style="margin:10px;">
<h1>Login</h1>
<?php
if ($this->Session->check('Message.auth')):
   $this->Session->flash('auth');
endif;

echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->input('email', array('size' => 23, 'maxlength'=> 50, 'between'=>':<br />'));
echo $this->Form->input('pwd', array('between'=>'<br />', 'type' => 'password', 'label'=>'Password:', 'size' => 9, 'maxlength'=> 9));
echo $this->Form->input('remember_me', array('type'=>'checkbox', 'label'=> __('Remember me')));
echo $this->Form->end('Login');

echo $this->Html->para(null, $this->Html->link(__('Join us!'), '/users/register')); 
echo $this->Html->para(null, $this->Html->link(__('Forgot your password?'), '/recovers/recover')); 

echo '</div>';

# ? > EOF
