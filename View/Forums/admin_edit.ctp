<?php
$this->Html->addCrumb('Control Panel', '/admin/entries/start'); 
$this->Html->addCrumb(__('Forums', True), '/admin/catforums/listing'); 
echo $this->Html->getCrumbs(' > ');

if ($vclassrooms):
echo $this->Form->create('Forum', array('action'=>'edit')); 
  if (!empty($this->data) && isset($this->data['Entry']['id'])): 
     echo $this->Form->hidden('Forum.id');
     $legend = __('Edit Forum', True);
  else:
     if ( isset($catforum_id) ):
         echo $this->Form->hidden('Forum.catforum_id', array('value'=>$catforum_id));
     endif; 
     $legend = __('New Forum', True);
  endif;
?>
<fieldset>
<legend><?php echo $legend; ?></legend>
<?php 
 echo $this->Form->input('Forum.title',         array('size'=>60, 'maxlength'=>90, 'class'=>'required'));
 echo $this->Form->input('Forum.vclassroom_id', array('options'=>$vclassrooms));
 echo $this->Form->input('Forum.description',   array('size' => 60,'maxlength' => 90)); 
 echo $this->Form->input('Forum.status',        array('type'=>'checkbox','label'=>__('Published', True), 'value'=>'1')); 
 echo $this->Form->input('Forum.end',           array('type'=>'checkbox','label'=>__('Finish edition', True), 'value'=>'1')); 
 echo $this->Form->end(__('Save', True));
?>
</fieldset>
<?php 
else:
 echo $this->Html->para(null, __('You do not have any virtual classroom available to assign a forum, please create a vClassroom and return to this screen', True).'.'); 
endif;
?>