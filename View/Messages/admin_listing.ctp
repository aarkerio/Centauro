<?php 
echo $this->Html->addCrumb('Control Tools', '/admin/entries/start');  
echo $this->Html->getCrumbs(' > ');
 
echo $this->Html->div(null, $this->Html->link($this->Html->image('admin/compose_on.gif', array('alt'=>"Compose New Message", 'title'=>"Compose New Message")), '/admin/messages/add',  array('escape'=>False)));

if ($this->Session->read('Auth.User.group_id') == 1): // if user belongs to admin group
   echo '<div style="position:absolute;right:300px;top:35px;">';
   echo $this->Html->link($this->Html->image('admin/message_board.gif', array('alt'=>"General Message", 'title'=>"General Message")), '/admin/messages/general',  array('escape'=>False));
   echo '</div>';
endif;

echo $this->Form->create('Message', array('action'=>'add', 'onsubmit'=>'return chkList()', 'name'=>'privmsg_list'));
echo $this->Form->hidden('Message.several', array('value'=>'1'));

$th = array('Flag', 'Subject', 'From', 'Date', 'Mark');
echo '<table class="tbadmin">';
echo $this->Html->tableHeaders($th);

foreach ($data as $val):
    switch ($val['Message']['status']):
         case 0:
                $status = 'New';
                $img    = 'message_n.gif';
                break;
         case 1:
                $status = 'Readed';
                $img    = 'message_r.gif';
                break;
        case 2:
                $status = 'Reply';
                $img    = 'message_e.gif';
                break;
     endswitch;
       
     $tr = array(
                $this->Html->link($this->Html->image('admin/'.$img, array('alt'=>$status, 'title'=>$status)), 
                '/admin/messages/display/'.$val['Message']['id'], array('escape'=>False)),
                $this->Html->link($val['Message']['title'], '/admin/messages/display/'.$val['Message']['id']),
                $val['User']['username'],
                $val['Message']['created'] . "\n",
                $this->Form->checkbox('Message.id][',array('value'=>$val['Message']['id'], 'id'=>'fieldid'.$val['Message']['id'])) . "\n"
               );
       
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
    
endforeach;
 echo '<tr><td colspan="5" style="text-align:right">';
 
 if ( count($data) > 0 ):
    echo $this->Html->link('Mark all', "javascript:select_switch(true)", array("style"=>"font-size:7pt")) . ' ';
    echo $this->Html->link('Unmark all', "javascript:select_switch(false)", array("style"=>"font-size:7pt")) . '<br />';   
    echo $this->Form->end('Deleted marked');
 endif;
?>
</td></tr>
</table>
<script language="Javascript" type="text/javascript">
//
// Should really check the browser to stop this whining ...
//
function select_switch(status)
{
  for (i = 0; i < document.privmsg_list.length; i++)
  {
     document.privmsg_list.elements[i].checked = status;
  }
}
    
function chkList()
{   
        var j = 0;
        for (i = 0; i < document.privmsg_list.length; i++)
		{
			if (document.privmsg_list.elements[i].checked == true)
            {
                j++;
            }
		}
        //alert('Inside '+ j);
        
        if (j == 0 )
        {
            alert('You must select at least one message');
            return false;
        }
        
        return true;
    }
</script>
