<?php

if ( !$this->Session->read('Auth.User.id')  )
{
   exit('You are not logged');
}

echo $this->Html->script('fckeditor/fckeditor'); 
?>
<div style="text-align:left;padding:4px">
<?php 
    echo $this->Form->create('Reply',  array('action'=>'add'));
    echo $this->Form->hidden('Reply.topic_id', array('value'=>$topic_id));
    echo $this->Form->hidden('Reply.return', array('value'=>$return));
?>
<fieldset>
<legend>Add Reply</legend>

<?php echo $this->Form->input('Reply.title', array('size'=>60, 'maxlength'=>90));?>
<br />
   <?php echo $this->Form->label('Reply.body', 'Message:' ) . "<br />";
    echo $this->Form->textarea('Reply.body', array("cols"=>50, "rows"=>45));
    echo $fck->load('Reply.body', 'Karamelo', 500, 450);  
    echo $this->Form->error('Reply.body', 'Message is required.'); 
    ?>
  
<br /><br />
<p style="clear:both"></p>
<?php echo $this->Form->end('Send') ?>
</fieldset>
</form>
</div>

