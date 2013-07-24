<?php
$this->Html->addCrumb('Control Tools', '/admin/entries/start');
$this->Html->addCrumb('Messages', '/admin/messages/listing'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->link($this->Html->image('admin/compose_on.gif', array('alt'=>"Add new page", 'title'=>"Add new page")), '/admin/messages/add', array('escape'=>False));

echo $this->Gags->imgLoad('charging');
?>

<div style="border:1px dotted gray;padding:5px;margin:0 auto 0 auto;">
<h1>Message </h1>
<?php
//exit(print_r($data));
echo '<b>From</b>:'     . $data['User']['username']  . '<br />';
echo '<b>Subject</b>: ' . $data['Message']['title']  . '<br />';
echo '<div style="padding:3px;background-color:#e7e6e6">';
echo $data['Message']['body']   . '</div><br />';


//echo $this->Form->end('Reply', array("onclick" =>"hU()")) ;
echo '<input type="button" value="Reply" onclick="hU()" />';

echo$this->Gags->ajaxDiv("delbutton", array("style"=>"text-align:right"));
   echo $this->Gags->confirmDel($data['Message']['id'], 'messages');
echo $this->Gags->divEnd("delbutton");
?>

<!--****** HIDDEN REPLY FORM****** -->

<div id="formhidden" style="visibility:hidden">
<?php
  echo$this->Form->create(); 
  echo $this->Form->hidden('Message.username',   array('value'=>$this->Session->read('Auth.User.username')));
  echo $this->Form->hidden('Message.sender_id',  array('value'=>$this->Session->read('Auth.User.id')));
  echo $this->Form->hidden('Message.message_id', array('value'=> $data['Message']['id']));
  echo $this->Form->hidden('Message.user_id',    array('value'=> $data['Message']['sender_id']));     // the change was made on admin_display.thtml
?>
<fieldset>
<legend>Reply</legend>
  <?php 
  echo $this->Session->read('Auth.User.username') . '  writes: <br />';
  echo $this->Form->input('Message.title', array('size' => 35, 'maxlength' => 50, "value"=> 'Re: ' . $data['Message']['title'])) . '<br />';
  ?>  
</p>
  <br />
  <?php echo $this->Form->label('Message.body', 'Message:' );?><br />
  <?php echo $this->Form->textarea('Message.body', array("cols"=>50, "rows"=>10, "value"=>$data["User"]["username"] . ' wrote: ' . $data["Message"]["body"])); ?>
  <?php echo $fck->load('Message.body', 'Basic', 600, 160); ?> 
  <?php echo $this->Form->error('Message.body', 'Message is required.'); ?>
  <br />
  </p>
  
  <div style="clear:both"></div>
  <?php
  echo $this->Js->submit('Reply', array('url'    => '/admin/messages/add', 
                                        'update' =>'#formhidden',

                                        "before" => "MyFCKObject.UpdateEditorFormValue();",
                                        "loading" => "Element.show('charging');Element.hide('formhidden')",
                                        "complete" => "Element.hide('charging');Effect.Appear('formhidden')"
        ));
  ?>
</fieldset>
</form>
</div>
<script type="text/javascript"> 
<!-- 
function hU() {

var tr = document.getElementById('formhidden');
var ta = document.getElementById('MessageBody');

  if (tr.style.visibility == 'hidden')
  {
            tr.style.visibility = 'visible';
            ta.focus();
  } 
  else 
  {
            tr.style.visibility = 'hidden';
  }
}
-->
</script>
