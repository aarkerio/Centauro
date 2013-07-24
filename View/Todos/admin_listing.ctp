<?php
$this->set('title_for_layout',  'My TODOs');
echo $this->Html->div('title_section', 'My TO-DOs');

echo $this->Html->div(null, null, array('style'=>'float:right;width:100px;position:absolute;top:30px;left:800px'));  
echo $this->Html->link($this->Html->image('static/rss-icon.gif', array('alt'=>'RSS', 'title'=>'ToDos RSS')), 
			'/todos/rss/'.$this->Session->read('Auth.User.username'), array('escape'=>False));

echo $this->Gags->imgLoad('loading');

echo '</div>';

if ( count($data) > 0 ):
    $total_todos    = 0;
    $todo_completed = 0;
    foreach ($data as $v): 
        $total_todos++;
        if  ( $v['Todo']['completed'] == 1 ):
            $todo_completed++;
        endif;
    endforeach;  
    $percent  = intval(($todo_completed * 100) / $total_todos);    # % = votes * 100 / total 
    $pendings  = 100 - $percent;
    $width    = $percent * 8;
    $pwidth   = 800 - $width; # pending width
  
    echo '<div id="progress" style="width:100%;padding:7px;border:1px dotted gray">Advance:<br />';
    echo $this->Html->image('admin/progress.png', array('alt'=>"Progress", 'title'=>"Progress %$percent", 'width'=>$width, 'height'=>10)) . ' '. $this->Html->image('admin/pending.png', array('alt'=>'Pendings', 'title'=>"Pendings %$pendings", 'width'=>$pwidth, 'height'=>10)) . ' <b>'.$percent.'%</b>';
    echo '</div>';
endif;

echo $this->Form->create();
?>
 <fieldset>
 <legend>Quick add</legend>
<?php 
    echo $this->Form->input('Todo.name', array('size' => 35, 'maxlength'=>80));
    echo $this->Js->submit('Save', array('url'         => '/admin/todos/add/',
                                         'update'      => '#todolist',
                                         'evalScripts' => True,
                                         'before'      => $this->Gags->ajaxBefore('todolist'),
                                         'complete'    => $this->Gags->ajaxComplete('todolist')
        ));
?>
</fieldset>
</form>
<!-- The "List Todo" layer -->
<?php echo$this->Gags->ajaxDiv('todolist'); ?> 
<table class="tbadmin" style="width:100%">
<?php
$th = array('Edit', 'Name', 'Priority', 'Deadline', 'Completed', 'Created', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val):
       $completed = ($val['Todo']['completed'] == 1) ? 'Completed' : 'Pending';
       $tr = array (
           $this->Form->create(Null) . $this->Form->hidden('Todo.id', array('value' => $val['Todo']['id'])) . $this->Form->hidden('Todo.get', array('value' => 1)) .
            $this->Js->submit('Edit', array('url'    => '/admin/todos/edit/', 
                                            'update' => '#editTodoDiv',
                                            'evalScripts' => True,
                                            'before'      => $this->Gags->ajaxBefore('editTodoDiv'),
                                            'complete'    => $this->Gags->ajaxComplete('editTodoDiv')
            )) . '</form>',
            $val['Todo']['name'],
            $val['Todo']['priority'],
            $val['Todo']['deadline'],
            $this->Html->link($completed,'/admin/todos/change/'.$val['Todo']['id'].'/'.$val['Todo']['completed']),
            $val['Todo']['created'],
            $this->Gags->confirmDel($val['Todo']['id'], 'todos')
        );
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>
<?php echo $this->Gags->divEnd('todolist'); ?>
<br />
<?php
echo $this->Form->create('Todo', array('action'=>'delete','onsubmit'=>"return confirm('Are you sure to delete all TODOs?')"));
echo $this->Form->hidden('Todo.all', array('value'=>'1'));
echo $this->Form->end('Deleted all completed TODOs');
?>
</form>
<!-- The "Edit a Todo" layer -->
<?php 
  echo $this->Gags->ajaxDiv('editTodoDiv', array('class'=>'box', 'style'=>'display:none;')).$this->Gags->divEnd('editTodoDiv'); 
# ? > EOF
