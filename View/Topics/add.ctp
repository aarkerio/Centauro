<h1>Add new topic</h1>
<?php 

/* echo '<p>Foro: '. $this->Html->link($data[0]["Catforum"]['title'], '/catforums/display/'.$Element[0]["User"]["username"].'/'.$Element[0]["User"]["id"].'/'.$data[0]["Catforum"]["id"]) . '</p>'; */

echo $this->Html->script('fckeditor/fckeditor'); 

if ( !$this->Session->read('Auth.User.id') ):
   echo $this->Html->link('You need to be logged in to add a topic or reply', '/users/login');
 else:
  echo $this->Form->create('Topic', array('action'=>'add'));

  echo $this->Form->hidden('Topic.forum_id', array('value'=>$forum_id));
  $return = $Element[0]['User']['username'] .'/'.$forum_id;
  echo $this->Form->hidden('Topic.return', array('value'=>$return));
  echo $this->Form->hidden('Topic.status', array('value'=>'1'));
  
  if ( isset($topic_id) ):
       echo $this->Form->hidden('Topic.topic_id', array('value'=>$topic_id));
  else:
       echo $this->Form->hidden('Topic.topic_id', array('value'=>'1'));
  endif;
  echo $this->Form->hidden('Topic.level', array('value'=>'1'));
?>
<fieldset>
  <legend>New topic</legend>
   <?php echo $this->Form->input('Topic.subject', array('size' => 40, 'maxlength' => 60)); ?>
  <br />
   <?php echo $this->Form->label('Topic.message', 'Message:' );?><br />
  <?php echo $this->Form->textarea('Topic.message', array("cols"=>50, "rows"=>45)) ?>
  <?php echo $fck->load('Topic.message', 'Basic', 500, 450); ?> 
  <?php echo $this->Form->error('Topic.message', 'Message is required.'); ?>
  <p><br />
  <?php echo $this->Form->end('Send') ?></p>
</fieldset>
<?php 
endif; 
?>
