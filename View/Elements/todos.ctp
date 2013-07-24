<style type="text/css"> 

.editable input[type=submit] {
   color: #F00;
   font-weight: bold;
 }
.editable input[type=button] {
   color: #0F0;
   font-weight: bold;
 }
</style> 
<?php
$todos = $this->requestAction('todos/chkTodos');

echo $this->Html->div('element', Null, array('style'=>'background:#fff;padding:5px;margin:6px'));
echo $this->Html->image('static/todos.jpg', array('alt'=>'My TODOs', 'title'=>'My TODOs'));
#die(debug($todos));
foreach ($todos as $v):
    echo $this->Html->div('todo_'.$v['Todo']['priority'], $v['Todo']['name'], array('id'=>'td'.$v['Todo']['id']));
endforeach;

echo $this->Html->link('Agregar pendiente', '/admin/todos/listing', array('style'=>'font-size:7pt;padding:6px;'));
echo '</div>';

# ? > EOF