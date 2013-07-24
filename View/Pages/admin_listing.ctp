<?php 
//exit(print_r($data));
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
$this->Html->addCrumb('Sections', '/admin/pages/sections'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->para(null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>"Add new page", 'title'=>"Add new page")), '/admin/pages/edit/', array('escape'=>False))); 

 echo $this->Html->div('title_section');
 echo 'Your Pages on <br /> ';
echo $this->Html->link($this->Html->image('secs/'.$data[0]['Section']['img'], array('alt'=>$data[0]['Section']['description'], 'title'=>$data[0]['Section']['description'])), '/admin/pages/sections/', array('escape'=>False));
?>
</div>
<table class="tbadmin">
<?php
//exit(print_r($data));

$th = array ('Edit', 'See', 'Title', 'Status', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $val): 
    $tr = array (
        $this->Gags->sendEdit($val['Page']['id'], 'pages'),
        $this->Html->link($this->Html->image('admin/eye_icon.gif', array('alt'=>"See ". $val['Page']['title'], 'title'=>"See ". $val['Page']['title'])), 
         '#',array('onclick'=>"window.open('/pages/display/".$val['Page']['id']."',null,'status=1,toolbar=1,scrollbars=1,height=600,width=800');", 
         'escape'=>False)),
        $val['Page']['title'],
        $this->Gags->setStatus($val['Page']['status']),
        $this->Gags->confirmDel($val['Page']['id'], 'pages')
        );
       
       echo $this->Html->tableCells($tr,  $this->Gags->aRow, $this->Gags->eRow);    
endforeach;
?>
</table>
