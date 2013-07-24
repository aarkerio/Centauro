<?php 
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > ');

echo $this->Html->div('title_section', $this->Session->read('Auth.User.username').'s Podcasts');

echo $this->Html->para(Null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add podcast', 'title'=>'Add podcast')), 
                             '/admin/podcasts/edit', array('escape'=>False))); 

echo '<table class="tbadmin">';

$th = array ('Edit', 'See', 'Title', 'Status', 'File', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val):
     if ($val['Podcast']['status'] == 1):
        $img   = 'static/status_1_icon.png';
        $st    = __('Published');
     else:
        $img   = 'static/status_0_icon.png';
        $st    = __('Draft');
        $order = $st;
    endif;
    $tr = array (
        $this->Gags->sendEdit($val['Podcast']['id'], 'podcasts'),
        $this->Html->link($this->Html->image('admin/eye_icon.gif', array('alt'=>'See '. $val['Podcast']['title'], 
                          'title'=>'See '. $val['Podcast']['title'])), '#', 
                          array('onclick' => "window.open('/files/podcasts/".$val['Podcast']['filename']."',null, 
                                'status=1,toolbar=1,scrollbars=1,height=600,width=800')", 'escape'=>False)),
        $val['Podcast']['title'],
                $this->Html->link($this->Html->image($img, array('width'=>'14px', 'alt'=>$st, 'title'=>$st)), 
                    '/admin/podcasts/change/'.$val['Podcast']['id'].'/'.$val['Podcast']['status'], array('escape'=>False)),
        $this->Html->link($val['Podcast']['filename'], '/files/podcasts/'.$val['Podcast']['filename']),
        $this->Gags->confirmDel($val['Podcast']['id'], 'podcasts')
        );
       
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;
echo '</table>';

# ? > EOF




