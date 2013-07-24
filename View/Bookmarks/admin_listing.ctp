<?php 
 $this->Html->addCrumb('Control Tools', '/admin/entries/start');
 echo $this->Html->getCrumbs(' / '); 

 echo $this->Html->div(null, $this->Html->link($this->Html->image('static/icon_rss.png', array('alt'=>'Subscribe bookmarks', 'title'=>'Subscribe bookmarks')), '/bookmarks/feeder/'.$this->Session->read('Auth.User.username').'.rss', array('escape'=>False)), array('style'=>'width:80px;float:right;')); 

 echo $this->Html->div('title_section', $this->Session->read('Auth.User.username'). "' Bookmarks");

echo $this->Html->div(null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new bookmark', 'title'=>'Add new bookmark')), '#', array('onclick'=>'hU()', 'escape'=>False)),  array('style'=>'width:80px;float:left;')); 

?>

 <div style="float:left"> <?php echo $this->Html->link($this->Html->image('admin/icon_export.gif', array('alt'=>"Export Bookmarks", 'title'=>"Export Bookmarks to LDIF format")), '/admin/bookmarks/export/'.$this->Session->read('Auth.User.username'), array('escape'=>False)); ?></div>

<div id="trh" style="margin:0;padding:0;padding-left:40px;width:80%;display:none;">
 <?php echo $this->Form->create('Bookmark', array('action'=>'add')); ?>
 <fieldset>
 <legend>New Bookmark</legend>
  <?php echo $this->Form->input('Bookmark.name', array('size' => 30, 'maxlength'=>50)); ?>  
   <br /><br />
   <?php echo $this->Form->input('Bookmark.url', array('size' => 60, 'maxlength'=>300, 'value'=>'http://')); ?>
  <?php echo $this->Form->end('Add'); ?>
</fieldset>
</div>

<table style="width:100%">
<?php
$th = array ('Edit', 'Name', 'Url', 'Delete');
echo $this->Html->tableHeaders($th);
foreach ($data as $val):
    $tr = array (
        $this->Gags->sendEdit($val['Bookmark']['id'], 'bookmarks'),
        $val['Bookmark']['name'],
        $this->Html->link($val['Bookmark']['url'], $val['Bookmark']['url']),
        $this->Gags->confirmDel($val['Bookmark']['id'], 'bookmarks')
        );
 echo $this->Html->tableCells($tr, $this->Gags->aRow, $this->Gags->eRow);
       
 endforeach;
?> 
</table>

<script type="text/javascript"> 
<!-- 
function hU() {

var tr = document.getElementById('trh');

  if (tr.style.display == 'none')
  {
            tr.style.display = 'table-row';
  } else {
            tr.style.display = 'none';
  }
}
-->
</script>
