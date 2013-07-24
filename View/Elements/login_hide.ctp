<!-- hide by default -->
<div id="cover" style="display:none;" onclick="ocultar()">
   
</div>
<div id="loginpopup" style="display:none">
<div style="border:3px solid orange; vertical-align: top; padding:3px 10px 4px 4px">
<?php 
echo $this->Html->div(null,$this->Html->link($this->Html->image('close.gif', array('alt'=>'Close window', 'title'=>'Close window')),
		       '#',
                       array("onclick"=>"ocultar()"),
		       null, 
                       false
                      ), array('style'=>'width:150px;float:right;'));
 
echo  $this->Html->div(null, __('Login', true), array('style'=>'width:250px;float:left;font:bold italic large Palatino'));
echo  $this->Html->div(null, '', array('style'=>'clear:both;'));
echo  $this->Form->create('User', array('action'=>'login')); 
?>
<fieldset>
<legend><?php __('Login');?> </legend>
  <?php 
   echo  $this->Form->input('User.email', array('size' => 30, 'maxlength'=>50, 'between' => ': <br />')) . "<br />";   

   echo $this->Form->input('User.pwd', array('between'=>'<br />', 'type' => 'password', 'label'=>'Password:', 'size' => 9, 'maxlength'=> 9));

   echo $this->Form->label('remember_me', __('Remember me', true));
   echo $this->Form->checkbox('User.remember_me');

   echo $this->Form->end(__('Login', true));
   echo '</fieldset>';

   echo $this->Html->div(null, $this->Html->link(__('Join us!', true), '/users/register', array('style'=>'font-size:7pt')));
   echo $this->Html->div(null, $this->Html->link(__('Forgot your password?', true), '/recovers/recover', array('style'=>'font-size:7pt'))); 
 ?>
</div>
</div>
<!-- End hide login element -->
