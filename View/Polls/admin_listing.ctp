<?php
$this->set('title_for_layout', 'Admin Poll'); 

$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->div('title_section', 'Polls');
echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new poll', 'title'=>'Add new poll')), '/admin/polls/add/', array('escape'=>False));

echo '<table class="tbadmin">';

$th = array('Edit', 'Question', 'Created', 'Status', 'Delete');

echo $this->Html->tableHeaders($th);	

foreach ($data as $key=>$val):
    if ($val['Poll']['status'] == 1):
        $img   = 'static/status_1_icon.png';
        $st    = __('Published', True);
    else:
        $img   = 'static/status_0_icon.png';
        $st    = __('Draft', True);
        $order = $st;
    endif;

    
    $tr = array (
        $this->Gags->sendEdit($val['Poll']['id'], 'polls'),
        $val['Poll']['question'],
        $val['Poll']['created'],
        $this->Html->link($this->Html->image($img, array('width'=>'14px', 'alt'=>$st, 'title'=>$st)),
                                    '/admin/polls/change/'.$val['Poll']['id'] .'/'. $val['Poll']['status'], array('escape'=>False)),
        $this->Gags->confirmDel($val['Poll']['id'], 'polls')
        );
     
       echo $this->Html->tableCells($tr, array('class'=>'altRow', "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow','onmouseover'=>"this.className='highlight'", 'onmouseout'=>"this.className='evenRow'")); 
endforeach;
?> 
</table>
