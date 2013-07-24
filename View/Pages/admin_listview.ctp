
<div class="title_section">Pages</div>

<p><?php echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>"Add new", 'title'=>"Add new")), '/admin/news/add', null, false, false) ?></p>

<table class="tbadmin">

<?php
exit(print_r($data));

$th = array ('Edit', 'Title', 'Status', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $key=>$val)
    {
            
       $tr = array (
        $this->Gags->sendEdit($val['News']['id'], 'news'),
        $val['News']['title'],
        $this->Gags->setStatus($val['News']['status']),
        $this->Gags->confirmDel($val['News']['id'], 'news')
        );
       
    echo $this->Html->tableCells($tr, array('class'=>"altRow", "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow',"onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='evenRow'"));
    
    }
?>
</table>
