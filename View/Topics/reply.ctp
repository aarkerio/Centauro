<?php 

if ( !$this->Session->read('Auth.User.id')  )
{
   exit('You are not logged');
}

echo $this->Html->script('fckeditor/fckeditor'); 

?> 

<div>
<?php echo $this->Html->addCrumb('Phorums', '/forums/display/'); ?> 
<?php echo $this->Html->getCrumbs(' / '); ?>
</div>

<?php 
    echo $this->Form->create('/topics/reply/',   'post'); 
    echo $this->Form->hidden('Topic.forum_id', $data[0]["Topic"]["forum_id"]);
    echo $this->Form->hidden('Topic.topic_id', $data[0]["Topic"]["id"]);
    echo $this->Form->hidden('Topic.username', $Element[0]["User"]["username"]);
    echo $this->Form->hidden('Topic.level',    $level);
    //var_dump($data);
?>

<fieldset>
  <legend>Reply Topic</legend>
  
  <?php echo $this->Form->label('Topic.subject', 'Subject:') . "<br />"; 
   echo $this->Form->input('Topic.subject', array('size' => 40, 'maxlength' => 60));
   echo $this->Form->error('Topic.subject', 'A subject is required.'); 
   ?>
  <p>
   <br />
   <?php echo $this->Form->label('Topic.message', 'Message:' ) . "<br />";
    echo $this->Form->textarea('Topic.message', array("cols"=>50, "rows"=>45));
    echo $fck->load('Topic.message', 'Karamelo', 500, 450);  
    echo $this->Form->error('Topic.message', 'Message is required.'); 
    ?>
  
  </p><br />
  <p><?php echo $this->Form->end('Send') ?></p>
</fieldset>
</form>

<div class="alt2" dir="ltr" style="
		margin: 15px 4px 15px 4px;
		padding: 6px;
		border: 1px inset;
		width: 630px;
		height: 230px;
		text-align: left;
		overflow: auto;">
                        
<?php foreach ($data as $val) { ?>

<div>
    <?php echo $val["Topic"]["subject"]; ?>
</div>
<div>
   <?php echo $val["Topic"]["message"]; ?>
</div>

<?php } ?>

</div>
