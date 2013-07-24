<?php 
 echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 echo $this->Html->getCrumbs(' / ');
 echo $this->Html->div('title_section', 'Chats in blog');
?> 

<table style="width:100%">
<tr>
<td colspan="4">
<?php 
echo $this->Gags->imgLoad('loading');
echo $this->Gags->ajaxDiv('editing'). $this->Gags->divEnd('editing');
?>
</td>
</tr>
<?php
$th = array ('Edit', 'Livechat', 'Date', 'Delete');
echo $this->Html->tableHeaders($th);

# var_dump($data);
foreach ($data as $key=>$val):
    $tr = array (
        $this->Gags->sendEdit($val['Livechat']['id'], 'livechats'),
        $val['Livechat']['message'],
        $val['Livechat']['created'],
        $this->Gags->confirmDel($val['Livechat']['id'], 'livechats')
        );
       
    echo $this->Html->tableCells($tr, array('class'=>"altRow", "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow',"onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='evenRow'"));
endforeach;

echo '</table>';

# ? > EOF

