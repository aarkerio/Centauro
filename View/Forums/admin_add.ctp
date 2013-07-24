<?php  
echo $this->Html->script('myfunctions'); 
$this->Html->addCrumb('Control Tools', '/admin/entries/start');
$this->Html->addCrumb(__('Forums', True), '/admin/catforums/listing');
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->div('title_section', __('Add new forum', true));

if ( $vclassrooms == null):
    echo $this->Html->para(null, $this->Html->link(__('You need to have at last one vClassroom enabled to add new forums', true), '/admin/ecourses/listing'));
else:
  echo $this->Form->create('Forum');
  echo $this->Form->hidden('Forum.catforum_id', array('value'=>$catforum_id));
?>
<fieldset>
   <legend><?php __('New forum'); ?></legend>
<?php 
  echo $this->Form->input('Forum.vclassroom_id', array('type'=>'select', 'label' => 'vClassroom', 'options'=>$vclassrooms));
  echo $this->Form->input('Forum.title', array('size' => 40, 'maxlength' => 60, 'class'=>'required'));
  echo $this->Form->input('Forum.description', array('type'=>'textarea','label' => __('Description', True), 'rows'=>10,'cols'=>50));
  echo $this->Form->input('Forum.status', array('type'=>'checkbox', 'label'=> __('Published', True)));
  echo $this->Form->end(__('Save', true)); 

echo '</fieldset>';
endif;
?>
