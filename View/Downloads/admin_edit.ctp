<?php 
echo $this->Html->script('ckeditor/ckeditor');

$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
$this->Html->addCrumb('Downloads', '/admin/downloads/listing'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Form->create('Download', array('action'=>'edit'));
if (!empty($this->data) && isset($this->data['Download']['id'])):  
     echo $this->Form->hidden('Download.id');
     $legend = __('Edit Download', true);
 else:
     $legend = __('New Download', true);
 endif;
 
echo $this->Gags->setImages(); 
?>
<fieldset>
<legend><?php __('Edit entry'); ?></legend>
<table>
<tr>
  <td><?php echo $this->Form->input('Download.title', array('size' => 40, 'maxlength' => 80));   ?></td>
  <td><?php echo $this->Form->input('Download.catdownload_id', array('options'=>$catdownloads)); ?></td>
  <td><?php echo $this->Form->input('Download.url', array('size' => 40, 'maxlength' => 200));    ?></td>
</tr>
<tr>
<td colspan="3">
 <?php 
  echo $this->Form->input('Download.description', array('cols'=>80, 'rows'=>25, 'label'=>False)); 
  echo $ck->load('DownloadDescription', 'Karamelo');
  ?>
</td>
</tr>
<tr>
<td> <?php echo $this->Form->input('Download.end', array('type'=>'checkbox', 'value' => '1')); ?></td>
<td colspan="2">
  <?php echo $this->Form->end(__('Save', True)); ?>
</fieldset>
</td>
</tr>
</table>
