<?php 
 #die( debug( $this->data ) ); 

 if ($this->data['User']['id'] != $this->Session->read('Auth.User.id')):
     echo $this->getSupport();
 endif;

 echo $this->Html->para(null, $this->Html->image('avatars/'.$this->data['User']['avatar'], array('alt'=>$this->data['User']['username'], 'title'=>$this->data['User']['username']))); 
  
  echo $this->Form->create('User');
  echo $this->Form->hidden('User.id'); 
  echo $this->Form->hidden('User.email'); 
?>
<fieldset>
<?php 
  echo '<legend>'.$this->Session->read('Auth.User.username') .'\'s '.__('profile', true).'</legend>';
  echo $this->Html->div(null, '<b>'.$this->data['User']['email'].'</b>');
  echo $this->Form->input('User.name', array('size' => 35, 'maxlength'=>50)); 
  echo $this->Form->input('User.cv', array('type'=>'textarea', 'cols' => 70, 'rows' => 7, ''=>__('Profile', True)));
  echo $this->Form->input('User.quote', array('size' => 70, 'maxlength' => 150, 'label'=>__('Quote', true)));
  echo $this->Form->input('User.name_blog', array('size' => 45, 'maxlength' => 150, 'label'=>__('eduBlog name', True)));
  echo $this->Form->input('User.tags', array('type'=>'textarea', 'cols' => 70, 'rows' => 2, 'label'=>__('Tags', True)));
  echo $this->Form->input('User.newsletter', array('type'=>'checkbox','label'=> __('Subscribe to newsletter', True).': ')); 
  echo $this->Form->input('User.fck', array('type'=>'checkbox','label'=> __('Active HTML editor', True))); 
  echo  $this->Form->input('User.email', array('size'=>35, 'maxlength'=>50));
  echo $this->Html->div(null, $this->Form->input('User.pwd', array('size'=>9, 'maxlength'=>9, 'value'=>'', 'label'=>__('Password', true))) . '  '.__('Left empty if you do not want to change', true), array('style'=>'clear:both;margin:25px 0 16px 0;'));
  
  echo $this->Form->end(__('Save', true)); 
 
  echo '</fieldset>';

  echo $this->Html->div('spaced');
  echo $this->Form->create('User', array('enctype'=>'multipart/form-data', 'action'=>'avatar')); 
  echo $this->Form->hidden('User.id'); 
?>
<fieldset>
  <legend><?php __('Upload new avatar'); ?></legend>
 <?php
  echo $this->Html->div(null, 'An image 50 x 50 pixels');
  echo $this->Form->input('User.file', array('type'=>'file')); 
  echo $this->Form->end(__('Upload', true)); 
?>
</fieldset>
</div>

<script type="text/javascript">
function chkForm()
{ 
  var name      = document.getElementById("UserName");
  var passwd    = document.getElementById("UserPwd");
  var email     = document.getElementById("UserEmail");
  var nameblog  = document.getElementById("UserNameBlog");
  
  if (name.value.length < 6)
  {
    alert('The name must have six letters at least');
    name.focus();
    return false;
  }
  
  if (passwd.value.length > 0  && passwd.value.length < 6)
  {
    alert('Passwd must have five letters at least');
    passwd.focus();
    return false;
  }
  
  //check email
  var atpos  = email.value.indexOf("@");    //indexOf find something in your JavaScript string
  var dotpos = email.value.indexOf(".");
  
  //alert('at: ' + atpos);
  
  if ( atpos < 1 || dotpos < 1 || email.value.length < 5) 
  {
    alert('Mmmm, this email ' + email.value + ' does not look as a valid email');
    email.focus();
    return false;
  }

  if (nameblog.value.length < 6)
  {
    alert('The name blog must have six letters at least');
    nameblog.focus();
    return false;
  }
 
return true;
}
</script>