<?php 
echo $this->Html->div('title_section',  $this->Session->read('Auth.User.username').' shared files');
echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new share', 'title'=>'Add new share')), '#', array('escape'=>False, 'onclick'=>'hU()')); 
echo $this->Session->flash(); 
?>
<div id="addshare" style="display:none">
  <?php echo $this->Form->create('Share', array('action'=>'add', 'enctype'=>'multipart/form-data') ); ?>
  <fieldset>
     <legend>Upload Share</legend>
  <?php 
     echo $this->Form->input('Share.file', array('type'=>'file'));    
     echo $this->Form->input('Share.description', array('size' => 30, 'maxlength'=>50));
     echo $this->Form->end('Upload'); 
  ?>
</fieldset>
</form>

</div>
<table style="width:100%">

<?php
 $th = array ('Download', 'File', 'Size Kb', 'Description', 'Uploaded', 'Public', 'Delete');
echo $this->Html->tableHeaders($th);
foreach ($data as $val):
    $st = ($val['Share']['public'] == 1) ? 'Public': 'No public';
    $size = filesize('../webroot/files/userfiles/'.$val['Share']['file']);
    $sizemb = round(($size/1024),2);
    $tr = array(
                $this->Html->link(
                           $this->Html->image('static/button_download.gif', array('alt'=>"Download file", 'alt'=>"Download file")),
                           '/files/userfiles/'.$val['Share']['file'],   array('escape'=>False)),
                $val['Share']['file'],
	            $sizemb,
                $val['Share']['description'],
                '<span style="font-size:7pt;">'.$val['Share']['created'].'</span>',
                $this->Html->link($st, '/admin/shares/change/'.$val['Share']['id'].'/'.$val['Share']['public']),
                $this->Gags->confirmDel($val['Share']['id'], 'shares')
               );
       
    echo $this->Html->tableCells($tr,  $this->Gags->aRow, $this->Gags->eRow);
endforeach;
?>
</table>
<?php
echo $this->Html->div(null,Null, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));
echo $this->Html->div(null,$this->Paginator->prev('« Previous',Null,Null,array('class'=>'disabled')), array('style'=>'width:100px;float:left'));
echo $this->Html->div(null,$this->Paginator->next('Next »',Null,Null,array('class' => 'disabled')), array('style'=>'width:100px;float:right'));
echo $this->Html->div(null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo '</div>';
?>
<script type="text/javascript"> 
<!-- 
function hU() {

var tr = document.getElementById('addshare');

  if (tr.style.display == 'none')
  {
            tr.style.display = 'block';
  } else {
            tr.style.display = 'none';
  }
}
-->
</script>
