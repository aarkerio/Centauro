<?php echo $this->Html->div('title_section', 'Sections'); ?>
<table class="tbadmin">
<?php
//exit(print_r($data));

$th = array ('Edit', 'Title', 'Pages', 'Delete');
echo $this->Html->tableHeaders($th);
foreach ($data as $val):
  $E = $this->Session->read('Auth.User.group_id') == 1 ? $this->Gags->sendEdit($val['Section']['id'], 'sections')      : ' '; 
  $D = $this->Session->read('Auth.User.group_id') == 1 ? $this->Gags->confirmDel($val['Section']['id'], 'sections')    : ' ';
 
  $tr = array (
        $E,
        $this->Html->link($this->Html->image('secs/'.$val['Section']['img'], array('width'=>'29px', 'alt'=>$val['Section']['description'], 'title'=>$val['Section']['description'])), 
                    '/admin/pages/listing/'.$val['Section']['id'], array('escape'=>False)),
        count($val['Page']),
        $D
    );
       
    echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>