<table class="tbadmin" style="width:100%">
<?php
$th = array ('Edit', 'Name', 'Priority', 'Deadline', 'Completed', 'Created', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val):
    $completed = ($val['Todo']['completed'] == 1) ? 'Completed' : 'Pending';
    $tr = array(
           $this->Form->create('Todo').$this->Form->hidden('Todo.id',array('value'=>$val['Todo']['id'])).$this->Form->hidden('Todo.get',array('value'=>1)).
            $this->Js->submit('Edit', array('url'         => '/admin/todos/edit/', 
                                            'update'      => '#editTodoDiv',
                                            'evalScripts' => True,
                                            'before'      => $this->Gags->ajaxBefore('todolist'),
                                            'complete'    => $this->Gags->ajaxComplete('todolist'))),

    $val['Todo']['name'],
    $val['Todo']['priority'],
    $val['Todo']['deadline'],
    $html->link($completed,'/admin/todos/change/'.$val['Todo']['id'].'/'.$val['Todo']['completed']),
    $val['Todo']['created'],
    $this->Gags->confirmDel($val['Todo']['id'], 'todos') );

    echo $html->tableCells($tr,$this->Gags->aRow, $this->Gags->eRow);
endforeach;
echo '</table>';

echo $this->Js->writeBuffer();
# ? > EOF