<?php 
echo $this->Gags->imgLoad('charging2');
echo $this->Gags->ajaxDiv('updater', array('style'=>'margin:6px;padding:7px;')). $this->Gags->divEnd('updater'); 
?>
<div class="spaced" id="form_register">
<?php 
  echo $this->Form->create(); 
  echo $this->Form->hidden('User.group_id', array('value'=>2));
?>
<fieldset>
  <legend>New MonoNeuron</legend>
     <?php echo $this->Form->input('User.username', array('size' => 12,  'between'=>'<br />', 'maxlength' => 12, "onBlur"=>"this.value=this.value.toLowerCase()")); ?><span class="small"> (En min&uacute;sculas, sin espacios, sin acentos)<br />
Tu blog estar&aacute; en:  <b>http://mononeurona.org/blog/<span style="color:green">username</span></b><br />
</span>
<?php echo $this->Form->input('User.email', array('size' => 30, 'maxlength' => 45,  'between'=>'<br />',)); ?>
     <br />
     <?php echo $this->Form->input('User.name', array('size' => 35, 'maxlength' => 50,  'between'=>'<br />', 'label'=>'Nombre y apellido')); ?>
     <br />
     <?php echo $this->Form->input('User.pwd', array('type'=>'password','size' => 9, 'maxlength' => 9, 'between'=>'<br />', 'label'=>'Password')); ?><span class="small">At least 6 characters</span>
     <br /><br />
<?php 
echo $this->Js->submit('Send', array('url'         => '/users/insert/', 
                                     'update'      => '#updater',
                                     'evalScripts' => True,
                                     'before'      => $this->Gags->ajaxBefore('updater', 'charging2'),
                                     'complete'    => $this->Gags->ajaxComplete('updater', 'charging2')  )); 
?>
</fieldset>
</form>
</div>
