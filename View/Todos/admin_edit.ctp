<?php
#exit(print_r($data));
echo $this->Form->create('Todo');
echo $this->Form->hidden('Todo.id'); 
?>
<fieldset style="width:370px;background-color:transparent">
<legend>Edit TODO</legend>
<table>
<?php
  echo $this->Form->input('Todo.name', array('size' => 25, 'maxlength' => 80));
  echo $this->Form->input('Todo.deadline',  array('type'=>'date','label'=>__('Dead line', True), 'dateFormat'=>'DMY'));
  echo $this->Form->input('Todo.priority', array('options'=>range(0,5)));
  echo $this->Form->input('Todo.task', array('cols'=>33, 'rows'=>7));
  echo $this->Form->input('Todo.completed', array('value'=>'1', 'type'=>'checkbox'));
  echo $this->Form->end('Save');
  echo '</fieldset>';

  echo $this->Html->link('Cancel', '#', array('onclick'=>"javascript:getElementById('editTodoDiv').style.display = \"none\";"));

# ? > EOF


