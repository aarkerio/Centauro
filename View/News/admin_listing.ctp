<?php
echo $this->Html->div('title_section', 'News'); 
 
echo $this->Html->div('spaced');
echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new','title'=>'Add new')),'/admin/news/edit',array('escape'=>False)).'  ';
echo $this->Html->link($this->Html->image('static/comments_icon.gif', array('alt'=>"View Comment", 'title'=>"View Comments")), '/admin/news/comments', array('escape'=>False));
 ?>
</div>
<table class="tbadmin">
<?php
# die(print_r($data));
$th = array(__('Edit'), 'Title', 'Status', __('Delete'));
echo $this->Html->tableHeaders($th);

foreach ($data as $val):      
    $status = $this->Gags->setStatus($val['News']['status']);
    $tr = array (
        $this->Gags->sendEdit($val['News']['id'], 'news'),
        $this->Html->link($val['News']['title'], '/news/view/'.$val['News']['id']),
        $this->Html->link($status, '/admin/news/change/'.$val['News']['id'] .'/'. $val['News']['status']),
        $this->Gags->confirmDel($val['News']['id'], 'news')
    );
       
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;

echo '</table>';

$t  = $this->Html->div(null,$this->Paginator->prev('«'. __('Previous').' ',null,Null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(null,$this->Paginator->next(' '.__('Next').' »', Null, Null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo  $this->Html->div(null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));

# ? > EOF